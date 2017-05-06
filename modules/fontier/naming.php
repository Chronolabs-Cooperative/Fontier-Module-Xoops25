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
$GLOBALS['xoopsLogger']->activated = false;
set_time_limit(8444);

global $fontierConfigsList;

if (!isset($_GET['id']))
{
	redirect_header(XOOPS_URL . '/modules/'._MD_FONTIER_MODULE_DIRNAME.'/index.php', 4, _ERR_FONTIER_PREVIEW_NOIDSPECIFIED);
	exit(0);
}

if (!isset($_GET['format']))
{
	redirect_header(XOOPS_URL . '/modules/'._MD_FONTIER_MODULE_DIRNAME.'/index.php', 4, _ERR_FONTIER_IMAGE_NOFORMATPECIFIED);
	exit(0);
}

$identitiesHandler= xoops_getModuleHandler('identities',_MD_FONTIER_MODULE_DIRNAME);

if (!$identity = $identitiesHandler->get($_GET['id']))
{
	redirect_header(XOOPS_URL . '/modules/'._MD_FONTIER_MODULE_DIRNAME.'/index.php', 4, _ERR_FONTIER_PREVIEW_IDNOTFOUND);
	exit(0);
}

if ($fontierConfigsList['htaccess']) {
	if (!strpos($identity->getNamingURL('id', $_GET['format']), $_SERVER['REQUEST_URI'])) {
		header('Location: ' . $identity->getNamingURL('id', $_GET['format']));
		exit(0);
	}
}

header('Context-type: image/'.$_GET['format']);
xoops_load('XoopsCache');
if (!$data = XoopsCache::read($cachekey = _MD_FONTIER_MODULE_DIRNAME . "-naming-".md5($_GET['id'].$_GET['format'])))
{	
	// API Load Balancing
	if ($fontierConfigsList['api_min_sleep']>0 && $fontierConfigsList['api_max_sleep']>0 && $fontierConfigsList['api_min_sleep']<$fontierConfigsList['api_max_sleep'])
		sleep(mt_rand($fontierConfigsList['api_min_sleep'], $fontierConfigsList['api_max_sleep']));
	// Calls API
	$data = array('image'=>getURIData(str_replace("%apipath%", $fontierConfigsList['api_path'], str_replace("%identity%", $identity->getVar('identity'), str_replace("%format%", $_GET['format'], $fontierConfigsList['api_path_naming'])))));
	if (!empty($data) && $fontierConfigsList['cache_naming'] > 0)
	{
		XoopsCache::write($cachekey, $data, $fontierConfigsList['cache_naming']);
		$caches = XoopsCache::read(_MD_FONTIER_MODULE_DIRNAME . "-caches-session");
		if (!is_array($caches))
			$caches = array();
		$caches[$cachekey] = time() + $fontierConfigsList['cache_naming'];
		XoopsCache::write(_MD_FONTIER_MODULE_DIRNAME . "-caches-session", $caches, 60*60*24*90*128);
	}
}
die($data['image']);
exit(0);

?>