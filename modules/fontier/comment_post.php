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

//  ------------------------------------------------------------------------ //
include_once 'header.php';

// We verify that the user can post comments **********************************
if(!isset($xoopsModuleConfig)) {
	die();
}

if($xoopsModuleConfig['com_rule'] == 0) {	// Comments are deactivate
	die();
}

if($xoopsModuleConfig['com_anonpost'] == 0 && !is_object($xoopsUser)) {	// Anonymous users can't post
	die();
}
// ****************************************************************************
include_once XOOPS_ROOT_PATH.'/include/comment_post.php';
?>