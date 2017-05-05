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

	
	if (!defined(_MD_FONTIER_MODULE_DIRNAME))
		define('_MD_FONTIER_MODULE_DIRNAME', basename(__DIR__));
		
	require_once dirname(dirname(__DIR__)).'/mainfile.php';
	
	xoops_loadLanguage('errors', _MD_FONTIER_MODULE_DIRNAME);
	
	error_reporting(E_ERROR);
	ini_set('display_errors', true);
	
	/**
	 * Opens Access Origin Via networking Route NPN
	*/
	header('Access-Control-Allow-Origin: *');
	header('Origin: *');
	
	/**
	 * Turns of GZ Lib Compression for Document Incompatibility
	 */
	ini_set("zlib.output_compression", 'Off');
	ini_set("zlib.output_compression_level", -1);
	
	require_once __DIR__.'/include/functions.php';
	
	global $fontierModule, $fontierConfigsList, $fontierConfigs, $fontierConfigsOptions;
	
	if (empty($fontierModule))
	{
		if (is_a($fontierModule = xoops_gethandler('module')->getByDirname(_MD_FONTIER_MODULE_DIRNAME), "XoopsModule"))
		{
			if (empty($fontierConfigsList))
			{
				$fontierConfigsList = xoops_gethandler('config')->getConfigList($fontierModule->getVar('mid'));
			}
			if (empty($fontierConfigs))
			{
				$fontierConfigs = xoops_gethandler('config')->getConfigs(new Criteria('conf_modid', $fontierModule->getVar('mid')));
			}
			if (empty($fontierConfigsOptions) && !empty($fontierConfigs))
			{
				foreach($fontierConfigs as $key => $config)
					$fontierConfigsOptions[$config->getVar('conf_name')] = $config->getConfOptions();
			}
		}
	}
	
	require_once(__DIR__ . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'functions.php');	