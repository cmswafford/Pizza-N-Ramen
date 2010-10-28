<?php

require_once('./includes/header.php');

if( $_POST )
{
  # Save recipe record
  # Redirect user to view the recipe they just created 
  $config['html'] = false;
  $config['redirect'] = WWW.'/view-recipe?id='.$iRecipeID;
}
else
{
  $config['body_id'] = 'submit-recipe';

  # submit-recipe.html will be included
}

require_once(INCLUDES.'footer.php');

?>
