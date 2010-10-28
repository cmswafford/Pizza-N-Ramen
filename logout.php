<?php

require_once('./includes/header.php');

session_destroy();

$config['redirect'] = WWW;
$config['html'] = false;

require_once(INCLUDES.'footer.php');

?>
