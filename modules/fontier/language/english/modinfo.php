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


// Admin Dashboard
define('_MD_FONTIER_ADMIN_STATISTICS','Font Conversion Statistics');
define('_MD_FONTIER_ADMIN_STATS_TOTALUPLOADS','Total Fonts Uploaded: %s');
define('_MD_FONTIER_ADMIN_STATS_TOTALDOWNLOADS','Total Packs Downloaded: %s');
define('_MD_FONTIER_ADMIN_STATS_TOTALDOWNLOADSMBS','Total Megabytes Downloaded: %s');
define('_MD_FONTIER_ADMIN_STATS_FILESINCACHE','Total Files in Cache: %s');
define('_MD_FONTIER_ADMIN_STATS_MBSINCACHE','Total Megabytes store in Cache: %s');
define('_MD_FONTIER_ADMIN_STATS_FILESINREPO','Total files in Repository: %s');
define('_MD_FONTIER_ADMIN_STATS_MBSINREPO','Total Megabytes in Repository: %s');

// Module Admin Menu
define('_MD_FONTIER_ADMINMENU_HOME','Fonts');
define('_MD_FONTIER_ADMINMENU_FONTS','Indexes');
define('_MD_FONTIER_ADMINMENU_ABOUT','Fontier+ About');

// Module definition headers for xoops_version.php
define('_MD_FONTIER_MODULE_NAME','Fontier+');
define('_MD_FONTIER_MODULE_VERSION','1.01');
define('_MD_FONTIER_MODULE_RELEASEDATE','01-05-2017');
define('_MD_FONTIER_MODULE_STATUS','release');
define('_MD_FONTIER_MODULE_DESCRIPTION','Font browser for Chronolabs Font API!');
define('_MD_FONTIER_MODULE_CREDITS','Mynamesnot, Wishcraft');
define('_MD_FONTIER_MODULE_AUTHORALIAS','wishcraft');
define('_MD_FONTIER_MODULE_HELP','page=help');
define('_MD_FONTIER_MODULE_LICENCE','gpl3+academic');
define('_MD_FONTIER_MODULE_OFFICAL','1');
define('_MD_FONTIER_MODULE_ICON','images/icons/module_fontier+.png');
define('_MD_FONTIER_MODULE_WEBSITE','http://au.syd.snails.email');
define('_MD_FONTIER_MODULE_ADMINMODDIR','/Frameworks/moduleclasses/moduleadmin');
define('_MD_FONTIER_MODULE_ADMINICON16','../../Frameworks/moduleclasses/icons/16');
define('_MD_FONTIER_MODULE_ADMINICON32','./../Frameworks/moduleclasses/icons/32');
define('_MD_FONTIER_MODULE_RELEASEINFO',__DIR__ . DIRECTORY_SEPARATOR . 'release.nfo');
define('_MD_FONTIER_MODULE_RELEASEXCODE',__DIR__ . DIRECTORY_SEPARATOR . 'release.xcode');
define('_MD_FONTIER_MODULE_RELEASEFILE','https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/fontier/xoops2.5_fontier_1.01.7z');
define('_MD_FONTIER_MODULE_AUTHORREALNAME','Simon Antony Roberts');
define('_MD_FONTIER_MODULE_AUTHORWEBSITE','http://internetfounder.wordpress.com');
define('_MD_FONTIER_MODULE_AUTHORSITENAME','Exhumations from the desks of Chronographics');
define('_MD_FONTIER_MODULE_AUTHOREMAIL','simon@snails.email');
define('_MD_FONTIER_MODULE_AUTHORWORD','');
define('_MD_FONTIER_MODULE_WARNINGS','');
define('_MD_FONTIER_MODULE_DEMO_SITEURL','');
define('_MD_FONTIER_MODULE_DEMO_SITENAME','');
define('_MD_FONTIER_MODULE_SUPPORT_SITEURL','');
define('_MD_FONTIER_MODULE_SUPPORT_SITENAME','');
define('_MD_FONTIER_MODULE_SUPPORT_FEATUREREQUEST','');
define('_MD_FONTIER_MODULE_SUPPORT_BUGREPORTING','');
define('_MD_FONTIER_MODULE_DEVELOPERS','Simon Roberts (Wishcraft)'); // Sperated by a Pipe (|)
define('_MD_FONTIER_MODULE_TESTERS',''); // Sperated by a Pipe (|)
define('_MD_FONTIER_MODULE_TRANSLATERS',''); // Sperated by a Pipe (|)
define('_MD_FONTIER_MODULE_DOCUMENTERS',''); // Sperated by a Pipe (|)
define('_MD_FONTIER_MODULE_HASSEARCH',true);
define('_MD_FONTIER_MODULE_HASMAIN',true);
define('_MD_FONTIER_MODULE_HASADMIN',true);
define('_MD_FONTIER_MODULE_HASCOMMENTS',true);

// Configguration Categories
define('_MD_FONTIER_CONFCAT_SEO','Search Engine Optimization');
define('_MD_FONTIER_CONFCAT_SEO_DESC','');
define('_MD_FONTIER_CONFCAT_MODULE','Fontier+ Module Settins');
define('_MD_FONTIER_CONFCAT_MODULE_DESC','');
define('_MD_FONTIER_CONFCAT_API','Fontier+ API Setting');
define('_MD_FONTIER_CONFCAT_API_DESC','');


// Configuration Descriptions and Titles
define('_MD_FONTIER_HTACCESS','.htaccess SEO URL');
define('_MD_FONTIER_HTACCESS_DESC','');
define('_MD_FONTIER_BASE','Base .htaccess path');
define('_MD_FONTIER_BASE_DESC','');
define('_MD_FONTIER_HTML','Extension for HTML output with SEO URL');
define('_MD_FONTIER_HTML_DESC','');
define('_MD_FONTIER_IMAGE','File extension and type of image to use with API');
define('_MD_FONTIER_IMAGE_DESC','');
define('_MD_FONTIER_TAGS','Support Tag 2.3+ Module');
define('_MD_FONTIER_TAGS_DESC','');
define('_MD_FONTIER_SCHEDULE','Maintenance scheduling method');
define('_MD_FONTIER_SCHEDULE_DESC','This is the method the maintenance tasks are scheduled as a method of execution');
define('_MD_FONTIER_POLL_IDENTITIES','Poll Identities JSON list');
define('_MD_FONTIER_POLL_IDENTITIES_DESC','This is how many seconds between polling identities listing on api with preloaders');
define('_MD_FONTIER_POLL_FONTS','Poll New Identities for Data');
define('_MD_FONTIER_POLL_FONTS_DESC','This is how many seconds between polling new items that are listed as identities without data from the api with preloaders');
define('_MD_FONTIER_NUMBER_POLLED_FONTS','Number of new items to poll each cron');
define('_MD_FONTIER_NUMBER_POLLED_FONTS_DESC','This is the number of items per polling cron to get when new on the identities list');
define('_MD_FONTIER_POLL_GLYPHS','Change Glyphs in Data');
define('_MD_FONTIER_POLL_GLYPHS_DESC','This is how many seconds between changing the glyphs displayed on a font profile!');
define('_MD_FONTIER_NUMBER_POLLED_GLYPHS','Number of items to change the glyphs on each cron');
define('_MD_FONTIER_NUMBER_POLLED_GLYPHS_DESC','This is the number of items per schedule to change which glyphs display on font profiles');
define('_MD_FONTIER_CACHE_PREVIEW','Number of second font preview is cached for from API');
define('_MD_FONTIER_CACHE_PREVIEW_DESC','Setting to 0, disables caching!');
define('_MD_FONTIER_CACHE_NAMING','Number of second font naming card is cached for from API');
define('_MD_FONTIER_CACHE_NAMING_DESC','Setting to 0, disables caching!');
define('_MD_FONTIER_CACHE_GLYPHS','Number of second glyph tile is cached for from API');
define('_MD_FONTIER_CACHE_GLYPHS_DESC','Setting to 0, disables caching!');
define('_MD_FONTIER_CACHE_FORMS','Number of second html forms is cached for from API');
define('_MD_FONTIER_CACHE_FORMS_DESC','Setting to 0, disables caching!');
define('_MD_FONTIER_DOWNLOAD_FORMATS','Formats of file download available');
define('_MD_FONTIER_DOWNLOAD_FORMATS_DESC','This is a list of all the download file formats seperated by a comma, the file extension of the download archived pack');
define('_MD_FONTIER_API_PATH','This is the URL for the API being polled');
define('_MD_FONTIER_API_PATH_DESC','No trailing slash (is subsituted for %apipath%)<br/>real resolvable host path with protocol <em>ie. http://api.fonts4web.org.uk</em>');
define('_MD_FONTIER_API_PATH_PREVIEW','The API Path for font previews');
define('_MD_FONTIER_API_PATH_PREVIEW_DESC','contains the variables:<br/><br/><strong>%apipath%</strong> - the path of the API in URL<br/><strong>%identity%</strong> - the font identity<br/><strong>%format%</strong> - the image format as file extension');
define('_MD_FONTIER_API_PATH_NAMING','The API Path for font naming card');
define('_MD_FONTIER_API_PATH_NAMING_DESC','contains the variables:<br/><br/><strong>%apipath%</strong> - the path of the API in URL<br/><strong>%identity%</strong> - the font identity<br/><strong>%format%</strong> - the image format as file extension');
define('_MD_FONTIER_API_PATH_GLYPHS','The API Path for glyph tile of font');
define('_MD_FONTIER_API_PATH_GLYPHS_DESC','contains the variables:<br/><br/><strong>%apipath%</strong> - the path of the API in URL<br/><strong>%identity%</strong> - the font identity<br/><strong>%char%</strong> - the UTF/ASCII Code for the glyph to display<br/><strong>%format%</strong> - the image format as file extension');
define('_MD_FONTIER_API_PATH_CSS','The API Path for the CSS');
define('_MD_FONTIER_API_PATH_CSS_DESC','contains the variables:<br/><br/><strong>%apipath%</strong> - the path of the API in URL<br/><strong>%identity%</strong> - the font identity');
define('_MD_FONTIER_API_PATH_DOWNLOAD','The API Path for the font Archive Pack Download');
define('_MD_FONTIER_API_PATH_DOWNLOAD_DESC','contains the variables:<br/><br/><strong>%apipath%</strong> - the path of the API in URL<br/><strong>%identity%</strong> - the font identity<br/><strong>%pack%</strong> - the archive pack format as an file extension');
define('_MD_FONTIER_API_PATH_DIZ','The API Path for the DIZ Text');
define('_MD_FONTIER_API_PATH_DIZ_DESC','contains the variables:<br/><br/><strong>%apipath%</strong> - the path of the API in URL<br/><strong>%identity%</strong> - the font identity');
define('_MD_FONTIER_API_PATH_JSON','The API Path for the font data JSON result');
define('_MD_FONTIER_API_PATH_JSON_DESC','contains the variables:<br/><br/><strong>%apipath%</strong> - the path of the API in URL<br/><strong>%identity%</strong> - the font identity');
define('_MD_FONTIER_API_PATH_JSON_IDENTITIES','The API Path for the JSON Fonts Identities Listing');
define('_MD_FONTIER_API_PATH_JSON_IDENTITIES_DESC','contains the variables:<br/><br/><strong>%apipath%</strong> - the path of the API in URL');
define('_MD_FONTIER_API_PATH_UPLOADS_FORM','The API Path for the API Fonts Uploading Form');
define('_MD_FONTIER_API_PATH_UPLOADS_FORM_DESC','contains the variables:<br/><br/><strong>%apipath%</strong> - the path of the API in URL');
define('_MD_FONTIER_API_PATH_RELEASES_FORM','The API Path for the API Fonts Release email+callbacks Form');
define('_MD_FONTIER_API_PATH_RELEASES_FORM_DESC','contains the variables:<br/><br/><strong>%apipath%</strong> - the path of the API in URL');
define('_MD_FONTIER_API_MIN_SLEEP','API Loading Minimal Random amount of seconds');
define('_MD_FONTIER_API_MIN_SLEEP_DESC','This is the minimal number of seconds to randomly choose from to wait before calling the API');
define('_MD_FONTIER_API_MAX_SLEEP','API Loading Maximum Random amount of seconds');
define('_MD_FONTIER_API_MAX_SLEEP_DESC','This is the maximum number of seconds to randomly choose from to wait before calling the API');
define('_MD_FONTIER_API_CURL_TIMEOUT','API cURL Timeout in seconds');
define('_MD_FONTIER_API_CURL_TIMEOUT_DESC','Number of seconds for cURL to timeout attempting to make a data retrieval');
define('_MD_FONTIER_API_CURL_CONNECTION','API cURL Connection Timeout in seconds');
define('_MD_FONTIER_API_CURL_CONNECTION_DESC','Number of seconds for cURL to timeout attempting to make a connection to the API');

// Block Constant Defines
define('_MD_FONTIER_NEW_FONTS','Newest Additional Fonts');
define('_MD_FONTIER_NEW_FONTS_DESC','This is a block that displays the latest newest fonts added and polled');
define('_MD_FONTIER_POPULAR_FONTS','Popular Fonts Viewed');
define('_MD_FONTIER_POPULAR_FONTS_DESC','This is the popular fonts viewed');
define('_MD_FONTIER_POPULAR_FONTS_DOWNLOADED','Popular Fonts Downloaded');
define('_MD_FONTIER_POPULAR_FONTS_DOWNLOADED_DESC','This is the popular fonts downloaded');
define('_MD_FONTIER_LAST_FONTS_VIEWED','Last Fonts Viewed');
define('_MD_FONTIER_LAST_FONTS_VIEWED_DESC','This is the last fonts viewed');
define('_MD_FONTIER_LAST_FONTS_DOWNLOADED','Last Fonts Downloaded');
define('_MD_FONTIER_LAST_FONTS_DOWNLOADED_DESC','This is the last fonts downloaded');

// Notification Constant Defines
define('_MD_FONTIER_GLOBAL_NOTIFY','Fontier+ Notifications');
define('_MD_FONTIER_GLOBAL_NOTIFY_DESC','The notifications available in Fontier+');
define('_MD_FONTIER_GLOBAL_NEWINDEX_NOTIFY','New Index Category Added from API');
define('_MD_FONTIER_GLOBAL_NEWINDEX_NOTIFY_CAPTION','New Index Category Added from API');
define('_MD_FONTIER_GLOBAL_NEWINDEX_NOTIFY_DESC','This is when a new index or base is added to the category of fonts');
define('_MD_FONTIER_GLOBAL_NEWINDEX_NOTIFY_SUBJECT','New Category Added to Fontier+ Font API Browser');
define('_MD_FONTIER_GLOBAL_NEWFONT_NOTIFY','New Browsable Font Added from API');
define('_MD_FONTIER_GLOBAL_NEWFONT_NOTIFY_CAPTION','New Browsable Font Added from API');
define('_MD_FONTIER_GLOBAL_NEWFONT_NOTIFY_DESC','This is when a new font is added from the API via polling!');
define('_MD_FONTIER_GLOBAL_NEWFONT_NOTIFY_SUBJECT','New Font Available for Browsing in Fontier+');

?>