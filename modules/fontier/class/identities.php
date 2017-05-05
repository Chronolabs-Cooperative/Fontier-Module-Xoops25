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


if (!defined('_MD_FONTIER_MODULE_DIRNAME')) {
	return false;
}

//*
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'objects.php');

/**
 * Class for Glyphs in Fonts2Web.org.uk Font Converter
 *
 * For Table:-
 * <code>
 * CREATE TABLE `fontier_identities` (
 *   `id` mediumint(24) NOT NULL AUTO_INCREMENT,
 *   `identity` varchar(45) DEFAULT '',
 *   `base` varchar(1) DEFAULT '',
 *   `second` varchar(2) DEFAULT '',
 *   `thirds` varchar(3) DEFAULT '',
 *   `downloads` int(13) DEFAULT '0',
 *   `views` int(13) DEFAULT '0',
 *   `css` tinytext,
 *   `glyphs` tinytext,
 *   `name` varchar(255) DEFAULT '',
 *   `tags` varchar(255) DEFAULT '',
 *   `barcode` varchar(32) DEFAULT '',
 *   `referee` varchar(128) DEFAULT '',
 *   `polled` int(13) DEFAULT '0',
 *   `last` int(13) DEFAULT '0',
 *   `downloaded` int(13) DEFAULT '0',
 *   `glyphed` int(13) DEFAULT '0',
 *   `notified` int(13) DEFAULT '0',
 *   PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class fontierIdentities extends fontierXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, 0, false);
        self::initVar('identity', XOBJ_DTYPE_TXTBOX, md5(null), false, 45);
        self::initVar('base', XOBJ_DTYPE_TXTBOX, '', false, 1);
        self::initVar('second', XOBJ_DTYPE_TXTBOX, '', false, 2);
        self::initVar('thirds', XOBJ_DTYPE_TXTBOX, '', false, 3);
        self::initVar('downloads', XOBJ_DTYPE_INT, 0, false);
        self::initVar('views', XOBJ_DTYPE_INT, 0, false);
        self::initVar('css', XOBJ_DTYPE_OBJECT, '', false);
        self::initVar('glyphs', XOBJ_DTYPE_ARRAY, array(), false);
        self::initVar('json', XOBJ_DTYPE_ARRAY, '', false);
        self::initVar('diz', XOBJ_DTYPE_OBJECT, '', false);
        self::initVar('name', XOBJ_DTYPE_TXTBOX, '', false, 255);
        self::initVar('tags', XOBJ_DTYPE_TXTBOX, '', false, 255);
        self::initVar('barcode', XOBJ_DTYPE_TXTBOX, '', false, 32);
        self::initVar('referee', XOBJ_DTYPE_TXTBOX, '', false, 128);
        self::initVar('polled', XOBJ_DTYPE_INT, 0, false);
        self::initVar('last', XOBJ_DTYPE_INT, 0, false);
        self::initVar('downloaded', XOBJ_DTYPE_INT, 0, false);
        self::initVar('glyphed', XOBJ_DTYPE_INT, 0, false);
        self::initVar('notified', XOBJ_DTYPE_INT, 0, false);
        
        $this->handler = __CLASS__ . 'Handler';
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }

    function getDescriptionTile()
    {
    	global $fontierConfigsList;
    	$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . "/modules/" . _MD_FONTIER_MODULE_DIRNAME . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/style.css');
    	xoops_loadLanguage('main', _MD_FONTIER_MODULE_DIRNAME);
    	$html = "<div style=\"margin: 8px; padding: 3px; text-align: center;\">\n
	<img  id=\"fontierfontnaming\" src=\"".$this->getNamingURL($fontierConfigsList['image_format']) ."\" title=\"" . $this->getVar('name') ."\" alt=\"" . $this->getVar('name') ."\" width='89%' />\n
	<br />\n
	<span id=\"fontierviewsdownloads\">"._MN_FONTIER_FONT_VIEWS.":&nbsp;".$this->getVar('views')."&nbsp;/&nbsp;"._MN_FONTIER_FONT_DOWNLOADS.":&nbsp;".$this->getVar('downloads')."</span>\n
</div>\n
<h1>"._MN_FONTIER_FONT_PREVIEW_H1." ".$this->getVar('name')."</h1>\n
<div style=\"margin: 8px; padding: 3px; text-align: center;\">\n
	<img  id=\"fontierfontnaming\" src=\"".$this->getPreviewURL($fontierConfigsList['image_format'])."\" title=\"".$this->getVar('name')."\" alt=\"".$this->getVar('name')."\" width='97%' />\n
	<br />\n
</div>\n
<h1>"._MN_FONTIER_FONT_DOWNLOADING_H1." ".$this->getVar('name')."</h1>\n
<div style=\"margin: 8px; padding: 3px; text-align: center;\">\n
	<ol style=\"list-style: none !important; list-style-type: none !important;\">\n";
    	foreach (getDownloadURLsArray(explode(",",$fontierConfigsList['download_formats']), ucwords(strtolower($font->getVar('name')))) as $filename => $url) {
    		$html .= "		<li style=\"float: left; width: 24%; padding: 4px;\" id=\"fontierfontdownload\" ><a href=\"".$url."\" target=\"_blank\">".$filename."</a>\n";
    	}
    	$html .= "	</ol>\n";
    	$html .= "</div>\n";
    	return $html;
    }
    
    function addViewCount($num = 1)
    {
    	$this->setVar('views', $this->getVar('views') + $num);
    	$this->setVar('last', time());
    	xoops_getModuleHandler('indexes',_MD_FONTIER_MODULE_DIRNAME)->addViewsByBase($this->getVar('base'), $num);
    	xoops_getModuleHandler('indexes',_MD_FONTIER_MODULE_DIRNAME)->addViewsByBase($this->getVar('second'), $num);
    	xoops_getModuleHandler('indexes',_MD_FONTIER_MODULE_DIRNAME)->addViewsByBase($this->getVar('thirds'), $num);
    }
    
    
    function addDownloadCount($num = 1)
    {
    	$this->setVar('downloads', $this->getVar('downloads') + $num);
    	$this->setVar('downloaded', time());
    	xoops_getModuleHandler('indexes',_MD_FONTIER_MODULE_DIRNAME)->addDownloadsByBase($this->getVar('base'), $num);
    	xoops_getModuleHandler('indexes',_MD_FONTIER_MODULE_DIRNAME)->addDownloadsByBase($this->getVar('second'), $num);
    	xoops_getModuleHandler('indexes',_MD_FONTIER_MODULE_DIRNAME)->addDownloadsByBase($this->getVar('thirds'), $num);
    }
    
    /**
     *
     * @param string $base
     * @return boolean|string
     */
    function getFontURL($field = 'id')
    {
    	global $fontierConfigsList;
    	
    	if ($fontierConfigsList['htaccess']) {
    		return XOOPS_URL . '/' . $fontierConfigsList['base'] . '/font/'.urlencode($this->get($field)) . '/' . sef($this->get('name')) . '.' . $fontierConfigsList['html'];
    	}
    	return XOOPS_URL . '/modules/' . _MD_FONTIER_MODULE_DIRNAME. '/font.php?'.$field.'='.urlencode($this->get($field));
    }
    
    /**
     *
     * @param string $base
     * @return boolean|string
     */
    function getFontBrowseURL()
    {
    	global $fontierConfigsList;
    	
    	if ($fontierConfigsList['htaccess']) {
    		return XOOPS_URL . '/' . $fontierConfigsList['base'] . '/font/' . urlencode($this->getVar('id')) . '/' . sef($this->getVar('name')) . '.' . $fontierConfigsList['html'];
    	}
    	return XOOPS_URL . '/modules/' . _MD_FONTIER_MODULE_DIRNAME. '/font.php?id=' . urlencode($this->getVar('id'));
    }
    
    
    /**
     *
     * @param string $base
     * @return boolean|string
     */
    function getPreviewURL($format = 'png')
    {
    	global $fontierConfigsList;
    	
    	if ($fontierConfigsList['htaccess']) {
    		return XOOPS_URL . '/' . $fontierConfigsList['base'] . '/preview/' . urlencode($this->getVar('id')) . '.' . $format;
    	}
    	return XOOPS_URL . '/modules/' . _MD_FONTIER_MODULE_DIRNAME. '/preview.php?id=' . urlencode($this->getVar('id')) . '&format=' . $format;
    }

    
    /**
     *
     * @param string $base
     * @return boolean|string
     */
    function getNamingURL($format = 'png')
    {
    	global $fontierConfigsList;
    	
    	if ($fontierConfigsList['htaccess']) {
    		return XOOPS_URL . '/' . $fontierConfigsList['base'] . '/naming/' . urlencode($this->getVar('id')) . '.' . $format;
    	}
    	return XOOPS_URL . '/modules/' . _MD_FONTIER_MODULE_DIRNAME. '/naming.php?id=' . urlencode($this->getVar('id')) . '&format=' . $format;
    }
    
    
    /**
     *
     * @param string $base
     * @return boolean|string
     */
    function getGlyphURL($char = '', $format = 'png')
    {
    	global $fontierConfigsList;
    	
    	if ($fontierConfigsList['htaccess']) {
    		return XOOPS_URL . '/' . $fontierConfigsList['base'] . '/glyph/' . urlencode($this->getVar('id')) . '-' . urlencode($char) . '.' . $format;
    	}
    	return XOOPS_URL . '/modules/' . _MD_FONTIER_MODULE_DIRNAME. '/glyph.php?id=' . urlencode($this->getVar('id')) . '&char=' . $char . '&format=' . $format;
    }
    
    
    /**
     *
     * @param string $base
     * @return boolean|string
     */
    function getDownloadURL($pack = 'zip')
    {
    	global $fontierConfigsList;
    	
    	if ($fontierConfigsList['htaccess']) {
    		return XOOPS_URL . '/' . $fontierConfigsList['base'] . '/download/' . urlencode($this->getVar('id')) . '.' . $pack;
    	}
    	return XOOPS_URL . '/modules/' . _MD_FONTIER_MODULE_DIRNAME. '/download.php?id=' . urlencode($this->getVar('id')) . '&pack=' . $pack;
    }
    
    /**
     * 
     * @return mixed
     */
    function getCSSURL()
    {
    	global $fontierConfigsList;
    	return str_replace("%apipath%", $fontierConfigsList['api_path'], str_replace("%identity%", $this->getVar('identity'), $fontierConfigsList['api_path_css']));
    }
    
    /**
     * 
     * @param string $format
     * @return boolean[]|string[]
     */
    function getGlyphsURLArray($format = 'png')
    {
    	$return = array();
    	foreach($this->getVar('glyphs') as $key => $value)
    	{
    		$return[$value] = $this->getGlyphURL($value, $format);
    	}
    	return $return;
    }
    
    /**
     * 
     * @param array $packs
     * @param string $filename
     * @return boolean[]|string[]
     */
    function getDownloadURLsArray($packs = array(), $filename = '')
    {
    	$return = array();
    	foreach($packs as $key => $extension)
    		$return[$filename . '.' . $extension] = $this->getDownloadURL($extension);
    	return $return;
    }
}


/**
 * Handler Class for Glyphs in Fonts2Web.org.uk Font Converter
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class fontierIdentitiesHandler extends fontierXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'fontier_identities';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'fontierIdentities';
	
	/**
	 * Child Object Identity Key
	 *
	 * @var string
	 */
	var $identity = 'id';
	
	/**
	 * Child Object Default Envaluing Costs
	 *
	 * @var string
	 */
	var $envalued = 'value';
	
    function __construct(&$db) 
    {
    	if (!is_object($db))
    		$db = $GLOBAL["xoopsDB"];
        parent::__construct($db, $this->tbl, $this->child, $this->identity, $this->envalued);
    }
    
    /**
     * 
     * @param unknown $base
     * @param number $limit
     * @return boolean|string|boolean
     */
    function getRandoms($base = null, $limit = 5)
    {
    	if (is_null($base))
    	{
    		$sql = "SELECT * FROM `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` WHERE `polling` > 0 ORDER BY RAND() LIMIT $limit";
    	} elseif (strlen($base) == 1)
    	{
    		$sql = "SELECT * FROM `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` WHERE `polling` > 0 AND `base` LIKE '$base' ORDER BY RAND() LIMIT $limit";
    	} elseif (strlen($base) == 2)
    	{
    		$sql = "SELECT * FROM `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` WHERE `polling` > 0 AND `second` LIKE '$base' ORDER BY RAND() LIMIT $limit";
    	} elseif (strlen($base) == 3)
    	{
    		$sql = "SELECT * FROM `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` WHERE `polling` > 0 AND `thirds` LIKE '$base' ORDER BY RAND() LIMIT $limit";
    	}
    	$result = $GLOBALS['xoopsDB']->queryF($sql);
    	$return = $objs = array();
    	while($row = $GLOBALS['xoopsDB']->fetchArray($result))
    	{
    		$objs[$row['id']] = new fontierIdentities();
    		$objs[$row['id']]->assignVars($row);
    	}
    	if (count($objs)>0)
    	{
	    	foreach($objs as $key => $obj)
	    	{
	    		$return[$key]['name'] = $obj->getVar('name');
	    		$return[$key]['views'] = $obj->getVar('views');
	    		$return[$key]['downloads'] = $obj->getVar('downloads');
	    		$return[$key]['naming'] = $obj->getNamingURL();
	    		$return[$key]['url'] = $obj->getFontURL('id');
	    	}
	    	return $return;
    	}
    	return false;
    }
    
    /**
     * 
     * @param unknown $base
     * @param number $start
     * @param number $limit
     * @return boolean|string|boolean
     */
    function getFonts($base = null, $start = 0, $limit = 5)
    {
    	if (is_null($base))
    	{
    		$sql = "SELECT * FROM `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` WHERE `polling` > 0 ORDER BY `polling` DESC LIMIT $start, $limit";
    	} elseif (strlen($base) == 1)
    	{
    		$sql = "SELECT * FROM `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` WHERE `polling` > 0 AND `base` LIKE '$base' ORDER BY `polling` DESC LIMIT $start, $limit";
    	} elseif (strlen($base) == 2)
    	{
    		$sql = "SELECT * FROM `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` WHERE `polling` > 0 AND `second` LIKE '$base' ORDER BY `polling` DESC LIMIT $start, $limit";
    	} elseif (strlen($base) == 3)
    	{
    		$sql = "SELECT * FROM `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` WHERE `polling` > 0 AND `thirds` LIKE '$base' ORDER BY `polling` DESC LIMIT $start, $limit";
    	}
    	$result = $GLOBALS['xoopsDB']->queryF($sql);
    	$return = $objs = array();
    	while($row = $GLOBALS['xoopsDB']->fetchArray($result))
    	{
    		$objs[$row['id']] = new fontierIdentities();
    		$objs[$row['id']]->assignVars($row);
    	}
    	if (count($objs)>0)
    	{
    		foreach($objs as $key => $obj)
    		{
    			$return[$key]['name'] = $obj->getVar('name');
    			$return[$key]['views'] = $obj->getVar('views');
    			$return[$key]['downloads'] = $obj->getVar('downloads');
    			$return[$key]['naming'] = $obj->getNamingURL();
    			$return[$key]['url'] = $obj->getFontURL('id');
    		}
    		return $return;
    	}
    	return false;
    }
    
    /**
     * 
     * @param string $base
     * @return array|NULL[][]|unknown[][]
     */
    function getIndexesListbyBase($base = '')
    {
    	if (strlen($base) == 0)
    	{
    		$sql = "SELECT DISTINCT `base` as `index`, count(*) as `num` FROM `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` WHERE LENGTH(`base`) = 1 ORDER BY `base` ASC";
    	if (strlen($base) == 1)
    	{
    		$sql = "SELECT DISTINCT `second` as `index`, count(*) as `num` FROM `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` WHERE `base` LIKE '$base' ORDER BY `second` ASC";
    	} elseif (strlen($base) == 2)
    	{
    		$sql = "SELECT DISTINCT `thirds` as `index`, count(*) as `num` FROM `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` WHERE `second` LIKE '$base' ORDER BY `thirds` ASC";
    	} elseif (strlen($base) == 3)
    	{
    		return array();
    	}
    	
    	$return = array();
    	$result = $GLOBALS['xoopsDB']->queryF($sql);
    	while($row = $GLOBALS['xoopsDB']->fetchArray($result))
    		$return[$row['index']] = array('url'=>xoops_getModuleHandler('indexes',_MD_FONTIER_MODULE_DIRNAME)->getIndexBrowseURL($row['index']), 'count' => $row['num'], 'base' => $row['index']);
    	return $return;
    }
}
}