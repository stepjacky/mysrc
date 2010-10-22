<?php
if(!isset($_GET['email']) || !isset($_GET['sid'])){
	exit(0);
}
$email  = $_GET['email'];
$sid    = $_GET['sid'];
//获取在线学习时间
$tmail = urlencode($email);
require_once "included/database.php";
//今天的
$tsum = getTodayTime($tmail);
//昨天的
$ysum = getYestodayTime($tmail);

$wsum = getTheWeekTime($tmail);
//累积的
$ssum = getTotalTime($tmail);

//获取在线时间结束
$grade_id=-1;
$grade_name='';
$sql="select g.id gid , g.name gname from grade g,user u where u.email='$tmail' and g.id=u.grade_id";
//echo $sql;
$result = query($sql);
while($row = mysql_fetch_assoc($result)){
	$grade_id  = $row['gid'];
	$grade_name = $row['gname'];
}
$month=getdate();
$m =$month['mon'];
$sem_name=$m>6?'下学期':'上学期';
$sem_id = 	$m>6?'d':'u';
$sname = getFieldValue("select name from subject where id=$sid");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title><?php echo $sname.'['.$sem_name.']';?>章节详细信息</title>
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
	height: 800px;
}

#column1 {
	float: left;
	width: 220px;
	height: 800px;
	background-color: #eee;
}

#column2 {
	float: right;
	width: 595px;
	height: 800px;
	background-color: #fff;
	position: relative;
}

#column3 {
	float: right;
	width: 200px;
	height: 800px;
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
</style>

<link rel="stylesheet" type="text/css" media="screen"
	href="scripts/jquery_ui/flicker/css/smoothness/jquery-ui-1.7.2.custom.css" />

<script language="javascript" type="text/javascript"
	src="scripts/jquery-1.3.2.min.js"></script>

<script type="text/javascript"
	src="scripts/jquery_ui/js/jquery-ui-1.7.2.custom.min.js"></script>

<script type="text/javascript"
	src="scripts/jquery_ui/js/i18n/jquery-ui-i18n.js"></script>

<script language="javascript" type="text/javascript"
	src="scripts/jstree/jquery.tree.js"></script>

<script language="javascript" type="text/javascript"
	src="scripts/myutils.js"></script>

<script language="javascript" type="text/javascript"
	src="scripts/question.js"></script>

<script language="javascript" type="text/javascript"
	src="scripts/pickquestion.js"></script>

<link rel="stylesheet" href="styles/SexyButtons/sexybuttons.css"
	type="text/css" />


<script language="javascript" type="text/javascript"
	src="scripts/jGrowl-1.2.4/jquery.jgrowl_minimized.js"></script>
<link href="styles/table.css" rel="stylesheet" type="text/css">
<link href="styles/menu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css"
	href="scripts/jquery_panel/panel.css" />
<link rel="stylesheet" type="text/css" media="screen"
	href="scripts/jGrowl-1.2.4/jquery.jgrowl.css" />
</head>
<body>
<div id="menu_wrapper" class="black">
<div class="left"></div>
<ul id="menu">
	<li><a href="student-index.php">我的主页</a></li>
	<li><a href="loginout.php">退出</a></li>
</ul>
</div>
<div id="header"></div>
<div id="wrap">
<div id="column">
<div id="column1">
<!-- 本科目的章节开始 -->
<div class="mg10 exhibiton ex03">
<div class="exHead">
<div class="hTxt">
<div class="hTxtContent">
<h2><?php echo $grade_name.'-'.$sname?>
  <select id="semester">
		    <option value='u' <?php $sem_id=='u'?'selected':''?>>上学期</option>
		    <option value='d' <?php $sem_id=='d'?'selected':''?>>下学期</option>
  </select>
</h2>
</div>
</div>
<div class="hLeft"></div>
<div class="hRight"></div>
</div>
<div class="exBody" style="background-color: #FFF; height: 450px">
<div class="content" style="background-color: #FFF">
<div
	style="margin-top: 0px; margin-left: auto; margin-right: auto; width: 100%; background-color: #CCC">请选择教材版本:
<?php echo makeSelect("qst_bvser_id","select id,name from bookversion");?>
</div>

<div id="qst_chapter"
	style="margin-left: 0px; height: 500px; width:200px; overflow: auto"></div>
</div>
</div>
<div class="exFoot" style="background-color: #FFF">

<div class="fLeft"></div>
<div class="fRight"></div>
</div>
</div>
<!-- 本科目的章节统计结束-->
</div>
<div id="column2">
<div id="myinfopage"
	style="background-color: #fff; width: 590px; height: 785px;">
	<!-- 主要内容开始 -->
	<div class="mg10 exhibiton ex06">
<div class="exHead">
<div class="hTxt">
<div class="hTxtContent">
<h2>
您[<?php echo urldecode($tmail);?>]在本章节的积分情况
</h2>
</div>
</div>
<div class="hLeft"></div>
<div class="hRight"></div>
</div>
<div class="exBody" style="background-color: #FFF; height: 450px">
<div class="content" style="background-color: #FFF;">
<div
	style="margin-left: 0px; height: 400px; overflow: auto">
	<table>
	<thead>
	<tr>
	<th>章节</th>
	<th>勋章</th>
	<th>能力值</th>
	<th>做题数量</th>
	<th>正确率</th>
	<th>总共用时(s)</th>
	</tr>
	</thead>
	<tbody id="subdetails">
   
	</tbody>
	</table>
	
	
	</div>
</div>
</div>
<div class="exFoot" style="background-color: #FFF">

<div class="fLeft"></div>
<div class="fRight"></div>
</div>
</div>

	
	
	
	<!-- 主要内容结束 -->
	</div>
</div>
<div class="clear"></div>
</div>
<div id="column3"><!-- 学习时间统计开始 -->
<div class="mg10 exhibiton ex03">
<div class="exHead">
<div class="hTxt">
<div class="hTxtContent">
<h2>学习时间统计</h2>
</div>
</div>
<div class="hLeft"></div>
<div class="hRight"></div>
</div>
<div class="exBody" style="background-color: #FFF; height: 120px">
<div class="content" style="background-color: #FFF">
<ul style="margin-top: 10px; padding-left: 20px; list-style: none">
	<li style="height: 20px;">今日学习时间:<label id="atime"><?php echo $tsum;?>
	分钟</label></li>
	<li style="height: 20px;">昨日学习时间:<label id="btime"><?php echo $ysum;?>
	分钟</label></li>
	<li style="height: 20px;">本周学习时间:<label id="ctime"><?php echo $wsum;?>
	分钟</label></li>
	<li style="height: 20px;">累计学习时间:<label id="dtime"><?php echo $ssum;?>
	分钟</label></li>
</ul>
</div>
</div>
<div class="exFoot" style="background-color: #FFF">

<div class="fLeft"></div>
<div class="fRight"></div>
</div>
</div>
<!-- 学习时间统计结束--> <!-- 来访好友 -->
<div class="mg10 exhibiton ex03">
<div class="exHead">
<div class="hTxt">
<div class="hTxtContent">
<h2>来访好友</h2>
</div>
</div>
<div class="hLeft"></div>
<div class="hRight"></div>
</div>
<div class="exBody" style="background-color: #FFF; height: 500px">
<div class="content" style="background-color: #FFF"><?php 

$luser = $tmail;
$sql = "select f.friend fm ,u.avatar avt,u.localname lname
                   from myfriend f,user u
                   where f.email='$luser'
                      and u.email = f.friend
                   limit 0,9"; 
//echo ($sql);
$result = query($sql);
$r=0;
while($row=mysql_fetch_assoc($result)){
	$fm = $row['fm'];
	$avt = $row['avt'];
	$lname = $row['lname'];
	echo "<a href='findfriend.php?userId=$fm' target='_blank'>
           	          <image src='$avt' width='60' height='65' alt='$lname' /></a>";
	$r++;
	if($r%3==0)echo "<br/>";


}


?></div>
</div>
<div class="exFoot" style="background-color: #FFF">

<div class="fLeft"></div>
<div class="fRight"></div>
</div>
</div>
<!-- 来访好友结束 --></div>
<div class="clear"></div>
</div>
<div id="footer"><br />

</div>
<script language="javascript">
<!--
  
  $(loadPage);
  myGrade = new Option();
  myGrade.value = <?php echo $grade_id;?>;
  myGrade.text  = '<?php echo $grade_name;?>';
  mySubject = {};
  mySubject.value = <?php echo $sid;?>;
  semester = {};
  semester.value = '<?php echo $sem_id;?>';
  function loadPage(){
	
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
  }   

  function selectCallback(){
     
  }
  //表格主界面内容
  var debody = $("#subdetails");
  function  chapterOpenCallback(node,tree){
	 
	  //alert(node.id);
	  var myparam = {};
	  var myemail = '<?php echo urldecode($tmail);?>';
	  
	  var cpts = new Array();
	// 计算能力值,并显示,构造表格
	  var children = tree.children(node);
	  //alert(children.length);
	  if(children){ 
	  	$.each(children, function(key, node){

	          //章节编号
              var cid   = node.id;
              //章节名称
		      var cname = tree.get_text(node);
              cpts[key] = cid;
		  

		});
		myparam={action:"chtdtl",email:myemail,"chapter[]":cpts};	
		debody.html("<img src='images/ajax-loader.gif'/>");
		$.ajax({
              type:"POST",
              url:"question-data.php",
              data:$.param(myparam),
              dataType:"json",
              
              success:function(data){
			    debody.empty();               
                for(i=0;i<data.length;i++){
                	var line = $("<tr></tr>");   
                   line.append("<td>"+data[i].name+"</td>");
                   line.append("<td>"+data[i].xp+"</td>");
                   line.append("<td>"+data[i].medal+"</td>");
                   line.append("<td>"+data[i].qcount+"</td>");
                   line.append("<td>"+data[i].rrate+"</td>");
                   line.append("<td>"+data[i].avgTime+"</td>");
                   debody.append(line); 
                }
                 

              },
              error:function(msg){
                 alert("错误:\n"+(msg));
              }

			});	
	  }
  }
//-->
</script>
<div id="dialog"></div>
</body>
</html>
