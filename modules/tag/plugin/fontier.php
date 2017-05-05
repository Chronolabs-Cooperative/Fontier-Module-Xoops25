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

if (!defined('XOOPS_ROOT_PATH')) { exit(); }

/**
 * 
 * @param unknown $items
 * @return boolean
 */
function fontier_tag_iteminfo($items)
{
    if (empty($items) || !is_array($items)) {
        return false;
    }
    
    $items_id = array();
    foreach (array_keys($items) as $cat_id) {
        // Some handling here to build the link upon catid
        // catid is not used in fontier, so just skip it
        foreach (array_keys($items[$cat_id]) as $item_id) {
            // In fontier, the item_id is "topic_id"
            $items_id[] = intval($item_id);
        }
    }
    array_unique($items_id);
    sort($items_id);
    $item_handler =& xoops_getmodulehandler('identities', 'fontier');
    $criteria = new Criteria("id", "(" . implode(", ", $items_id) . ")", "IN");
    $criteria->setOrder('`polling`');
    $criteria->setSort('DESC');
    $items_obj = $item_handler->getObjects($criteria, true);
    $myts =& MyTextSanitizer::getInstance();
    foreach (array_keys($items) as $cat_id) {
        foreach (array_keys($items[$cat_id]) as $item_id) {
            $item_obj =& $items_obj[$item_id];
            if (is_object($item_obj))
			$items[$cat_id][$item_id] = array(
                "title"     => $item_obj->getVar("name"),
                "uid"       => 0,
                "link"      => "font.php?id={$item_id}",
                "time"      => $item_obj->getVar("polling"),
                "tags"      => tag_parse_tag($item_obj->getVar("tags", "n")),
                "content"   => $item_obj->getDescriptionTile()
                );
        }
    }
    unset($items_obj);    
}

/**
 * Remove orphan tag-item links
 *
 * @return    boolean
 * 
 */
function fontier_tag_synchronization($mid)
{
}

?>