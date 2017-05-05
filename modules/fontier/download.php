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
	
	if (!isset($_GET['pack']))
	{
		redirect_header(XOOPS_URL . '/modules/'._MD_FONTIER_MODULE_DIRNAME.'/index.php', 4, _ERR_FONTIER_ARCHIVE_NOPACKSPECIFIED);
		exit(0);
	}
	
	$identitiesHandler= xoops_getModuleHandler('identities',_MD_FONTIER_MODULE_DIRNAME);
	
	if (!$font = $identitiesHandler->get($_GET['id']) || (!empty($font) && $font->getVar('identity') == "" && $font->getVar('polled') == 0))
	{
		redirect_header(XOOPS_URL . '/modules/'._MD_FONTIER_MODULE_DIRNAME.'/index.php', 4, _ERR_FONTIER_PREVIEW_IDNOTFOUND);
		exit(0);
	}
	
	// API Load Balancing
	if ($fontierConfigsList['api_min_sleep']>0 && $fontierConfigsList['api_max_sleep']>0 && $fontierConfigsList['api_min_sleep']<$fontierConfigsList['api_max_sleep'])
		sleep(mt_rand($fontierConfigsList['api_min_sleep'], $fontierConfigsList['api_max_sleep']));
		
	$font->addDownloadCount(1);
	$identitiesHandler->insert($font);
	header('Location: ' . str_replace("%apipath%", $fontierConfigsList['api_path'], str_replace("%identity%", $font->getVar('identity'), str_replace("%pack%", $_GET['pack'], $fontierConfigsList['api_path_download']))));
	exit(0);


?>