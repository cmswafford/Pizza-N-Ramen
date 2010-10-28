<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

require_once( 'config.php' );
require_once( INCLUDES.'functions.php');
require_once( INCLUDES.'Logger.class.php' );

$rLink = mysql_connect('localhost','pizza','p1zzaNr4m3n');
mysql_select_db('pizza');
$oDebug = new Logger('stdout');

# Include all entity classes here
require_once( INCLUDES.'User.class.php' );
User::setMySQLConn(&$rLink);

require_once( INCLUDES.'Recipe.class.php' );

require_once( INCLUDES.'Vote.class.php' );

require_once( INCLUDES.'Comment.class.php' );

require_once( INCLUDES.'Tag.class.php' );
Tag::setMySQLConn(&$rLink);

?>
