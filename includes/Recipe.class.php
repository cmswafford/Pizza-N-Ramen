<?php
class Recipe
{
  #
  # These variables are for use within the class
  #
  private static $sTable = ''
                ,$aColumns = array()
                ,$sID = ''
                ,$rLink = null
                ;

  public static $sLastQuery = '';

  public function __construct( $aOptions = array() )
  {
  }

  public static function getMostRecent()
  {
    return array();
  }
  public static function getMostPopular()
  {
    return array();
  }
}

class Ingredients
{
  #
  # These variables are for use within the class
  #
  private static $sTable = ''
                ,$aColumns = array()
                ,$sID = ''
                ,$rLink = null
                ;

  public static $sLastQuery = '';

  public function __construct( $aOptions = array() )
  {
  }
}
?>
