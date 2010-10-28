<?php
require_once ( "bootstrap.php" );

# Dummy login
if( false )
{
}

# Get user info from $_SESSION
if( isset($_SESSION['user']) && is_array($_SESSION['user']) )
  $_USER = $_SESSION['user'];
else
  $_USER = array();

if( !$_USER ) # User isn't logged in
{
  $_USER['user_id']   = 0;
  $_USER['username']  = '';
  $_USER['email']     = '';
  $_USER['logged_in'] = 0;
  $_USER['status']    = 0;
}

$_USER['ip'] = $_SERVER['REMOTE_ADDR'];
$_USER['browser'] = $_SERVER['HTTP_USER_AGENT']; 

# Determine if user is an admin
if( $_USER['status'] >= 3 )
  define ( 'IS_ADMIN', true );
else
  define ( 'IS_ADMIN', false );

# Determine if user is logged in
if( $_USER['logged_in'] == 1 )
  define ( 'IS_LOGGED_IN', true );
else
  define ( 'IS_LOGGED_IN', false );

if( $config['debug'] === true )
{
  require_once(INCLUDES.'FirePHP.class.php');
  $oFirePHP = FirePHP::getInstance(true);
}

# Add some JS files to load
//$aJS[] = 'prototype-1.6.0.3.js';

# Turn on header.html, footer.tpl and $_GET['file'].tpl
$config['html'] = true;
$config['display_header'] = true;
$config['display_html']    = true;
$config['display_footer'] = true;

$sFile = substr($_SERVER['SCRIPT_NAME'], 1, strlen($_SERVER['SCRIPT_NAME'])-5);

# footer.php cleans this output buffer and puts the value into $sThisPageContents
ob_start();

?>
