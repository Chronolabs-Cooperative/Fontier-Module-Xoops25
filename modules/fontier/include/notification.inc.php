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

if (!defined('XOOPS_ROOT_PATH')) {
	die("XOOPS root path not defined");
}

function nw_notify_iteminfo($category, $item_id)
{
	if ($category == 'global') {
		$item['name'] = '';
		$item['url'] = '';
		return $item;
	}

	global $xoopsDB;

	if ($category=='story') {
		// Assume we have a valid story id
		$sql = 'SELECT title FROM '.$xoopsDB->prefix('nw_stories') . ' WHERE storyid = ' . intval($item_id);
		$result = $xoopsDB->query($sql);
		if($result) {
			$result_array = $xoopsDB->fetchArray($result);
			$item['name'] = $result_array['title'];
			$item['url'] = NW_MODULE_URL . '/article.php?storyid=' . intval($item_id);
			return $item;
		} else {
			return null;
		}
	}
	
	// Added by Lankford on 2007/3/23
	if ($category=='category') {
		$sql = 'SELECT title FROM ' . $xoopsDB->prefix('nw_topics') . ' WHERE topic_id = '.intval($item_id);
		$result = $xoopsDB->query($sql);
		if($result) {
			$result_array = $xoopsDB->fetchArray($result);
			$item['name'] = $result_array['topic_id'];
			$item['url'] = NW_MODULE_URL . '/index.php?topic_id=' . intval($item_id);
			return $item;
		} else {
			return null;
		}
	}	
}
?>
