<?php
/**
 * PHP-Subtitles API
 * 
 * PHP API for grabbing subtitles from various sources
 * 
 * @author Matthias ETIENNE <matt@allty.com>
 * @package PHP_Subtitles
 * @version 1.0
 */

define('SUBTITLES_BASE_PATH', realpath(dirname(__FILE__).DIRECTORY_SEPARATOR."drivers").DIRECTORY_SEPARATOR);
define('SUBTITLES_DRIVERS_PATH', SUBTITLES_BASE_PATH."drivers".DIRECTORY_SEPARATOR);
define('SUBTITLES_CONFIG_PATH', SUBTITLES_BASE_PATH."config".DIRECTORY_SEPARATOR);

 
/**
 * Base API
 * 
 * @package PHP_Subtitles
 * @subpackage classes
 */
class Subtitles 
{
	
	const TYPE_MOVIE = 1;
	const TYPE_SHOW = 2;
	
	public function __construct() 
	{

	}
	
	public function driver($driver) 
	{
		// try to load driver
		$f = SUBTITLES_DRIVERS_PATH.$driver.".php";
		if(file_exists($f)) {
			include_once $f;
			$c = "Subtitles_".$driver;
			return new $c();
		}
	}
	
}

class Subtitles_Exception extends Exception {
	
}

/**
 * Subtitles_Config
 * 
 * Config main class helper
 * 
 * @package PHP_Subtitles
 * @subpackage classes
 */
class Subtitles_Config {
	
	static $_configs = array();
	
	public function get($section, $config_var) {
		if(!isset(self::$_configs[$section])) {
			$filename = SUBTITLES_CONFIG_PATH.$section.".cfg.php";
			if(!file_exists($filename)) {
				throw new Exception("Cannot load config section '$section' since $filename does not exist.");
			}
			self::$_configs[$section] = include($filename);			
		}
		return (isset(self::$_configs[$section][$config_var])) ? self::$_configs[$section][$config_var] : NULL;
	}
}

class Subtitles_Movie {
	
}
class Subtitles_Show {
	
}
class Subtitles_Season {
	
}
class Subtitles_Episode {
	
}


	
/**
 * Subtitles Result
 * 
 * Holder for subtitles searching results
 * 
 * @package PHP_Subtitles
 * @subpackage classes
 */
class Subtitles_Result {
	
	public function __construct($results) {
		
	}
}

interface ISubtitles_Driver {
	
	/**
	 * Search for subtitles.
	 * 
	 * @param integer $type Media-type, either Subtitles::TYPE_MOVIE or Subtitles::TYPE_SHOW 
	 * @param string $query Query string to match, like a movie name or a tv show
	 * @param string|array Language(s) to search in
	 *  
	 * @return array of Subtitles_Result
	 */
	public function search($type, $query, $lang);
	
}
?>