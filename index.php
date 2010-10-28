<?php

require_once('./includes/header.php');

$aMostRecent  = Recipe::getMostRecent();
$aMostPopular = Recipe::getMostPopular();

$aMostPopularTags = Tag::getMostPopular();

require_once(INCLUDES.'footer.php');

?>
