<?php
class Tag
{
  #
  # These variables are for use within the class
  #
  private static $sTable = 'Tags'
                ,$aColumns = array('TagID', 'TagName')
                ,$sID = 'TagID'
                ,$rLink = null
                ;

  public static $sLastQuery = '';

  public function __construct( $aOptions = array() )
  {
  }

  public function setMySQLConn( $rLink )
  {
    Tag::$rLink = $rLink;
    return true;
  }

  public function getMostPopular( $aOptions = array() )
  {
  }

}

class RecipeTagged
{
  private static $sTable = 'RecipeTagged'
                ,$aColumns = array('TagID','RecipeID')
                ,$aID = array('TagID','RecipeID')
                ,$rLink = null
                ;
}
?>
