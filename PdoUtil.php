<?php
define('AL_MYSQL_HOST', '');
define('AL_MYSQL_USER', '');
define('AL_MYSQL_PWD', '');
define('AL_MYSQL_DB', '');


class PdoUtil {
	private static $pdo;
	
	/**
	 * @return PDO
	 */
	public static function open() {
		self::$pdo = new PDO('mysql:host=' . AL_MYSQL_HOST . ';dbname=' . AL_MYSQL_DB, AL_MYSQL_USER, AL_MYSQL_PWD);  
		return self::$pdo;
	}
	
	/**
	 * @return PDO
	 */
	public static function get() {
		return self::$pdo;
	}
	
	/**
	 * @return string
	 */
	public static function errmsg() {
		return json_encode(self::$pdo->errorInfo());
	}

	public static function perrmsg() {
		print self::$pdo->errorInfo()[2] . "\n";
	}
}

function post_f($name, $def=null) 
{
    $s = isset($_POST[$name]) ? $_POST[$name] : $def;
    return $s == 'null' ? NULL : $s;
}

function get_f($name, $def = null)
{
    $s = isset($_GET[$name]) ? $_GET[$name] : $def;
    return $s == 'null' ? NULL : $s;
}

function _f($name, $def = null)
{
    $s = isset($_REQUEST[$name]) ? $_REQUEST[$name] : $def;
    return $s == 'null' ? NULL : $s;
}
