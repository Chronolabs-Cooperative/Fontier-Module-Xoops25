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
	
	require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'header.php';
	
	set_time_limit(8444);
	
	global $fontierConfigsList;
	
	$identitiesHandler= xoops_getModuleHandler('identities',_MD_FONTIER_MODULE_DIRNAME);
	
	if (!empty($fontierConfigsList['api_path']))
	{
		$data = json_decode(getURIData(str_replace("%apipath%", $fontierConfigsList['api_path'], $fontierConfigsList['api_path_json_identities'])), true);
		if (!empty($data)) {
			foreach($data as $identity)
			{
				$criteria = new Criteria('identity', $identity, 'LIKE');
				if ($identitiesHandler->getCount($criteria) == 0)
				{
					$obj = $identitiesHandler->create();
					$obj->setVar('identity', $identity);
					$identitiesHandler->insert($obj, true);
				}
			}
		}
	}