<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<?php
require_once '../tools/utils.php';
use utils\HtmlUtils;
use data\BaseDao;
$util = new HtmlUtils();
$entry = array();
$idInput = "";
$fileName = basename(__FILE__);
$entryName = $util->getEntryName($fileName);
$dao  =new BaseDao($entryName);
$id = $_GET['id'];
$entry = $dao->getBean($id);
$content = $util->getProperty($entry, "content");
?>
<body>
<div id="wapper">
<div><?php echo $content;?></div>
</div>
</body>
</html>
