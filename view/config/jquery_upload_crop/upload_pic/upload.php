<?php
use utils\ImageUpload;
require_once '../../../../tools/utils.php';
if(count($_FILES)!=0){
	$upload = new ImageUpload();
	$imgBase = "/cs78/view/config/jquery_upload_crop/upload_pic/";
	$dir = $_SERVER['DOCUMENT_ROOT'].$imgBase;
	$upload->upload($dir);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传图片</title>
</head>
<body>
<table border="0" align="center">
<form id="form1" name="upload" enctype="multipart/form-data"
	method="post" action="upload.php">
<ol>
	<li><input type="file" name="myImagefile[]" /></li>
	<li><input type="file" name="myImagefile[]" /></li>
	<li><input type="file" name="myImagefile[]" /></li>
	<li><input type="file" name="myImagefile[]" /></li>
	<li><input type="file" name="myImagefile[]" /></li>
	<li><input type="file" name="myImagefile[]" /></li>
</ol>
<input type="submit" name="Submit" value="提交" /></form>
</table>
</body>
</html>
