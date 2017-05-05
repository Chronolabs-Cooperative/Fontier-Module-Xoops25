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

if (!defined('XOOPS_ROOT_PATH')) {
	die('XOOPS root path not defined');
}

if (!defined(_MD_FONTIER_MODULE_DIRNAME))
	define('_MD_FONTIER_MODULE_DIRNAME', basename(__DIR__));
	
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

$modversion['dirname'] 					= _MD_FONTIER_MODULE_DIRNAME;
$modversion['name'] 					= _MD_FONTIER_MODULE_NAME;
$modversion['version']     				= _MD_FONTIER_MODULE_VERSION;
$modversion['releasedate'] 				= _MD_FONTIER_MODULE_RELEASEDATE;
$modversion['status']      				= _MD_FONTIER_MODULE_STATUS;
$modversion['description'] 				= _MD_FONTIER_MODULE_DESCRIPTION;
$modversion['credits']     				= _MD_FONTIER_MODULE_CREDITS;
$modversion['author']      				= _MD_FONTIER_MODULE_AUTHORALIAS;
$modversion['help']        				= _MD_FONTIER_MODULE_HELP;
$modversion['license']     				= _MD_FONTIER_MODULE_LICENCE;
$modversion['official']    				= _MD_FONTIER_MODULE_OFFICAL;
$modversion['image']       				= _MD_FONTIER_MODULE_ICON;
$modversion['module_status'] 			= _MD_FONTIER_MODULE_STATUS;
$modversion['website'] 					= _MD_FONTIER_MODULE_WEBSITE;
$modversion['dirmoduleadmin'] 			= _MD_FONTIER_MODULE_ADMINMODDIR;
$modversion['icons16'] 					= _MD_FONTIER_MODULE_ADMINICON16;
$modversion['icons32'] 					= _MD_FONTIER_MODULE_ADMINICON32;
$modversion['release_info'] 			= _MD_FONTIER_MODULE_RELEASEINFO;
$modversion['release_file'] 			= _MD_FONTIER_MODULE_RELEASEFILE;
$modversion['release_date'] 			= _MD_FONTIER_MODULE_RELEASEDATE;
$modversion['author_realname'] 			= _MD_FONTIER_MODULE_AUTHORREALNAME;
$modversion['author_website_url'] 		= _MD_FONTIER_MODULE_AUTHORWEBSITE;
$modversion['author_website_name'] 		= _MD_FONTIER_MODULE_AUTHORSITENAME;
$modversion['author_email'] 			= _MD_FONTIER_MODULE_AUTHOREMAIL;
$modversion['author_word'] 				= _MD_FONTIER_MODULE_AUTHORWORD;
$modversion['status_version'] 			= _MD_FONTIER_MODULE_VERSION;
$modversion['warning'] 					= _MD_FONTIER_MODULE_WARNINGS;
$modversion['demo_site_url'] 			= _MD_FONTIER_MODULE_DEMO_SITEURL;
$modversion['demo_site_name'] 			= _MD_FONTIER_MODULE_DEMO_SITENAME;
$modversion['support_site_url'] 		= _MD_FONTIER_MODULE_SUPPORT_SITEURL;
$modversion['support_site_name'] 		= _MD_FONTIER_MODULE_SUPPORT_SITENAME;
$modversion['submit_feature'] 			= _MD_FONTIER_MODULE_SUPPORT_FEATUREREQUEST;
$modversion['submit_bug'] 				= _MD_FONTIER_MODULE_SUPPORT_BUGREPORTING;
$modversion['people']['developers'] 	= explode("|", _MD_FONTIER_MODULE_DEVELOPERS);
$modversion['people']['testers']		= explode("|", _MD_FONTIER_MODULE_TESTERS);
$modversion['people']['translaters']	= explode("|", _MD_FONTIER_MODULE_TRANSLATERS);
$modversion['people']['documenters']	= explode("|", _MD_FONTIER_MODULE_DOCUMENTERS);

// Requirements
$modversion['min_php']        			= '7.0';
$modversion['min_xoops']      			= '2.5.8';
$modversion['min_db']         			= array('mysql' => '5.0.7', 'mysqli' => '5.0.7');
$modversion['min_admin']      			= '1.1';

// Database SQL File and Tables
$modversion['sqlfile']['mysql'] 		= "sql/mysql.sql";
$modversion['tables']	 				= explode("\n", file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'tables.diz'));

//Search
$modversion['hasSearch'] 				= _MD_FONTIER_MODULE_HASSEARCH;
//$modversion['search']['file'] 		= "include/search.inc.php";
//$modversion['search']['func'] 		= "publisher_search";

// Main
$modversion['hasMain'] 					= _MD_FONTIER_MODULE_HASMAIN;

// Admin
$modversion['hasAdmin'] 				= _MD_FONTIER_MODULE_HASADMIN;
$modversion['adminindex']  				= "admin/index.php";
$modversion['adminmenu']   				= "admin/menu.php";
$modversion['system_menu'] 				= 1;

// Comments
$modversion['hasComments'] 				= _MD_FONTIER_MODULE_HASCOMMENTS;
$modversion['comments']['itemName'] = 'id';
$modversion['comments']['pageName'] = 'font.php';
$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'fontier_com_approve';
$modversion['comments']['callback']['update']  = 'fontier_com_update';

// Add extra menu items
$modversion['sub'][1]['name'] = _MD_FONTIER_MENU_UPLOADS;
$modversion['sub'][1]['url']  = "uploads.php";
$modversion['sub'][2]['name'] = _MD_FONTIER_MENU_RELEASES;
$modversion['sub'][2]['url']  = "releases.php";

// Create Block Constant Defines
$i = 0;
++$i;
$modversion['blocks'][$i]['file']        = "new_items.php";
$modversion['blocks'][$i]['name']        = _MD_FONTIER_NEW_FONTS;
$modversion['blocks'][$i]['description'] = _MD_FONTIER_NEW_FONTS_DESC;
$modversion['blocks'][$i]['show_func']   = "fontier_new_items_show";
$modversion['blocks'][$i]['edit_func']   = "fontier_new_items_edit";
$modversion['blocks'][$i]['options']     = "5|naming";
$modversion['blocks'][$i]['template']    = "fontier_new_items.html";
++$i;
$modversion['blocks'][$i]['file']        = "popular_items.php";
$modversion['blocks'][$i]['name']        = _MD_FONTIER_POPULAR_FONTS;
$modversion['blocks'][$i]['description'] = _MD_FONTIER_POPULAR_FONTS_DESC;
$modversion['blocks'][$i]['show_func']   = "fontier_popular_items_show";
$modversion['blocks'][$i]['edit_func']   = "fontier_popular_items_edit";
$modversion['blocks'][$i]['options']     = "5|naming";
$modversion['blocks'][$i]['template']    = "fontier_popular_items.html";
++$i;
$modversion['blocks'][$i]['file']        = "popular_downloads_items.php";
$modversion['blocks'][$i]['name']        = _MD_FONTIER_POPULAR_FONTS_DOWNLOADED;
$modversion['blocks'][$i]['description'] = _MD_FONTIER_POPULAR_FONTS_DOWNLOADED_DESC;
$modversion['blocks'][$i]['show_func']   = "fontier_popular_downloads_items_show";
$modversion['blocks'][$i]['edit_func']   = "fontier_popular_downloads_items_edit";
$modversion['blocks'][$i]['options']     = "5|naming";
$modversion['blocks'][$i]['template']    = "fontier_popular_downloads_items.html";
++$i;
$modversion['blocks'][$i]['file']        = "last_viewed_items.php";
$modversion['blocks'][$i]['name']        = _MD_FONTIER_LAST_FONTS_VIEWED;
$modversion['blocks'][$i]['description'] = _MD_FONTIER_LAST_FONTS_VIEWED_DESC;
$modversion['blocks'][$i]['show_func']   = "fontier_last_viewed_items_show";
$modversion['blocks'][$i]['edit_func']   = "fontier_last_viewed_items_edit";
$modversion['blocks'][$i]['options']     = "5|naming";
$modversion['blocks'][$i]['template']    = "fontier_last_viewed_items.html";
++$i;
$modversion['blocks'][$i]['file']        = "last_downloads_items.php";
$modversion['blocks'][$i]['name']        = _MD_FONTIER_LAST_FONTS_DOWNLOADED;
$modversion['blocks'][$i]['description'] = _MD_FONTIER_LAST_FONTS_DOWNLOADED_DESC;
$modversion['blocks'][$i]['show_func']   = "fontier_last_downloads_items_show";
$modversion['blocks'][$i]['edit_func']   = "fontier_last_downloads_items_edit";
$modversion['blocks'][$i]['options']     = "5|naming";
$modversion['blocks'][$i]['template']    = "fontier_last_downloads_items.html";
++$i;
$modversion['blocks'][$i]['file']        = "fontier_block_tag.php";
$modversion['blocks'][$i]['name']        = _MD_FONTIER_TAG_BLOCK_CLOUD;
$modversion['blocks'][$i]['description'] = _MD_FONTIER_TAG_BLOCK_CLOUD_DESC;
$modversion['blocks'][$i]['show_func']   = "fontier_tag_block_cloud_show";
$modversion['blocks'][$i]['edit_func']   = "fontier_tag_block_cloud_edit";
$modversion['blocks'][$i]['options']     = "100|0|150|80";
$modversion['blocks'][$i]['template']    = "fontier_tag_block_cloud.html";
++$i;
$modversion['blocks'][$i]['file']        = "fontier_block_tag.php";
$modversion['blocks'][$i]['name']        = _MD_FONTIER_TAG_BLOCK_TOP;
$modversion['blocks'][$i]['description'] = _MD_FONTIER_TAG_BLOCK_TOP_DESC;
$modversion['blocks'][$i]['show_func']   = "fontier_tag_block_top_show";
$modversion['blocks'][$i]['edit_func']   = "fontier_tag_block_top_edit";
$modversion['blocks'][$i]['options']     = "50|30|c";
$modversion['blocks'][$i]['template']    = "fontier_tag_block_top.html";

// Templates
$i = 0;
$i++;
$modversion['templates'][$i]['file'] = 'fontier_index.html';
$modversion['templates'][$i]['description'] = 'Fontier+ Index';
$i++;
$modversion['templates'][$i]['file'] = 'fontier_index_base.html';
$modversion['templates'][$i]['description'] = 'Fontier+ Index';
$i++;
$modversion['templates'][$i]['file'] = 'fontier_font.html';
$modversion['templates'][$i]['description'] = 'Fontier+ Font Item';
$i++;
$modversion['templates'][$i]['file'] = 'fontier_uploads.html';
$modversion['templates'][$i]['description'] = 'Fontier+ Fonts Uploads';
$i++;
$modversion['templates'][$i]['file'] = 'fontier_releases.html';
$modversion['templates'][$i]['description'] = 'Fontier+ releases Subscription';

// Config categories
$modversion['configcat']['seo']['name']        = _MD_FONTIER_CONFCAT_SEO;
$modversion['configcat']['seo']['description'] = _MD_FONTIER_CONFCAT_SEO_DESC;

$modversion['configcat']['mod']['name']        = _MD_FONTIER_CONFCAT_MODULE;
$modversion['configcat']['mod']['description'] = _MD_FONTIER_CONFCAT_MODULE_DESC;

$modversion['configcat']['api']['name']        = _MD_FONTIER_CONFCAT_API;
$modversion['configcat']['api']['description'] = _MD_FONTIER_CONFCAT_API_DESC;
$i=0;

++$i;
$modversion['config'][$i]['name']        = 'htaccess';
$modversion['config'][$i]['title']       = '_MD_FONTIER_HTACCESS';
$modversion['config'][$i]['description'] = '_MD_FONTIER_HTACCESS_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = false;
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'seo';
++$i;
$modversion['config'][$i]['name']        = 'base';
$modversion['config'][$i]['title']       = '_MD_FONTIER_BASE';
$modversion['config'][$i]['description'] = '_MD_FONTIER_BASE_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'fontier+';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'seo';
++$i;
$modversion['config'][$i]['name']        = 'html';
$modversion['config'][$i]['title']       = '_MD_FONTIER_HTML';
$modversion['config'][$i]['description'] = '_MD_FONTIER_HTML_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'html';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'seo';
++$i;
$modversion['config'][$i]['name']        = 'images';
$modversion['config'][$i]['title']       = '_MD_FONTIER_IMAGES';
$modversion['config'][$i]['description'] = '_MD_FONTIER_IMAGES_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'select';
$modversion['config'][$i]['default']     = 'png';
$modversion['config'][$i]['options']     = array('png'=>'png', 'jpg'=>'jpg', 'gif'=>'gif');
$modversion['config'][$i]['category']    = 'seo';
++$i;
$modversion['config'][$i]['name']        = 'tags';
$modversion['config'][$i]['title']       = '_MD_FONTIER_TAGS';
$modversion['config'][$i]['description'] = '_MD_FONTIER_TAGS_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = false;
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'mod';
++$i;
$modversion['config'][$i]['name']        = 'schedule';
$modversion['config'][$i]['title']       = '_MD_FONTIER_SCHEDULE';
$modversion['config'][$i]['description'] = '_MD_FONTIER_SCHEDULE_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'select';
$modversion['config'][$i]['default']     = 'preloaders';
$modversion['config'][$i]['options']     = array('preloaders'=>'preloaders', 'cronjob'=>'cronjob');
$modversion['config'][$i]['category']    = 'mod';
++$i;
$modversion['config'][$i]['name']        = 'poll_identities';
$modversion['config'][$i]['title']       = '_MD_FONTIER_POLL_IDENTITIES';
$modversion['config'][$i]['description'] = '_MD_FONTIER_POLL_IDENTITIES_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '3600';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'mod';
++$i;
$modversion['config'][$i]['name']        = 'poll_items';
$modversion['config'][$i]['title']       = '_MD_FONTIER_POLL_FONTS';
$modversion['config'][$i]['description'] = '_MD_FONTIER_POLL_FONTS_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '180';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'mod';
++$i;
$modversion['config'][$i]['name']        = 'num_polled_items';
$modversion['config'][$i]['title']       = '_MD_FONTIER_NUMBER_POLLED_FONTS';
$modversion['config'][$i]['description'] = '_MD_FONTIER_NUMBER_POLLED_FONTS_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '21';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'mod';
++$i;
$modversion['config'][$i]['name']        = 'poll_glyphs';
$modversion['config'][$i]['title']       = '_MD_FONTIER_POLL_GLYPHS';
$modversion['config'][$i]['description'] = '_MD_FONTIER_POLL_GLYPHS_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '360';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'mod';
++$i;
$modversion['config'][$i]['name']        = 'num_glyphs_items';
$modversion['config'][$i]['title']       = '_MD_FONTIER_NUMBER_POLLED_GLYPHS';
$modversion['config'][$i]['description'] = '_MD_FONTIER_NUMBER_POLLED_GLYPHS_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '21';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'mod';
++$i;
$modversion['config'][$i]['name']        = 'cache_preview';
$modversion['config'][$i]['title']       = '_MD_FONTIER_CACHE_PREVIEW';
$modversion['config'][$i]['description'] = '_MD_FONTIER_CACHE_PREVIEW_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '8444';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'mod';
++$i;
$modversion['config'][$i]['name']        = 'cache_naming';
$modversion['config'][$i]['title']       = '_MD_FONTIER_CACHE_NAMING';
$modversion['config'][$i]['description'] = '_MD_FONTIER_CACHE_NAMING_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '8444';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'mod';
++$i;
$modversion['config'][$i]['name']        = 'cache_glyphs';
$modversion['config'][$i]['title']       = '_MD_FONTIER_CACHE_GLYPHS';
$modversion['config'][$i]['description'] = '_MD_FONTIER_CACHE_GLYPHS_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '8444';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'mod';
++$i;
$modversion['config'][$i]['name']        = 'cache_forms';
$modversion['config'][$i]['title']       = '_MD_FONTIER_CACHE_FORMS';
$modversion['config'][$i]['description'] = '_MD_FONTIER_CACHE_FORMS_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '600';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'mod';
++$i;
$modversion['config'][$i]['name']        = 'download_formats';
$modversion['config'][$i]['title']       = '_MD_FONTIER_DOWNLOAD_FORMATS';
$modversion['config'][$i]['description'] = '_MD_FONTIER_DOWNLOAD_FORMATS_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '7z,ar,bz2,gz,lzma,lz,lzo,tar,tar.7z,tar.Z,tar.bz2,tar.gz,tar.lz,tar.lzma,tar.lzo,tar.xz,tgz,zip,rar,rar5,exe,zoo,zx';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'mod';
++$i;
$modversion['config'][$i]['name']        = 'api_path';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_PATH';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_PATH_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_path_preview';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_PATH_PREVIEW';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_PATH_PREVIEW_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '%apipath%/v2/font/%identity%/preview/%format%.api';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_path_naming';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_PATH_NAMING';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_PATH_NAMING_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '%apipath%/v2/font/%identity%/naming/%format%.api';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_path_glyphs';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_PATH_GLYPHS';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_PATH_GLYPHS_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '%apipath%/v2/font/%identity%/glyph/%char%/%format%.api';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_path_css';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_PATH_CSS';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_PATH_CSS_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '%apipath%/v2/font/%identity%/css.api';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_path_download';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_PATH_DOWNLOAD';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_PATH_DOWNLOAD_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '%apipath%/v2/data/%identity%/%pack%/download.api';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_path_diz';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_PATH_DIZ';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_PATH_DIZ_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '%apipath%/v2/data/%identity%/diz.api';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_path_json';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_PATH_JSON';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_PATH_JSON_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '%apipath%/v2/data/%identity%/json.api';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_path_json_identities';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_PATH_JSON_IDENTITIES';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_PATH_JSON_IDENTITIES_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '%apipath%/v2/identities/json.api';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_path_uploads_form';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_PATH_UPLOADS_FORM';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_PATH_UPLOADS_FORM_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '%apipath%/v2/uploads/forms.api';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_path_releases_form';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_PATH_RELEASES_FORM';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_PATH_RELEASES_FORM_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '%apipath%/v2/releases/forms.api';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_min_sleep';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_MIN_SLEEP';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_MIN_SLEEP_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '1';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_max_sleep';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_MAX_SLEEP';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_MAX_SLEEP_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '13';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_curl_timeout';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_CURL_TIMEOUT';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_CURL_TIMEOUT_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '720';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';
++$i;
$modversion['config'][$i]['name']        = 'api_curl_connection';
$modversion['config'][$i]['title']       = '_MD_FONTIER_API_CURL_CONNECTION';
$modversion['config'][$i]['description'] = '_MD_FONTIER_API_CURL_CONNECTION_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '840';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'api';


// Notification
$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'fontier_notify_iteminfo';

$modversion['notification']['category'][1]['name'] = 'global';
$modversion['notification']['category'][1]['title'] = _MD_FONTIER_GLOBAL_NOTIFY;
$modversion['notification']['category'][1]['description'] = _MD_FONTIER_GLOBAL_NOTIFY_DESC;
$modversion['notification']['category'][1]['subscribe_from'] = array('index.php', 'font.php');

$modversion['notification']['event'][1]['name'] = 'new_index';
$modversion['notification']['event'][1]['category'] = 'global';
$modversion['notification']['event'][1]['title'] = _MD_FONTIER_GLOBAL_NEWINDEX_NOTIFY;
$modversion['notification']['event'][1]['caption'] = _MD_FONTIER_GLOBAL_NEWINDEX_NOTIFY_CAPTION;
$modversion['notification']['event'][1]['description'] = _MD_FONTIER_GLOBAL_NEWINDEX_NOTIFY_DESC;
$modversion['notification']['event'][1]['mail_template'] = 'fontier_newindex_notify';
$modversion['notification']['event'][1]['mail_subject'] = _MD_FONTIER_GLOBAL_NEWINDEX_NOTIFY_SUBJECT;

$modversion['notification']['event'][3]['name'] = 'new_font';
$modversion['notification']['event'][3]['category'] = 'global';
$modversion['notification']['event'][3]['title'] = _MD_FONTIER_GLOBAL_NEWFONT_NOTIFY;
$modversion['notification']['event'][3]['caption'] = _MD_FONTIER_GLOBAL_NEWFONT_NOTIFY_CAPTION;
$modversion['notification']['event'][3]['description'] = _MD_FONTIER_GLOBAL_NEWFONT_NOTIFY_DESC;
$modversion['notification']['event'][3]['mail_template'] = 'fontier_newfont_notify';
$modversion['notification']['event'][3]['mail_subject'] = _MD_FONTIER_GLOBAL_NEWFONT_NOTIFY_SUBJECT;

?>