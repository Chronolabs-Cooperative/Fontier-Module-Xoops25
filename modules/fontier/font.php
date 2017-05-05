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
	
	if (!isset($_GET['id']))
	{
		redirect_header(XOOPS_URL . '/modules/'._MD_FONTIER_MODULE_DIRNAME.'/index.php', 4, _ERR_FONTIER_PREVIEW_NOIDSPECIFIED);
		exit(0);
	}
	
	$identitiesHandler= xoops_getModuleHandler('identities',_MD_FONTIER_MODULE_DIRNAME);
	
	if (!$font = $identitiesHandler->get($_GET['id']) || (!empty($font) && $font->getVar('identity') == "" && $font->getVar('polled') == 0))
	{
		redirect_header(XOOPS_URL . '/modules/'._MD_FONTIER_MODULE_DIRNAME.'/index.php', 4, _ERR_FONTIER_PREVIEW_IDNOTFOUND);
		exit(0);
	}
	
	if ($fontierConfigsList['htaccess']) {
		if (!strpos($font->getFontURL('id'), $_SERVER['REQUEST_URI'])) {
			header('Location: ' . $font->getFontURL('id'));
			exit(0);
		}
	}

	$xoopsOption['template_main'] = 'fontier_font.html';
	include $GLOBALS['xoops']->path('/header.php');		
	$GLOBALS['xoTheme']->addScript(XOOPS_URL . "/browse.php?Frameworks/jquery/jquery.js");
	$GLOBALS['xoTheme']->addScript(XOOPS_URL . "/browse.php?Frameworks/jquery/jquery.ui.js");
	$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . "/modules/" . _MD_FONTIER_MODULE_DIRNAME . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/style.css');
	
	$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', 'Font: ' . $font->getVar('name'));
	$GLOBALS['xoopsTpl']->assign('name', $font->getVar('name'));
	$GLOBALS['xoopsTpl']->assign('views', $font->getVar('views'));
	$GLOBALS['xoopsTpl']->assign('downloads', $font->getVar('downloads'));
	$GLOBALS['xoopsTpl']->assign('diz', $font->getVar('diz'));
	$GLOBALS['xoopsTpl']->assign('css', $font->getVar('css'));
	$GLOBALS['xoopsTpl']->assign('css_url', $font->getCSSURL());
	$GLOBALS['xoopsTpl']->assign('preview', $font->getPreviewURL($fontierConfigsList['image_format']));
	$GLOBALS['xoopsTpl']->assign('naming', $font->getNamingURL($fontierConfigsList['image_format']));
	$GLOBALS['xoopsTpl']->assign('downloading', $font->getDownloadURLsArray(explode(",",$fontierConfigsList['download_formats']), ucwords(strtolower($font->getVar('name')))));
	$GLOBALS['xoopsTpl']->assign('glyphs', $font->getGlyphsURLArray($fontierConfigsList['image_format']));
	$GLOBALS['xoopsTpl']->assign('randoms', $identitiesHandler->getRandoms($font->getVar('thirds'), 6));
	include $GLOBALS['xoops']->path('/footer.php');
	$font->addViewCount(1);
	$identitiesHandler->insert($font);
	exit(0);
		
?>