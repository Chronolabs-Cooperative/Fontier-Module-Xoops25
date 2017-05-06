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
echo basename(__FILE__)."::".__LINE__."<br/>";
if (!defined('XOOPS_ROOT_PATH')) {
	die("XOOPS root path not defined");
}
echo basename(__FILE__)."::".__LINE__."<br/>";
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'header.php';
echo basename(__FILE__)."::".__LINE__."<br/>";
function fontier_notify_iteminfo($category, $item_id)
{
	if ($category == 'global') {
		$item['name'] = '';
		$item['url'] = '';
		return $item;
	}

	if ($category=='new_index') {
		$indexesHandler = xoops_getModuleHandler('indexes' ,basename(dirname(__DIR__)));
		if ($index = $indexesHandler->get($item_id))
		{
			$item['name'] = $index->getVar('base');
			$item['url'] = $index->getIndexBrowseURL();
			$index->setVar('notified', time());
			$indexesHandler->insert($index, true);
			return $item;
		} else {
			return null;
		}
	}
	
	if ($category=='new_font') {
		$identitiesHandler = xoops_getModuleHandler('identities' ,basename(dirname(__DIR__)));
		if ($identity = $identitiesHandler->get($item_id))
		{
			$item['name'] = $identity->getVar('name');
			$item['url'] = $identity->getFontBrowseURL();
			$identity->setVar('notified', time());
			$identitiesHandler->insert($identity, true);
			return $item;
		} else {
			return null;
		}
	}	
}
?>
