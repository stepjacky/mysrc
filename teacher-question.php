<?php
session_start();
require_once "included/database.php" ;
$email='';
$avatar='';
if(isset($_SESSION['loginuser']) && isset($_SESSION['usertype'])){
	if($_SESSION['usertype']!='T'){
		$url = "login.php";
		header ("HTTP/1.1 303 See Other");
		header ("Location: $url");
		exit(0);
	}else{
		$email=$_SESSION['loginuser'];
		$tmail= urlencode($email);
		$avatar = getFieldValue("select avatar from user where email='$tmail'");
	}
}else{
	$url = "login.php";
	header ("HTTP/1.1 303 See Other");
	header ("Location: $url");
	exit(0);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>教师主页-添加题目</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<?php
include_once "included/static-resource.php";
?>
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
	position: relative;
}

#wrap {
	width: 1024px;
	height: 800px;
	margin-left: auto;
	margin-right: auto;
}

#column {
	float: left;
	width: 820px;
	height: 700px;
}

#column1 {
	float: left;
	width: 200px;
	height: 800px;
	background-color: #eee;
}

#column2 {
	float: right;
	width: 620px;
	height: 800px;
	background-color: #FFF;
	position: relative;
}

#column3 {
	float: right;
	width: 200px;
	height: 800px;
	background-color: #eee;
	_overflow: auto;
}

* html #column3 {
	margin-left: -5px;
	float: right;
	width: 200px !important; /* IE7 FF */
	width: 199px; /* IE6 */
	height: 700px;
	background-color: #eee
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

.box2 {
	border-top: 1px #cccccc solid;
	background: #f2f6fb;
	width: 594px;
	height: 317px;
	position: absolute;
	bottom: 0;
}

.button {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bolder;
	color: #CC0;
	background-color: #FFF;
	text-align: center;
	display: block;
	border: 1px solid #CF9;
	cursor: default;
	filter: Chroma(Color = blue);
	width: 120px;
}

.hoverEdit {
	border: #0CF 1px solid;
}

.hoverEditNone {
	border: none;
}
</style>
<script src="scripts/question.js" type="text/javascript"></script>
<link href="styles/table.css" rel="stylesheet" type="text/css">

<link href="styles/menu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css"
	href="scripts/jquery_panel/panel.css" />
<link href="styles/SexyButtons/sexybuttons.css" rel="stylesheet" type="text/css"/>    
    
   
</head>
<body>
<div id="menu_wrapper" class="black">
<ul id="menu">
	<li><a href="loginout.php">注销</a></li>
	<li>|</li>
	<li><a href="teacher-index.php">我的主页</a></li>
	<li><a href="javascript:;"
		onclick="window.location='teacher-question.php'">出题</a></li>
</ul>
</div>
<div id="header"></div>
<div id="wrap">
<div id="column">
<div id="column1">
<div id="content-top">
<div style="margin-top: 30px;">
<center><img src="<?php  echo $avatar;?>" /></center>
</div>
</div>

</div>
<div id="column2">
<table>
	<thead>
		<tr>
			<th colspan="5">
			<button class="sexybutton" 
			 onClick="addQuestion('questionform');return false;"
			type="reset"><span><span><span class="add">添加题目</span></span></span></button>
			
			</th>
		</tr>
		<tr>
			<th>类型</th>
			<th>年级</th>
			<th>学科</th>
			<th>学期</th>
			<th>版本</th>

		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo makeSelect("qst_type_id","select id,name from qtype");?>
			</td>
			<td><?php echo makeSelect("qst_grade_id","select id,name from grade where parent_id!=-1");?></td>
			<td><select id="qst_subject_id">
				<option value='-1'>请选择学科..</option>
			</select></td>
			<td><select id="semester">
				<option value='u'>上学期</option>
				<option value='d'>下学期</option>
			</select></td>
			<td><?php echo makeSelect("qst_bvser_id","select id,name from bookversion");?></td>
		</tr>
		<tr>
			<td>难度: <select id="diffculity">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5" selected>5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
			</select></td>

		</tr>

	</tbody>

</table>
<form id="questionform"><?php    
include_once 'texteditor.php' ;
?> <input type="hidden" name="qst_owner_id" id="qst_owner_id"
	value="<?php echo urlencode($email);?>" />
<hr size="1" color="#00CCFF" />

</form>
</div>
<div class="clear"></div>
</div>
<div id="column3">
<div class="mg10 exhibiton ex03">
<div class="exHead">
<div class="hTxt">
<div class="hTxtContent">
<h2>请选择章节</h2>
</div>
</div>
<div class="hLeft"></div>
<div class="hRight"></div>
</div>
<div class="exBody"
	style="background-color: #FFF; height: 450px; overflow: auto">
<div id="qst_chapter" class="content" style="background-color: #FFF"></div>
</div>
<div class="exFoot" style="background-color: #FFF;">

<div class="fLeft"></div>
<div class="fRight"></div>
</div>
</div>

</div>
<div class="clear"></div>
</div>

<div id="footer"><br />

</div>
<div id="dialog" title="<h4 style='color:red;'>系统消息</h4>" /><script
	language="javascript">
<!--
   $(function(){
	   var digcfg = {
				autoOpen : false,
				bgiframe : true,
				height : 180,
				modal : true,
				buttons : {
					"关闭" : function() {
						$(this).dialog('close');
					}
				}
			};
			$("#dialog").dialog(digcfg);


	   });
//章节选择的回调
function selectCallback(){
	//
}
//-->
</script>

</body>
</html>
