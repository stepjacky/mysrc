<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>FCKeditor - Sample</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="robots" content="noindex, nofollow">
		<link href="fckeditor/sample.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
	<form action="sampleposteddata.php" method="post" target="_blank">
<?php

include("fckeditor/fckeditor.php") ;


// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	
// '/fckeditor/' is the default value.
$sBasePath = $_SERVER['PHP_SELF'];//.'/fckeditor/' ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "fckeditor-test.php" ) ).'fckeditor/' ;
echo $sBasePath."<br/>";
$name = $_GET['name'];
$value = $_GET['value'];
echo $name . " ==>  " . $value;
$oFCKeditor = new FCKeditor($name) ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $value ;
$oFCKeditor->Create() ;
?>
	<br>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>
	