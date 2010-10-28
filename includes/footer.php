<?php

if( isset($config['jsonp']) && $config['jsonp'] === true )
  $config['html'] = false;

# Display HTML 
if( isset($config['html']) )
{
  if( $config['html'] === true ):
    $config['display_header'] = true;
    $config['display_html']   = true;
    $config['display_footer'] = true;
  elseif( $config['html'] === false ):
    $config['display_header'] = false;
    $config['display_html']   = false;
    $config['display_footer'] = false;
  endif;
}

$sFeedback = ob_get_clean();

# By default always append the page_title_suffix
#
# To set a page title that discludes the page_title_suffix, 
# simply set $config['page_title_suffix'] = '' in that script
if ( $config['page_title'] )
  $config['page_title'] .= $config['page_title_suffix'];
else
  $config['page_title'] = $config['page_title_default'];

# Show debugging info if neccesary
if( $config['debug'] === true )
{
  //$oDebug->log ( 'Queries: '.dump($mysql->aQueries, true) ) );
  $oDebug->log ( "<br><br>----------------------------------<br><br>\n" );
  $oDebug->log ( '$_USER: '.dump($_USER, true, true) );
  $oDebug->log ( "\n----------------------------------<br><br>\n" );
  $oDebug->log ( '$_GET: '.dump($_GET, true, true) );
  $oDebug->log ( "\n----------------------------------<br><br>\n" );
  $oDebug->log ( '$_POST: '.dump($_POST, true, true) );
  $oDebug->log ( "\n----------------------------------<br><br>\n" );
  $oDebug->log ( '$_SESSION: '.dump($_SESSION, true, true) );
  $oDebug->log ( "\n----------------------------------<br><br>\n" );
  $oDebug->log ( '$_COOKIE: '.dump($_COOKIE, true, true) );
  $oDebug->log ( "\n----------------------------------<br><br>\n" );
  $oDebug->log ( '$_SERVER: '.dump($_SERVER, true, true) );
  $oDebug->log ( "\n----------------------------------<br><br>\n" );
  //$oDebug->log ( 'QUERIES: '.dump(DB::getQueries(), true, true) );
  //$oDebug->log ( "\n----------------------------------<br><br>\n" );
  $oDebug->log ( '$config: '.dump($config, true, true) );
  $oDebug->log ( "\n----------------------------------<br><br>\n" );
  //$oDebug->log ( '$_REQUEST: '.dump($_REQUEST, true) ) );
  //$oDebug->log ( "<br>----------------------------------<br>" );
}

# Display header HTML
if ( $config['display_header'] === true )
{
  if( isset($config['header_html']) )
    require_once( $config['header_html'] );
  else
    require_once( HTML.'header.html' );
}

if( file_exists(HTML.$sFile.'.html') && is_readable(HTML.$sFile.'.html') )
{
  if( !isset($config['display_html']) || $config['display_html'] !== false )
    include(HTML.$sFile.'.html');
}

# Nothing should go below here besides displaying the footer

# Load the footer template file into the template engine
if ( $config['display_footer'] === true )
  require_once( HTML.'footer.html' );
elseif( isset($config['footer_html']) )
  echo $config['footer_html'];

if( isset($config['redirect']) && is_string($config['redirect']) )
  header('Location:'.$config['redirect']);

?>
