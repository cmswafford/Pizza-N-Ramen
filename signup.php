<?php

require_once('./includes/header.php');

$config['body_id'] = 'signup';

# If the user submitted the form, add them to the DB
if( $_POST )
{
  $aData = array();
  $aData['Username'] = $_POST['username'];
  $aData['Email'] = $_POST['email'];

  # Never store user's passwords as plain text!!!
  $aData['Password'] = hash( 'sha256', $_POST['password'] );

  $iUserID = User::insert($aData);
  if( $iUserID )
  {
    # Log the user in
    $_USER['user_id']  = $iUserID;
    $_USER['username'] = $aData['username'];
    $_USER['email']    = $aData['email'];
    $_USER['logged_in']= 1;
    $_USER['status']   = 1;
    $_SESSION['user']  = $_USER;

    echo User::$sLastQuery;
  }
  else
    echo "That username is already taken. Please try another!";
}

require_once(INCLUDES.'footer.php');

?>
