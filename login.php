<?php

require_once('./includes/header.php');

$sHash = hash('sha256',$_POST['password']);
$aUser = User::select( array('where'=>array('username'=> $_POST['username'], 'password'=>$sHash)) );

if( !$aUser )
  die('Invalid login details.');

$_USER['user_id']  = $aUser['UserID'];
$_USER['username'] = $aUser['Username'];
$_USER['email']    = $aUser['Email'];
$_USER['logged_in']= 1;

$_SESSION['user'] = $_USER;

$config['redirect'] = WWW;

$config['html'] = false;
require_once(INCLUDES.'footer.php');

?>
