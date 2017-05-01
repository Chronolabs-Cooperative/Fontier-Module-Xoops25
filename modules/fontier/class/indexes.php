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

require_once (__DIR__ . DIRECTORY_SEPARATOR . 'objects.php');

/**
 * Class for Fonts in Fonts2Web.org.uk Font Converter
 *
 * For Table:-
 * <code>
 * CREATE TABLE `fontier_indexes` (
 *   `id` mediumint(24) NOT NULL AUTO_INCREMENT,
 *   `base` varchar(3) DEFAULT '',
 *   `ids` mediumtext,
 *   `fonts` int(13) DEFAULT '0',
 *   `last` int(13) DEFAULT '0',
 *   `downloads` int(13) DEFAULT '0',
 *   `views` int(13) DEFAULT '0',
 *   `notified` int(13) DEFAULT '0',
 *   PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * </code>
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class fontierIndexes extends fontierXoopsObject
{

	var $handler = '';
	
    function __construct($id = null)
    {   	
    	
        self::initVar('id', XOBJ_DTYPE_INT, null, false);
        self::initVar('base', XOBJ_DTYPE_TXTBOX, null, false, 3);
        self::initVar('ids', XOBJ_DTYPE_ARRAY, array(), false);
        self::initVar('fonts', XOBJ_DTYPE_INT, null, false);
        self::initVar('last', XOBJ_DTYPE_INT, null, false);
        self::initVar('downloads', XOBJ_DTYPE_INT, 0, false);
        self::initVar('views', XOBJ_DTYPE_INT, 0, false);
        self::initVar('notified', XOBJ_DTYPE_INT, 0, false);
        
        $this->handler = __CLASS__ . 'Handler';
        if (!empty($id) && !is_null($id))
        {
        	$handler = new $this->handler;
        	self::assignVars($handler->get($id)->getValues(array_keys($this->vars)));
        }
        
    }
    
    /**
     * 
     * @param unknown $id
     * @return boolean
     */
    function addFontID($id)
    {
    	if (empty($id))
    		return false;
    	
    	$ids = $this->getVar('ids');
    	$ids[] = $id;
    	sort(array_unique($ids));
    	array_unique($ids);
    	$this->setVar('ids', $ids);
    	
    	$this->setVar('fonts', $this->getVar('fonts')+1);
    	$this->setVar('last', time());
    	
    	return true;
    }
	
    
    /**
     *
     * @param string $base
     * @return boolean|string
     */
    function getIndexBrowseURL()
    {
    	global $fontierConfigsList;
    	
    	if ($fontierConfigsList['htaccess']) {
    		return XOOPS_URL . '/' . $fontierConfigsList['base'] . '/index/0/30/' . urlencode($this->getVar('base')) . '.' . $fontierConfigsList['html'];
    	}
    	return XOOPS_URL . '/modules/' . _MD_FONTIER_MODULE_DIRNAME. '/?op=index&start=0&limit=30&base=' . urlencode($this->getVar('base'));
    }
}

/**
 * Handler Class for Fonts in Fonts2Web.org.uk Font Converter
 * @author Simon Roberts (wishcraft@users.sourceforge.net)
 * @copyright copyright (c) 2015 labs.coop
 */
class fontierIndexesHandler extends fontierXoopsObjectHandler
{
	

	/**
	 * Table Name without prefix used
	 * 
	 * @var string
	 */
	var $tbl = 'fontier_indexes';
	
	/**
	 * Child Object Handling Class
	 *
	 * @var string
	 */
	var $child = 'fontierIndexes';
	
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
	var $envalued = 'referee';
	
    function __construct(&$db) 
    {
    	if (!is_object($db))
    		$db = $GLOBAL["xoopsDB"];
        parent::__construct($db, $this->tbl, $this->child, $this->identity, $this->envalued);
    }
    
    /**
     * 
     * @param string $base
     * @param number $excludeid
     * @param number $start
     * @param number $limit
     * @return boolean|NULL[][]
     */
    function getFontsURLsFromBase($base = '', $excludeid = 0, $start = 0, $limit = 0)
    {
    	if (strlen($base)==1)
    		$criteria = new CriteriaCompo(new Criteria('base', $base, 'LIKE'));
    	elseif (strlen($base)==2)
    		$criteria = new CriteriaCompo(new Criteria('second', $base, 'LIKE'));
    	elseif (strlen($base)==3)
    		$criteria = new CriteriaCompo(new Criteria('thirds', $base, 'LIKE'));
    	else
    		return false;
    	if (!empty($excludeid) && $excludeid != 0)
    		$criteria->add(new Criteria('id', $excludeid, '!='));
    	$criteria->order('`name`');
    	$criteria->sort('ASC');
    	if ($start != 0 || $limit != 0)
    	{
    		$criteria->start($start);
    		$criteria->sort($limit);
    	}
    	$fonts = xoops_getModuleHandler('identities',_MD_FONTIER_MODULE_DIRNAME)->getObjects($criteria);
    	$return = array();
    	foreach($fonts as $id => $font)
    	{
    		$return[$id] = array('name' => $font->getVar('name'), 'url' => $font->getFontBrowseURL(), 'naming' => $font->getNamingURL());
    	}
    	return $return;
    }
    /**
     * 
     * @param string $base
     * @return boolean|string
     */
    function getIndexBrowseURL($base = '')
    {
    	global $fontierConfigsList;
    	
    	if (empty($base))
    		return false;
    	
    	if ($fontierConfigsList['htaccess']) {
    		return XOOPS_URL . '/' . $fontierConfigsList['base'] . '/index/0/30/' . urlencode($base) . '.' . $fontierConfigsList['html'];
    	}
    	return XOOPS_URL . '/modules/' . _MD_FONTIER_MODULE_DIRNAME. '/?op=index&start=0&limit=30&base=' . urlencode($base);
    }
    
    /**
     * 
     * @param string $base
     * @return boolean|unknown
     */
    function getIndexesArrayByBase($base = '')
    {
    	if (empty($base))
    		return false;
    	return xoops_getModuleHandler('indexes',_MD_FONTIER_MODULE_DIRNAME)->getIndexesListbyBase($base);
    }
    
    /**
     * 
     * @param string $base
     * @return boolean|XoopsObject
     */
    function getByBase($base = '')
    {
    	if (empty($base))
    		return false;
    	
    	$sql = "SELECT `id` FROM `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` WHERE `base` LIKE '$base'";
    	list($id) =  $GLOBALS['xoopsDB']->fetchRow($GLOBALS['xoopsDB']->queryF($sql));
    	
    	if (isset($id) && !empty($id))
    		return $this->get($id);
    	
    	return false;
    }
    
    /**
     * 
     * @param string $base
     * @param number $number
     * @return boolean|unknown
     */
    function addViewsByBase($base = '', $number = 1)
    {
    	if (empty($base) || $number = 0)
    		return false;
    		
    	$sql = "UPDATE `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` SET `views` = `views` + '$number' WHERE `base` LIKE '$base'";
    	return $GLOBALS['xoopsDB']->queryF($sql);
    }
    
    /**
     * 
     * @param string $base
     * @param number $number
     * @return boolean|unknown
     */
    function addDownloadsByBase($base = '', $number = 1)
    {
    	if (empty($base) || $number = 0)
    		return false;
    		
    	$sql = "UPDATE `" . $GLOBALS['xoopsDB']->prefix($this->tbl) . "` SET `downloads` = `downloads` + '$number' WHERE `base` LIKE '$base'";
    	return $GLOBALS['xoopsDB']->queryF($sql);
    }
}


?>