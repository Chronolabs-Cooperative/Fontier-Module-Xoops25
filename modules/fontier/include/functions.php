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



if (!defined('_MD_FONTIER_MODULE_DIRNAME'))
	define('_MD_FONTIER_MODULE_DIRNAME', basename(dirname(__DIR__)));


if (!function_exists("getEnumeratorValues")) {
	/**
	 * Loads a field enumerator values
	 *
	 * @param string $filename
	 * @param string $variable
	 * @return array():
	 */
	function getEnumeratorValues($filename = '', $variable = '')
	{
		$variable = str_replace(array('-', ' '), "_", $variable);
		static $ret = array();
		if (!isset($ret[basename($file)]))
			if (file_exists($file = __DIR__ . DIRECTORY_SEPARATOR . 'enumerators' . DIRECTORY_SEPARATOR . "$variable__" . str_replace("php", "diz", basename($filename))))
				foreach( file($file) as $id => $value )
					if (!empty($value))
						$ret[basename($file)][$value] = $value;
						return $ret[basename($file)];
	}
}

if (!function_exists("fontierDecryptPassword")) {
	/**
	 * Decrypts a password
	 *
	 * @param string $password
	 * @param string $cryptiopass
	 * @return string:
	 */
	function fontierDecryptPassword($password = '', $cryptiopass = '')
	{
		$sql = "SELECT AES_DECRYPT(%s, %s) as `crypteec`";
		list($result) = $GLOBALS["xoopsDB"]->fetchRow($GLOBALS["xoopsDB"]->queryF(sprintf($sql, $GLOBALS["xoopsDB"]->quote($password), $GLOBALS["xoopsDB"]->quote($cryptiopass))));
		return $result;
	}
}


if (!function_exists("fontierEncryptPassword")) {
	/**
	 * Encrypts a password
	 *
	 * @param string $password
	 * @param string $cryptiopass
	 * @return string:
	 */
	function fontierEncryptPassword($password = '', $cryptiopass = '')
	{
		$sql = "SELECT AES_ENCRYPT(%s, %s) as `encrypic`";
		list($result) = $GLOBALS["xoopsDB"]->fetchRow($GLOBALS["xoopsDB"]->queryF(sprintf($sql, $GLOBALS["xoopsDB"]->quote($password), $GLOBALS["xoopsDB"]->quote($cryptiopass))));
		return $result;
	}
}


if (!function_exists("fontierCompressData")) {
	/**
	 * Compresses a textualisation
	 *
	 * @param string $data
	 * @return string:
	 */
	function fontierCompressData($data = '')
	{
		$sql = "SELECT COMPRESS(%s) as `compressed`";
		list($result) = $GLOBALS["xoopsDB"]->fetchRow($GLOBALS["xoopsDB"]->queryF(sprintf($sql, $GLOBALS["xoopsDB"]->quote($data))));
		return $result;
	}
}


if (!function_exists("fontierDecompressData")) {
	/**
	 * Compresses a textualisation
	 *
	 * @param string $data
	 * @return string:
	 */
	function fontierDecompressData($data = '')
	{
		$sql = "SELECT DECOMPRESS(%s) as `compressed`";
		list($result) = $GLOBALS["xoopsDB"]->fetchRow($GLOBALS["xoopsDB"]->queryF(sprintf($sql, $GLOBALS["xoopsDB"]->quote($data))));
		return $result;
	}
}


if (!function_exists("getURIData")) {
	/**
	 * uses cURL to return data from the URL/URI with POST Data if required
	 *
	 * @param string $urt
	 * @param integer $timeout
	 * @param integer $connectout
	 * @param array $post_data
	 *
	 * @return string
	 */
	function getURIData($uri = '', $post_data = array(), $timeout = 0, $connectout = 0)
	{
		if (!function_exists("curl_init"))
		{
			die("Need to install php-curl: $ sudo apt-get install php-curl");
		}
		if (!$btt = curl_init($uri)) {
			return false;
		}
		curl_setopt($btt, CURLOPT_HEADER, 0);
		curl_setopt($btt, CURLOPT_POST, (count($post_data)==0?false:true));
		if (count($post_data)!=0)
			curl_setopt($btt, CURLOPT_POSTFIELDS, http_build_query($post_data));
		curl_setopt($btt, CURLOPT_CONNECTTIMEOUT, ($connectout==0)?$fontierConfigsList['api_curl_connection']:$connectout);
		curl_setopt($btt, CURLOPT_TIMEOUT, ($timeout==0)?$fontierConfigsList['api_curl_timeout']:$timeout);
		curl_setopt($btt, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($btt, CURLOPT_VERBOSE, false);
		curl_setopt($btt, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($btt, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($btt);
		curl_close($btt);
		return $data;
	}
}


if (!function_exists('sef'))
{
	
	/**
	 * Xoops safe encoded url elements
	 *
	 * @param unknown $datab
	 * @param string $char
	 * @return string
	 */
	function sef($datab, $char ='-')
	{
		$replacement_chars = array();
		$accepted = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","m","o","p","q",
				"r","s","t","u","v","w","x","y","z","0","9","8","7","6","5","4","3","2","1");
		for($i=0;$i<256;$i++){
			if (!in_array(strtolower(chr($i)),$accepted))
				$replacement_chars[] = chr($i);
		}
		$return_data = (str_replace($replacement_chars,$char,$datab));
		while(substr($return_data, 0, 1) == $char)
			$return_data = substr($return_data, 1, strlen($return_data)-1);
		while(substr($return_data, strlen($return_data)-1, 1) == $char)
			$return_data = substr($return_data, 0, strlen($return_data)-1);
		while(strpos($return_data, $char . $char))
			$return_data = str_replace($char . $char, $char, $return_data);
		return(strtolower($return_data));
	}
}

if (!function_exists("getFontNameTags")) {
	/**
	 * Loads a field enumerator values
	 *
	 * @param string $filename
	 * @param string $variable
	 * @return array():
	 */
	function getFontNameTags($name = '', $sep = ',')
	{
		if (strlen(trim($name))==0)
			return '';
		
			
		$name = str_replace(array('.',',','<','>',"?","/","'","'",';',':','{','}','[',']','=','+','_',')','(','*','&','^',"%",'$',"@",'!','~','`'), '', $name);
		$tags = array();
		$tag = '';
		for($s=0;$s<strlen($name);$s++)
		{
			if (strlen($tag)>0 && in_array(substr($name, $s, 1), array('-',' ')) ||(substr($name, $s, 1) == strtoupper(substr($name, $s, 1)) && (substr($name, $s, 1) == strtolower(substr($name, $s-1, 1)))) || (is_numeric(substr($name, $s, 1)) && !is_numeric(substr($name, $s-1, 1))))
			{
				$tags[] = $tag;
				$tag = '';
			}
			if (!in_array(substr($name, $s, 1), array('-',' ')))
				$tag .=substr($name, $s, 1);
		}
		if (strlen($tag)>0)
			$tags[] = $tag;
		array_unique($tags);
		sort($tags);
		return implode($sep, $tags);
	}
}

?>
