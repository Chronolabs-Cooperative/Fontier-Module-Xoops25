<?php
/**
 * Please Email Ticketer of Batch Group & User Emails
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
 * @subpackage  	please
 * @description 	Email Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
 * @version			1.0.5
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/please
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.6/Modules/please
 * @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/please
 * @link			http://internetfounder.wordpress.com
 */

	require_once (__DIR__ . DIRECTORY_SEPARATOR . 'header.php');
	
	if (isset($_REQUEST['start']) && is_numeric($_REQUEST['start']))
		$start = intval($_REQUEST['start']);
	else 
		$start = 0;
	
	if (isset($_REQUEST['limit']) && is_numeric($_REQUEST['limit']))
		$limit = intval($_REQUEST['limit']);
	else
		$limit = 30;
	
	$identitiesHandler = xoops_getModuleHandler('identities', _MD_FONTIER_MODULE_DIRNAME);
	$criteria = new Criteria('polled',0,">");
	$criteria->setOrder('`polled`');
	$criteria->setSort('DESC');
	$total = $identitiesHandler->getCount($criteria);
	$criteria->setLimit($start);
	$criteria->setLimit($limit);
	$identities = $identitiesHandler->getObjects($criteria);
	
	if ($start>0 && count($identities)==0 && $total > 0)
	{
		$start = $start - $limit;
		if ($start<0)
			$start = 0;
		header("Location: " . XOOPS_URL . "/modules/" . _MD_FONTIER_MODULE_DIRNAME . "/admin/identities.php?start=$start&limit=$limit");
		exit(0);
	}
	
	if ($start == 0 && count($identities) == 0)
	{
		redirect_header(XOOPS_URL . "/modules/" . _MD_FONTIER_MODULE_DIRNAME . "/admin/index.php", 4, _ERR_FONTIER_ADMIN_NOFONTS);
		exit(0);
	}
	
	xoops_cp_header();
	$identityAdmin = new ModuleAdmin();
	echo $identityAdmin->addNavigation(basename(__FILE__));
	foreach($identities as $identity)
		$GLOBALS['xoopsTpl']->append('identities', $identity->getAdminPanelArray());
	xoops_load('XoopsPageNav');
	$nav = new XoopsPageNav($total, $limit, $start, 'start', '&limit='.$limit);
	$GLOBALS['xoopsTpl']->assign('pagenav', $nav->renderNav(5));
	echo $GLOBALS['xoopsTpl']->display(dirname(__DIR__) . '/templates/admin/fontier_identities.html');
	xoops_cp_footer();
	exit(0);
		
?>