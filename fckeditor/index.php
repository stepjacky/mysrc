<?php
header ( 'content-Type=text/html;charset=utf-8' );
header ( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header ( "Last-Modified: " . gmdate ( "D, d M Y H:i:s" ) . " GMT" );
header ( "Cache-Control: no-store, no-cache, must-revalidate" );
header ( "Cache-Control: post-check=0, pre-check=0", false );
header ( "Pragma: no-cache" );
$GoTo = "login.php";
header ( sprintf ( "Location: %s", $GoTo ) );
?>