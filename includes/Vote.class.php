<?php
class Vote
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
