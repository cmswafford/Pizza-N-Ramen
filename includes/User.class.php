<?php
class User
{
  #
  # These variables are for use within the class
  #
  private static $sTable = 'Users'
                ,$aColumns = array('UserID','Username','Email','Password','Status')
                ,$sID = 'UserID'
                ,$rLink = null;

  public static $sLastQuery = '';

  #
  #
  #
  public function __construct( $aOptions = array() )
  {
    if( is_numeric($aOptions) )
    {
      $iID = $aOptions;
      $aOptions = array();
      $aOptions[self::$sID] = $iID;
      
      return self::select($aOptions);
    }
  }

  public function setMySQLConn( $rLink )
  {
    self::$rLink = $rLink;
    return true;
  }

  #
  # User::select()
  # Args: $aOptions - array - Optionally takes corresponding parts to a sql query
  #       $bMultiDimensional - boolean - whether or not to force return aRows array as multimensional; useful for using foreach loops even if the returned data may only have one record
  # Returns: (array)aRows - data for selected rows; multi-demensional
  #          (boolean)false - select $rs was false
  #
  public static function select( $aOptions = array(), $bMultiDimensional = false )
  {
    $sTable = User::$sTable;
    $sFields = '*';
    $sWhere = '';
    $sOrderBy = '';
    $sOffset = '';
    $sLimit = '';
    if( isset($aOptions['where']) )
    {
      if( is_array($aOptions['where']) )
      {
        foreach( $aOptions['where'] as $k => $v )
        {
          $sWhere .= " AND $k = '".mysql_real_escape_string($v)."'";
        }
      }
      elseif( is_string($aOptions['where']) )
        $sWhere .= $aOptions['where'];
    }
    /*if( isset($aOptions['fields']) )
    {
      if( is_array($aOptions['fields']) )
      {
        $sFields = ''
        foreach( $aOptions['fields'] as $v )
        {
          $sFields .= ""
        }
      }
      elseif( is_string($aOptions['where']) )
        $sWhere .= $aOptions['where'];
    }
    */

    $sql = 'SELECT '.$sFields.' FROM '.$sTable.' ';
    if( $sWhere )
      $sql .= 'WHERE 1'.$sWhere;
    if( $sOrderBy )
      $sql .= 'ORDER BY '.$sOrderBy;
    if( $sLimit )
    {
      if( $sOffset )
        $sql .= "LIMIT $sOffset, $sLimit";
      else
        $sql .= 'LIMIT '.$sLimit;
    }

    # Update the member variable so client files 
    # can see what we have done
    self::$sLastQuery = $sql;

    # Do the query
    $rs = mysql_query($sql, self::$rLink);
    if( !$rs )
      return false;

    # Loop through the results and store everything in $aRows
    $aRows = array();
    while( $aRow = mysql_fetch_assoc($rs) )
    {
      $aRows[] = $aRow;
    }

    # Return
    if( count($aRows) == 0 )
      return array();
    elseif( count($aRows) == 1 && $bMultiDimensional !== true )
      return $aRows[0];
    else
      return $aRows;
  }

  #
  # User::insert()
  # Args: $aData - array - fields => values
  # Returns: (int)UserID of new record
  #
  public function insert( $aData = array() )
  {
    $sFields = '';
    $sValues = '';
    foreach( $aData as $k => $v )
    {
      $sFields .= "$k, ";

      # Protect against sql injection
      if( !is_numeric($v) )
        $sValues .= "'".trim(mysql_real_escape_string($v))."', ";
      else
        $sValues .= "$v, ";
    }

    # Remove extra ,
    $sFields = substr($sFields,0,strlen($sFields)-2);
    $sValues = substr($sValues,0,strlen($sValues)-2);

    # Insert the record
    $sql = "INSERT INTO Users ( $sFields ) VALUES ( $sValues )";
    self::$sLastQuery = $sql;

    mysql_query($sql, User::$rLink);

    # Return the UserID
    return mysql_insert_id();
  }
}

?>
