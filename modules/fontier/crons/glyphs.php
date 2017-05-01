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
	
	$criteria = new CriteriaCompo(new Criteria('polling', 0, '>'));
	$criteria->add(new Criteria('glyphed', time() - $fontierConfigsList['cache_glyphs'], "<="));
	if (!empty($fontierConfigsList['api_path']) && $identitiesHandler->getCount($criteria) > 0)
	{
		$criteria->order('RAND()');
		if ($fontierConfigsList['num_polled_glyphs'] > 0)
			$criteria->setLimit($fontierConfigsList['num_polled_glyphs']);
		if ($fonts = $identitiesHandler->getObjects($criteria))
		{
			foreach($fonts as $font)
			{
				$glyphs = array();
				for($utf=31;$utf<128;$utf++)
					if ($utf > 31 && $utf< 124)
						if (mt_rand(0,3)==2 || mt_rand(0,6)==5)
							$glyphs[] = $utf;
				$font->setVar('glyphs', $glyphs);
				$font->setVar('glyphed', time());
				$identitiesHandler->insert($font, true);
			}
		}
	}
		