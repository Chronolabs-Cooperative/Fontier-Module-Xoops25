<?php
/**
 * Font Repository Browser for the Chronolabs Cooperative Fonting Repository Services API
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright   	The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     	General Public License version 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @author      	Simon Roberts (wishcraft) <wishcraft@users.sourceforge.net>
 * @subpackage  	fontier+
 * @description 	Font Repository Browser for the Chronolabs Cooperative Fonting Repository Services API
 * @version			1.0.1
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/fontier
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.6/Modules/fontier
 * @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/fontier
 * @link			http://internetfounder.wordpress.com
 */

	
	require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'header.php';
	
	set_time_limit(8444);
	
	global $fontierConfigsList;
	
	$identitiesHandler= xoops_getModuleHandler('identities',_MD_FONTIER_MODULE_DIRNAME);
	$indexesHandler= xoops_getModuleHandler('indexes',_MD_FONTIER_MODULE_DIRNAME);
	$criteria = new Criteria('polled', 0);
	if (!empty($fontierConfigsList['api_path']) && $identitiesHandler->getCount($criteria) > 0)
	{
		$criteria->setOrder('RAND()');
		if ($fontierConfigsList['num_polled_items'] > 0)
			$criteria->setLimit($fontierConfigsList['num_polled_items']);
		if ($fonts = $identitiesHandler->getObjects($criteria))
		{
			$GLOBALS['xoopsDB']->queryF("START TRANSACTION");
			foreach($fonts as $font)
			{
				$font->setVar('diz', getURIData(str_replace("%apipath%", $fontierConfigsList['api_path'], str_replace("%identity%", $font->getVar('identity'), $fontierConfigsList['api_path_diz']))));
				$font->setVar('css', getURIData(str_replace("%apipath%", $fontierConfigsList['api_path'], str_replace("%identity%", $font->getVar('identity'), $fontierConfigsList['api_path_css']))));
				$font->setVar('json', $data = json_decode(getURIData(str_replace("%apipath%", $fontierConfigsList['api_path'], str_replace("%identity%", $font->getVar('identity'), $fontierConfigsList['api_path_json']))), true));
				$font->setVar('name', $data['FontFullName']);
				$font->setVar('referee', $data['referee']);
				$font->setVar('barcode', $data['barcode']);
				$font->setVar('base', substr(strtolower(urlencode($data['FontFullName'])), 0, 1));
				$font->setVar('second', substr(strtolower(urlencode($data['FontFullName'])), 0, 2));
				$font->setVar('thirds', substr(strtolower(urlencode($data['FontFullName'])), 0, 3));
				$glyphs = array();
				for($utf=31;$utf<128;$utf++)
					if ($utf > 31 && $utf< 124)
						if (mt_rand(0,3)==2 || mt_rand(0,6)==5)
							$glyphs[] = $utf;
				$font->setVar('glyphs', $glyphs);
				$font->setVar('glyphed', time());
				$font->setVar('polled', time());
				$font->setVar('tags', $tags = getFontNameTags($font->getVar('name')));
			
				if ($id = $identitiesHandler->insert($font, true))
				{
					if ($fontierConfigsList['tags'] && file_exists(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'tag' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'tag.php'))
					{
						$tag_handler = xoops_getmodulehandler('tag', 'tag');
						$tag_handler->updateByItem($tags, $id, basename(dirname(__DIR__)), 0);
					}
					$criteria = new Criteria('base', $font->getVar('base'));
					if ($indexesHandler->getCount($criteria) == 0)
					{
						$index = $indexesHandler->create();
						$index->setVar('base', $font->getVar('base'));
						$indexesHandler->insert($index, true);
					}
					$index = $indexesHandler->getByBase($font->getVar('base'));
					if (is_a($index, 'fontierIndexes'))
						$index->addFontID($font->getVar('id'));
					else
						die('Missing Index for Base: '.$font->getVar('base'));
					$first_id = $indexesHandler->insert($index, true);
					$criteria = new Criteria('base', $font->getVar('second'));
					if ($indexesHandler->getCount($criteria) == 0)
					{
						$index = $indexesHandler->create();
						$index->setVar('base', $font->getVar('second'));
						$index->setVar('parent_id', $first_id);
						$indexesHandler->insert($index, true);
					}
					$index = $indexesHandler->getByBase($font->getVar('second'));
					if (is_a($index, 'fontierIndexes'))
						$index->addFontID($font->getVar('id'));
					else
						die('Missing Index for Base: '.$font->getVar('second'));
					$second_id = $indexesHandler->insert($index, true);
					$criteria = new Criteria('base', $font->getVar('thirds'));
					if ($indexesHandler->getCount($criteria) == 0)
					{
						$index = $indexesHandler->create();
						$index->setVar('base', $font->getVar('thirds'));
						$index->setVar('parent_id', $second_id);
						$indexesHandler->insert($index, true);
					}
					$index = $indexesHandler->getByBase($font->getVar('thirds'));
					if (is_a($index, 'fontierIndexes'))
						$index->addFontID($font->getVar('id'));
					else
						die('Missing Index for Base: '.$font->getVar('thirds'));
					$third_id = $indexesHandler->insert($index, true);
				}
			}
			$GLOBALS['xoopsDB']->queryF("COMMIT");
		}
	}