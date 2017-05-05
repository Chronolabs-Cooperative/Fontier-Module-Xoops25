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

	
	require_once (__DIR__ . DIRECTORY_SEPARATOR . 'header.php');
	set_time_limit(8444);
	
	global $fontierConfigsList;

	$start = !isset($_GET['start'])?0:(integer)$_GET['start'];
	$limit = !isset($_GET['limit'])?30:(integer)$_GET['limit'];
	$base = !isset($_GET['base'])?null:(string)$_GET['base'];
	
	if ($fontierConfigsList['htaccess']) {
		
		if (is_null($base))
		{
			$url = XOOPS_URL . '/' . $fontierConfigsList['base'] . '/index.html';
			if (!strpos($url, $_SERVER['REQUEST_URI'])) {
				header('Location: ' . $url);
				exit(0);
			}
		} else {
			$url = XOOPS_URL . '/' . $fontierConfigsList['base'] . "/$start/$limit/$base/index.html";
			if (!strpos($url, $_SERVER['REQUEST_URI'])) {
				header('Location: ' . $url);
				exit(0);
			}
		}
		
	}

	if (is_null($base))
	{
		$xoopsOption['template_main'] = 'fontier_index.html';
		include $GLOBALS['xoops']->path('/header.php');		
		$GLOBALS['xoTheme']->addScript(XOOPS_URL . "/browse.php?Frameworks/jquery/jquery.js");
		$GLOBALS['xoTheme']->addScript(XOOPS_URL . "/browse.php?Frameworks/jquery/jquery.ui.js");
		$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . "/modules/" . _MD_FONTIER_MODULE_DIRNAME . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/style.css');
		$indexesHandler= xoops_getModuleHandler('indexes',_MD_FONTIER_MODULE_DIRNAME);
		$GLOBALS['xoopsTpl']->assign('bases', $indexesHandler->getBases($base));
		$indentitiesHandler= xoops_getModuleHandler('identities',_MD_FONTIER_MODULE_DIRNAME);
		$GLOBALS['xoopsTpl']->assign('randoms', $indentitiesHandler->getRandoms($base, $limit));
		include $GLOBALS['xoops']->path('/footer.php');
		exit(0);
	} else {
		$xoopsOption['template_main'] = 'fontier_index_base.html';
		include $GLOBALS['xoops']->path('/header.php');
		$GLOBALS['xoTheme']->addScript(XOOPS_URL . "/browse.php?Frameworks/jquery/jquery.js");
		$GLOBALS['xoTheme']->addScript(XOOPS_URL . "/browse.php?Frameworks/jquery/jquery.ui.js");
		$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . "/modules/" . _MD_FONTIER_MODULE_DIRNAME . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/style.css');
		$indexesHandler= xoops_getModuleHandler('indexes',_MD_FONTIER_MODULE_DIRNAME);
		$GLOBALS['xoopsTpl']->assign('bases', $indexesHandler->getBases($base));
		$indentitiesHandler= xoops_getModuleHandler('identities',_MD_FONTIER_MODULE_DIRNAME);
		$GLOBALS['xoopsTpl']->assign('randoms', $indentitiesHandler->getRandoms($base, 3));
		$GLOBALS['xoopsTpl']->assign('fonts', $indentitiesHandler->getFonts($base, $start, $limit));
		xoops_load('XoopsPageNav');
		$nav = new XoopsPageNav($indentitiesHandler->getFontsCount($base), $limit, $start, 'start', '&base='.$base.'&limit='.$limit);
		$GLOBALS['xoopsTpl']->assign('pagenav', $nav->renderNav(5));
		$GLOBALS['xoopsTpl']->assign('breadcrumb', $indexesHandler->getBreadcrumb($base));
		include $GLOBALS['xoops']->path('/footer.php');
		exit(0);
	}
		
?>