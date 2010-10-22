<?php 
header('content-Type=text/html;charset=utf-8');
header("refresh:3;url=login.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>注册新帐户</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">

<style type="text/css">
body {
	margin: 0;
	font-size: 14px;
}

#header {
	width: 1024px;
	height: 60px;
	background-image: url(images/header.png);
	margin-left: auto;
	margin-right: auto;
}

#wrap {
	width: 1024px;
	height: 650px;
	margin-left: auto;
	margin-right: auto;
	background-color: #FFF;
}

#column {
	float: left;
	width: 820px;
	height: 650px;
}

#column1 {
	float: left;
	width: 220px;
	height: 650px;
	background-color: #FFF;
}

#column2 {
	float: right;
	width: 595px;
	height: 650px;
	background-color: #FFF;
}

#column3 {
	float: right;
	width: 200px;
	height: 650px;
	background-color: #FFF
}

.clear {
	clear: both;
}

#footer {
	width: 1024px;
	height: 50px;
	margin-left: auto;
	margin-right: auto;
	background-color: #CCC;
}

#content-top #content-r-top {
	margin-left: auto;
	margin-right: auto;
	width: 100%;
}

#content-mid #content-r-mid {
	margin-left: auto;
	margin-right: auto;
	width: 100%;
}

#content-end #content-r-end {
	margin-left: auto;
	margin-right: auto;
	width: 100%;
}

.fitem {
	width: 200px;
	height: 20px;
}
.button{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bolder;
	color: #CC0;
	background-color: #FFF;
	text-align: center;
	display: block;
	border: 1px solid #CF9;
	cursor: default;
	filter: Chroma(Color=blue);
	width:80px;
}
</style>
</head>
<body>
<div id="header"></div>
<div id="wrap">
   <center>
   注册成功,三秒后跳转到登陆页面,浏览器没跳转,请直接点击
   <a href='login.php' target="_self">登陆</a>
   </center>
</div>
<div id="footer"><br />

</div>

</body>
</html>