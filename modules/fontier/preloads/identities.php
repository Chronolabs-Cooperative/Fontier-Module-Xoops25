<?php
/**
 * System Preloads
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author      Simon Roberts (AKA +61405130385)
 * @version     $Id: xortify.php 8066 2011-11-06 05:09:33Z beckmi $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

class FontierIdentitiesPreload extends XoopsPreloadItem
{

	
	function eventCoreFooterEnd($args)
	{
		require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'header.php';
		
		global $fontierConfigsList;
		
		xoops_load("XoopsCache");
		
		if (!$time = XoopsCache::read("preloader-identities") && $fontierConfigsList['schedule'] == 'preloaders')
		{
			require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'crons' . DIRECTORY_SEPARATOR . 'identities.php';
			XoopsCache::write("preloader-identities", array('time'=>time()), $fontierConfigsList['poll_identities']);
		}
		
	}
}

?>
