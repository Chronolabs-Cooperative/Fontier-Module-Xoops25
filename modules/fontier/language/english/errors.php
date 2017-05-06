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


// Font Upload Error
define('_ERR_FONTIER_UPLOAD_NOFILES','No files specified for uploading to the system!');
define('_ERR_FONTIER_UPLOAD_UNKNOWNEXTENSION','The file extension type of <strong>%s</strong> is not valid you can only upload the following file types: <em>%s</em>!');
define('_ERR_FONTIER_UPLOAD_NOTWITTERUSER','You have not specified a twitter username, the default is: <strong>%s</strong>');
define('_ERR_FONTIER_UPLOAD_EMAILINVALID','The email you have given which is: %s - <strong>Is Invalid, not an email address allowed!</strong>');
define('_ERR_FONTIER_UPLOAD_NOEMAILGIVEN','There has been no email given!');
define('_ERR_FONTIER_UPLOAD_NONAMEGIVEN','There has been no name for the font copyrightin given!');
define('_ERR_FONTIER_UPLOAD_NOBIZOGIVEN','There has been no business or organisation for the font copyrighting given!');
define('_ERR_FONTIER_UPLOAD_NOMAKEFOLDER','I have been unable to make the uploading working path for the file at: <em>%s</em>');
define('_ERR_FONTIER_UPLOAD_NOFILEMOVE','<h1 style=\'color:rgb(198,0,0);\'>Uploading Error Has Occured</h1><br/><p>Fonts API was unable to recieve and store: <strong>%s</strong>!</h1>');
define('_ERR_FONTIER_UPLOAD_COMPLETE','Completed Uploading File and Converting and Downloading the font(s)!');
define('_ERR_FONTIER_UPLOAD_SECFAILED', 'Form Security Token Failed, upload cannot continue!');
define('_ERR_FONTIER_UPLOAD_LICENCINGERROR','The file you have uploaded, is locked and unmodifiable and strippable to your own licensed font file, I am sorry we will be unable to convert this file!');
define("_ERR_FONTIER_IMAGE_NOFORMATPECIFIED",'There is not a GET["format"] of image specified you have the choice of: png, jpg or gif!');
define('_ERR_FONTIER_ARCHIVE_NOPACKSPECIFIED','No File Archiving Packing File-type Extension specified in GET["pack"]!');

// Fonts Class Error Messages
define('_ERR_FONTIER_FONTS_REPORESNOTFOUND','Repository Font File is Missing!');
define('_ERR_FONTIER_FONTS_CACHEFILEMISSING','Cache File is missing from the repository of Cache Font Files!');

// Naming Cue Error Messages
define('_ERR_FONTIER_NAMING_NOIDSPECIFIED','No Identify Hash Specified on the $_GET["id"] input!');
define('_ERR_FONTIER_NAMING_IDNOTFOUND','The Identify Hash Specified on the $_GET["id"] input; could not be found in the database at any congruent basis!');

// Glyph Preview Error Messages
define('_ERR_FONTIER_GLYPH_NOIDSPECIFIED','No Identify Hash Specified on the $_GET["id"] input!');
define('_ERR_FONTIER_GLYPH_IDNOTFOUND','The Identify Hash Specified on the $_GET["id"] input; could not be found in the database at any congruent basis!');
define('_ERR_FONTIER_GLYPH_NOCHARSPECIFIED','No Character UTF Number specified in $_GET["char"]!');

// Preview Error Messages
define('_ERR_FONTIER_PREVIEW_NOIDSPECIFIED','No Identify Hash Specified on the $_GET["id"] input!');
define('_ERR_FONTIER_PREVIEW_IDNOTFOUND','The Identify Hash Specified on the $_GET["id"] input; could not be found in the database at any congruent basis!');

// Preview Error Messages
define('_ERR_FONTIER_HISTORY_NOIDSPECIFIED','No Identify Hash Specified on the $_GET["id"] input!');
define('_ERR_FONTIER_HISTORY_IDNOTFOUND','The Identify Hash Specified on the $_GET["id"] input; could not be found in the database at any congruent basis!');
define('_ERR_FONTIER_HISTORY_NOFONTS','There are no fonts in the history currently, you cannot browse this list for the moment!');

// Download Error Messages
define('_ERR_FONTIER_DOWNLOAD_NOIDSPECIFIED','No Identify Hash Specified on the $_GET["id"] input!');
define('_ERR_FONTIER_DOWNLOAD_IDNOTFOUND','The Identify Hash Specified on the $_GET["id"] input; could not be found in the database at any congruent basis!');

// Font Error Messages
define('_ERR_FONTIER_FONT_NOIDSPECIFIED','No Identify Hash Specified on the $_GET["id"] input!');
define('_ERR_FONTIER_FONT_IDNOTFOUND','The Identify Hash Specified on the $_GET["id"] input; could not be found in the database at any congruent basis!');

?>