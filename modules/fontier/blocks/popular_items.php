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

function fontier_popular_items_show($options)
{
	$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . "/modules/" . _MD_FONTIER_MODULE_DIRNAME . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/blocks.css');
	
	$block = array('display' => $options[1]);
	$identitiesHandler = xoops_getModuleHandler('identities' ,basename(dirname(__DIR__)));
	$criteria = new CriteriaCompo(new Criteria('views', '0', '>'));
	$criteria->setOrder('DESC');
	$criteria->setSort('views');
	$criteria->setLimit($options[0]);
	if ($identities = $identitiesHandler->getObjects($criteria))
	{
		$block['items'] = array();
		foreach($identities as $key => $identity)
		{
			$block['items'][$key]['name'] = $identity->getVar('name');
			$block['items'][$key]['views'] = $identity->getVar('views');
			$block['items'][$key]['downloads'] = $identity->getVar('downloads');
			$block['items'][$key]['naming'] = $identity->getNamingURL();
			$block['items'][$key]['url'] = $identity->getFontURL('id');
		}
		return $block;
	}
	return false;
}


function fontier_popular_items_edit($options)
{
	$form = '';
	// Sort order *************************************************************
	// (0=older first, 1=newer first)
	$form .= '<b>'._MB_FONTIER_NUMBER."</b>&nbsp;<input type='textbox' name='option[]' size='8', maxlen='4' value='".$options[0]."' /><br/>";
	$form .= '<b>'._MB_FONTIER_DISPLAY."</b>&nbsp;<select name='options[]'>\n";
	$form .= "<option value='naming'";
	if ( $options[1] == 'naming' ) {
		$form .= " selected='selected'";
	}
	$form .= '>'._MB_FONTIER_NAMING."</option>\n";
	$form .= "<option value='text'";
	if($options[1] == 'text'){
		$form .= " selected='selected'";
	}
	$form .= '>'._MB_FONTIER_TEXT.'</option>';
	$form .= "</select>\n";
	return $form;
}
