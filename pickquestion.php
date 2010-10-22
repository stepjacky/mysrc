<?php
session_start();
$nick='';
$medal = 0;
$exp=0;
$simage='';
$sname ='';
if(isset($_SESSION['loginuser']) && isset($_SESSION['usertype'])){
	if($_SESSION['usertype']!='U'){
		$url = "login.php";
		header ("HTTP/1.1 303 See Other");
		header ("Location: $url");
		exit(0);
	}else{
		if(!isset($_GET['sid']) || !isset($_GET['email'])){
			exit(0);
		}
		require_once "included/database.php";
		$sid = $_GET['sid'];//学科编号
		$email = $_GET['email'];
		$grade_id=-1;
		$grade_name = '';

		$tmail = urlencode($email);
		$nick  = getFieldValue("select localname from user where email='$tmail'");//昵称
		$result = query("select image, name from subject where id=$sid");
		while($row = mysql_fetch_assoc($result)){
			$sname  = $row['name'];
			$simage = $row['image'];
		}


		$sql="select g.id gid , g.name gname from grade g,user u where u.email='$tmail' and g.id=u.grade_id";
		//echo $sql;
		$result = query($sql);
		while($row = mysql_fetch_assoc($result)){
			$grade_id  = $row['gid'];
			$grade_name = $row['gname'];
		}
		$month=getdate();
		$m =$month['mon'];
		$semester_name=$m>6?'下学期':'上学期';
		$sem_id = 	$m>6?'d':'u';
		$sql = "select sum(xp) sxp ,sum(medal) smedal from userexp where email='$tmail' and chapter_id in (select id from chapter where subject_id=$sid)";
		//loginfo("检出问题页 :".$sql);
		$result = query($sql);
		while($row = mysql_fetch_assoc($result)){
			$exp   = $row['sxp'];
			$medal = $row['smedal'];
		}
        //loginfo("运行到此".getlastmod());
        $sql = "select count(distinct question_id) 
                from user_result 
                where email='$tmail' and  
                chapter_id in (
                        select id 
                        from chapter 
                        where subject_id=$sid 
                               and grade_id=$grade_id 
                               and semester='$sem_id')";
        //loginfo($sql);
        //总题数
        $doneQst = getFieldValue($sql);
        $sql = "select count(distinct question_id) 
                from user_result 
                where email='$tmail' 
                     and  correct='y'
                     and  chapter_id in (
                        select id 
                        from chapter 
                        where subject_id=$sid 
                               and grade_id=$grade_id 
                               and semester='$sem_id')";
        $doneRight = getFieldValue($sql);
        //正确率
        $rightRate="0 %";
        if($doneQst!=0)
         $rightRate = sprintf("%.1f %%",$doneRight*100/$doneQst);
        /*
        $sql = "select count(avgtime) from question where id in(
                select question_id 
                from user_result 
                where email='$tmail' 
                    and  chapter_id in(
                        select id 
                        from chapter 
                        where subject_id=$sid 
                               and grade_id=$grade_id 
                               and semester='$sem_id'))";
        */
        $sql="select sum(TIME_TO_SEC(TIMEDIFF(end_time,start_time)))/60
              from user_result where question_id 
                               in(
                                 select id from question
                                     where(
                                        qst_subject_id=$sid
                                    and qst_grade_id=$grade_id
                                    and semester='$sem_id' 
                                     
                                     )
                               )
        
        ";
        // and  correct='y'
       //本章节所有题目平均时间
       $avgtime = sprintf("%.1f",(getFieldValue($sql)/60))." 分钟";
		 
	}
}else{
	$url = "login.php";
	header ("HTTP/1.1 303 See Other");
	header ("Location: $url");
	exit(0);
}
//获取在线学习时间
//今天的
$tsum = getTodayTime($tmail);
//昨天的
$ysum = getYestodayTime($tmail);

$wsum = getTheWeekTime($tmail);
//累积的
$ssum = getTotalTime($tmail);

//获取在线时间结束
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>学生主页</title>
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
	height: 700px;
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
	width: 220px;
	height: 700px;
	background-color: #eee;
}

#column2 {
	float: right;
	width: 595px;
	height: 470px;
	background-color: #fff;
	position: relative;
}

#column3 {
	float: right;
	width: 200px;
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
</style>

<link rel="stylesheet" type="text/css" media="screen"
	href="scripts/jquery_ui/flicker/css/smoothness/jquery-ui-1.7.2.custom.css" />

<link rel="stylesheet" type="text/css" media="screen"
	href="scripts/nyroModal/styles/nyroModal.css" />

<link href="styles/table.css" rel="stylesheet" type="text/css" />
<link href="styles/menu.css" rel="stylesheet" type="text/css" />
<link href="styles/SexyButtons/sexybuttons.css" rel="stylesheet" type="text/css"/>
<script
	language="javascript" type="text/javascript"
	src="scripts/jquery-1.3.2.min.js"></script> <script
	type="text/javascript"
	src="scripts/jquery_ui/js/jquery-ui-1.7.2.custom.min.js"></script> <script
	type="text/javascript"
	src="scripts/jquery_ui/js/i18n/jquery-ui-i18n.js"></script> <script
	type="text/javascript"
	src="scripts/nyroModal/js/jquery.nyroModal-1.6.2.js"></script> <script
	language="javascript" type="text/javascript"
	src="scripts/jstree/jquery.tree.js"></script> <script
	language="javascript" type="text/javascript" src="scripts/myutils.js"></script>
<script language="javascript" type="text/javascript"
	src="scripts/question.js"></script> <script language="javascript"
	type="text/javascript" src="scripts/pickquestion.js"></script>

</head>
<body>
<div id="menu_wrapper" class="black">
			<div class="left"></div>
			<ul id="menu">
				<li class="active"><a href="loginout.php">退出</a></li>
				<li><a href="student-index.php">我的主页</a></li>
			
		    </ul>
</div>
<div id="header"></div>
<div id="wrap">
<div id="column">
<div id="column1">
<div id="content-top">
<table width="93%"  border="0" cellpadding="0" cellspacing="0" style="width:90%">
	<tr>
		<td width="29%">学&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;科</td>
		<td width="32%"><?php echo $sname;?></td>
		<td width="39%">&nbsp;</td>
	</tr>
	<tr>
		<td>所在年级</td>
		<td><?php echo makeSelect("qst_grade_id","select id,name from grade where parent_id!=-1");?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>学期</td>
		<td><select id="semester">
		    <option value='u'>上学期</option>
		    <option value='d'>下学期</option>
		</select></td>
		<td></td>
	</tr>
	<tr>
		<td>教材版本</td>
		<td><?php echo makeSelect("qst_bvser_id","select id,name from bookversion");?></td>
		<td>&nbsp;</td>
	</tr>
</table>

<div style="margin-top: 10px;">
<div id="qst_chapter"
	style="margin-left: 0px; height: 400px;width:215px;white-space:nowrap;text-overflow:ellipsis;overflow:auto;"></div>

</div>
</div>
</div>
<div id="column2">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="17%" rowspan="4" valign="middle"><img
			src="<?php echo $simage;?>" width="72" height="72"
			style="vertical-align: bottom" /> <span
			style="font-size: 15px; font-weight: bolder; color: #F60"> <?php echo $sname;?></span>
		</td>
		<th valign="middle" colspan="2">本学科概况[<a href="mysubject-detail.php<?php echo '?email='.($tmail).'&sid='.$sid?>" target="_blank">详细得分</a>]</th>
	</tr>
	<tr>
		<td colspan="2" height="29" valign="middle">
        <label>做过的题数: <?php echo $doneQst; ?></label>
    </tr>
    <tr>
		<td width="35%" height="29" valign="middle">
		<label><?php echo $sname;?>能力值: <?php echo $exp; ?></label>
		</td>
        <td width="44%">
        <label>勋章 :  
		<img src='images/level/level-<?php echo trunc($medal,10);?>.png' style="vertical-align:middle;" />
		</label>
		</td>
	</tr>
    <tr>
		<td width="35%" height="29" valign="middle">
        <label>正确率: <?php echo $rightRate; ?></label>
		</td>
        <td>
        <label>总共用时 : <?php echo $avgtime;?></label></td>
        <td width="4%"></td>
		
	</tr>
   
</table>
<div style="margin-left: auto; margin-right: auto; width: inherit; height: 30px; text-align: left; background-color: #CCC;border:#999 1px solid;">
<button type="reset" class="sexybutton sexysimple sexyblue" id="beginq" onClick="pickQuestion();">开始答题</button>
<button type="reset" class="sexybutton sexysimple sexyred"  id="errorBtn" >报告错误</button>
◆&nbsp;<label id="qinfo"></label><label id="cxp"></label>
◆&nbsp;共有<span  id="qlen" style="color:red"></span>道 
<input type='text' style='width:25px;height:12px;' id='jumpIdx' onblur='judgeNumber(this)'/>
<button  id="goBtn" onClick="gotoQuestion();" class="sexybutton" type="reset"><span><span><span class="find">转到</span></span></span></button>
</div>
<div
	style="margin-left: auto; margin-right: auto; width: inherit; height: 30px; text-align: left; background-color: #BBB;border:#999 1px solid;">
◆&nbsp;
第 <label id='qindex' style="font-weight: bold; color: red;">_</label> 题
◆&nbsp;难度&nbsp;  <span id="dft" style="color:blue"></span> 
◆&nbsp;好评度&nbsp;  <span id="rpt" style="color:blue"></span>
◆&nbsp;出题者&nbsp;  <span id="fireqst" style="color:#9C0"></span>
◆&nbsp;题号范围&nbsp;  <select id="qrange"  name="qrange" onChange="setStartIndex();"></select>
</div>
<div id="mainqst"
	style="font-size:14px;
	width: inherit; 
	margin-left: auto; 
	margin-right: auto; 
	background-color: #FC0; 
	height: auto;">


<div id="qdesc"
	style="margin-left: auto; margin-right: auto; width: inherit; height: 230px; background-color: #FFC; overflow: auto; text-align: justify; border:#999 1px solid">

</div>
<div
	style="width: inherit; height: 30px;border:#999 1px solid; background-color: #CCC; overflow: auto;font-size:14px; font-weight:bold;">
请选择答案</div>
<div
	style="width: inherit; height: 190px; background-color: #FFF; overflow: auto;border:#999 1px solid">
<ul id="qopts"
	style="list-style: none; margin-top: 10px; line-height: 25px;">
</ul>

</div>
<div
	style="margin-left: auto; margin-right: auto; width: inherit; height: 30px; text-align: right; background-color: #CCC;border:#999 1px solid; vertical-align: middle; padding-bottom:0px;">
  
<button id="bprev" onClick="pickPrev();" type="reset" class="sexybutton"><span><span>上一题</span></span></button>
<button id="banswer" onClick="showResults();" class="sexybutton sexyorange nyroModal"><span><span><span class="ok">答案</span></span></span></button>
<button id="bnext" onClick="pickNext();" type="reset" class="sexybutton"><span><span>下一题</span></span></button>
                                                                                               
</div>
</div>

</div>
<div class="clear"></div>
</div>
<div id="column3">
<div id="content-r-top">
<div style="margin-top: 10px; text-align: center">学习时间统计</div>
</div>
<div id="content-r-mid">
<div style="margin-top: 10px">
<ul style="margin-top: 30px; padding-left: 20px; list-style: none">
	<li style="height: 20px; overflow: hidden">今日学习时间 :<?php echo $tsum;?>
	分钟</li>
	<li style="height: 20px; overflow: hidden">昨日学习时间 :<?php echo $ysum;?>
	分钟</li>
	<li style="height: 20px; overflow: hidden">本周学习时间 :<?php echo $wsum;?>
	分钟</li>
	<li style="height: 20px; overflow: hidden">累计学习时间 :<?php echo $ssum;?>
	分钟</li>
</ul>
</div>
<center><img width="180" src="images/spector.png" /><br />
</center>
</div>
<div id="content-r-end">
<div style="margin-top: 20px"></div>

</div>

</div>
<div class="clear"></div>
</div>
<div id="footer"><br />

</div>
<script language="javascript">
<!--
  $(loadPage);
  var myemail = '<?php echo $email;?>';
  var qlist = {};
  var qdesc = $("#qdesc");
  var qopts = $("#qopts");
  var bnext  =$("#bnext");
  var bprev  =$("#bprev");
  var banswer=$("#banswer");
  var qinfo  =$("#qinfo");
  var rstRight = $("#resultRight");
  var rstRemark= $("#resultRemark");
  var errorBtn =$("#errorBtn");
  var goBtn = $("#goBtn");
  var cindex = 0;
  var qlength = 0;
  var medal=0;
  selectedGrade = <?php echo $grade_id;?>;
  var toEnd = false;
  var toTop = false;
  var qidx = $("#qindex");
  var needLoad = false;
  var startIdx = 1;
  var totalSeuque = 0;
  var myQst = {};
  myQst.action='edtTime';
  myQst.email = myemail;
  myQst.dft=0;
  myQst.rep=0;
  myQst.cid = myChapter;
  var mylibs      = {};
  mylibs.myGrade   = "请选择年级";
  mylibs.mySubject = "请选择学科";
  mylibs.myChapter = "请选择章节";
  mylibs.mytree    = "请先加载章节";
 // mylibs.mynode    = "请选择要答题的章节";
  
  //page inilize
  function loadPage(){
	  var grade = $("#qst_grade_id");
	  grade.attr("value",selectedGrade);
	  $("#semester").attr("value",'<?php echo $sem_id;?>');
	  myGrade   	  = new Option();//1
	  mySubject 	  = new Option();//2
	  mySubject.value ='<?php echo $sid;?>';
	  myChapter 	  = {};//3
	  myGrade.value   = '<?php echo $grade_id;?>';
	  myGrade.text    = '<?php echo $grade_name;?>';
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
	  bprev.attr("disabled",true);
	  bnext.attr("disabled",true);
      banswer.attr("disabled",true);
      errorBtn.attr("disabled",true);
      goBtn.attr("disabled",true);
      errorBtn.click(function(){
        	  showErrorReport();

      });
     
     
  }
// 开始答题回调
  function pickQuestion(){
	  var ft = checkVarArray(mylibs);
	  if(!ft)return;
      loadQuestion(startIdx-1); 
      
  }

  
function loadQuestion(startIndex){
	var bver = myVer.value;//4
    var sem  = $("#semester").val();//5
    var myparam = {
  	      gid:myGrade.value,
  	      sid:mySubject.value,
  	      cid:myChapter,
            bid:bver,
            smid:sem,
            action:'pick',
            start:startIndex
  	      };
    qdesc.html("正在加载...<br/><img src='images/ajax-loader.gif'/>");
    qopts.empty();
    qinfo.html(mytree.get_text(mynode));
    myQst.cid = mynode.id;
    $.ajax({
        type:"POST",
        url:'question-data.php',
        dataType:'json',
        data:$.param(myparam),
        success:function(data){
            if(data){
               if(data.rows){
            	 qlist = data.rows;  
            	 qlength = qlist.length; 
         	     //alert(qlength);
         	     parseQuestion(qlist,0);         	      
         	     errorBtn.attr("disabled",false);
         	     goBtn.attr("disabled",false);
               }else{
            	 qdesc.html("本章暂时没有习题");  
               }
            }else{
            	 qdesc.html("本章暂时没有习题");  
            }
           
            
        },
        error:function(data){
            message("加载题目错误 原因:<br/>:"+data);
        }
      


        });

}
  
function parseQuestion(tlist,index){
	  //alert(index+ " === "+typeof(index));
	  
	  index = index*1;
	  myQst.startTime= new Date().format("yyyy-MM-dd hh:mm:ss");
	  setButtonStatus(); 
	  qidx.html(index+1);
	  //alert(tlist.length+" , "+index);
	  var nextq = tlist[index];
      qdesc.html(nextq.cell.desc);
      var olink = $("<a></a>");
      olink.attr("href","teacher-index.php?userId="+nextq.cell.email);
      olink.attr("target","_blank");
      var stxt = $("<span></span>");
      stxt.css("color","#06c");
      stxt.text(nextq.cell.uname);
      olink.append(stxt);
      $("#dft").text(nextq.cell.difficulty);
      $("#rpt").text(nextq.cell.reputation);
      $("#fireqst").empty();
      $("#fireqst").append(olink);
      var answers = nextq.answers;
      qopts.empty();
      for(key in answers){
	     var vname = answers[key].vname;
	     var vkey = answers[key].key;
         var opt = $("<li style='line-height:25px;'></li>");
         var lab = $("<label></label>");
         var ipt = $("<input type='checkbox' name='myanswer[]' value='"+vkey+"'/>");
         lab.append(vkey.toUpperCase());
         lab.append(ipt);
         lab.append(vname); 
         opt.append(lab);         
         qopts.append(opt);
   	  }
}




function hasPrev(){
	var len = qlist.length;
	if(cindex>0){
	   cindex--;	  
	}
	return toTop=(cindex==-1);
}
function hasNext(){
	var len = qlist.length;
    if(cindex<len){
	   cindex++;    
	}    
	return (toEnd=(cindex==len));		
}

function pickPrev(){
	if(!hasPrev()){
	   parseQuestion(qlist,cindex);
	}
	
}

function pickNext(){
	if(!hasNext()){
		
       parseQuestion(qlist,cindex);
    }
	
}

function setButtonStatus(){
	var len = qlist.length;
	banswer.attr("disabled",false);
    //alert(cindex+' , '+(len));
	
	if(cindex==0){
		 
		 bprev.attr("disabled",true);
		 bnext.attr("disabled",false);
    }
    

    if(cindex>0 && cindex <len){
    	
    	 bprev.attr("disabled",false);
		 bnext.attr("disabled",false);
    }
    if(cindex == len-1){
   	 
   	 bprev.attr("disabled",false);
		 bnext.attr("disabled",true);
   }
   if(len==0 || (len-1)==0){
    	 bprev.attr("disabled",true);
		 bnext.attr("disabled",true);
        
   }
   if(len==0){
	   banswer.attr("disabled",true);

	   }
  
}

function initilize(){
	 cindex=0;
     toEnd=false;
     toTop=false;
     medal=0;
     qdesc.empty();// = $("#qdesc");
     qopts.empty();// = $("#qopts");
     bnext.attr("disabled",true);//  =$("#bnext");
     bprev.attr("disabled",true);//  =$("#bprev");
     banswer.attr("disabled",true);
     errorBtn.attr("disabled",true);
     goBtn.attr("disabled",true);
}

//章节选择的回调
function selectCallback(){
	initilize();
	var bver = myVer.value;//4
    var sem  = '<?php echo $sem_id;?>';//5
	var tparam = {
	  	      gid:myGrade.value,
	  	      sid:mySubject.value,
	  	      cid:myChapter,
              bid:bver,
	          smid:sem,
	          action:'chtxp',
	          email:'<?php echo $email;?>'
	  	      };	
	var dfg={type:"POST",url:"question-data.php",dataType:"json",data:$.param(tparam)};
    $("#beginq").attr("disabled",true);
    dfg.success=function(data){
       $("#cxp").html("[能力值:&nbsp;"+data.xp+",勋章:&nbsp;"+data.medal+"]");
       var count = data.count;
       $("#qlen").html(count);
       var r =  Math.trunc(count,100);
       var ln = count%100;
       var qrange = $("#qrange");
       qrange.empty();
       if(r==0){
           qrange.append("<option value='0'>1-"+ln+"</option>");
       }else{
           var i=0;
           for(i=0;i<r;i++){
               var opt = new Option();
               opt.value=   i*100+1;
               opt.text =  (i*100+1)+"---"+((i+1)*100);  
        	   qrange.append(opt); 
           }
           if(ln!=0){
               var opt = new Option();
               opt.value = i*100+1;
               opt.text = (i*100+1)+"---"+(i*100+1+ln);
           }

       }
       $("#beginq").attr("disabled",false);
    };
    dfg.error=function(msg){

       alert(msg);
        };
	$.ajax(dfg);
}
//报告错误的回调
function showErrorReport(){
   var e = getEvent();
   if(e.preventDefault) e.preventDefault();
   if(e.returnValue) e.returnValue=false;
   var myparam = {};
   var rs =qlist[cindex];
   myparam.email = myemail;
   myparam.qid = rs.qid;
   $.nyroModalManual({
       url:'qstreport-detail.php?'+$.param(myparam),
       modal:true
   }); 
}
//查看答案回调
function showResults(){	   
	var e = getEvent();
	if(e.preventDefault) e.preventDefault();
	if(e.returnValue) e.returnValue=false;
	var myparam = {};
	var rs =qlist[cindex];
    var crt='';
    $.each(rs.correct,function(i,n){
       crt+= n + ' ';
    });   
    myparam.crt = crt;
    var ys = $(":checkbox[checked=true]");
    var i=0;
    var ystr=[];
    var urt='';
    $.each(ys,function(i,n){
       ystr[i++]=n.value;
       urt+= n.value + '  ';
    });   
    myparam.urt= urt;
    var ft = insect(rs.correct,ystr);
    var urst = (ft==true?'你答对了':'你答错了');
    myparam.urst = urst;
    var uft  = (ft==true?'y':'n');
    var urmk = rs.cell.remark;
    myparam.urmk = urmk==''?'\t\t':urmk;    
    myparam.email = myemail;
    myparam.qid = rs.qid;
    myparam.uft = uft;
    $.nyroModalManual({
        url:'answertip.php?'+$.param(myparam),
        modal:true
    });    
	//计分
	myQst.qid = rs.qid;
	myQst.endTime= new Date().format("yyyy-MM-dd hh:mm:ss");
	myQst.correct= ft==true?'y':'n';   
    myQst.isRight = ft;
    myQst.ev = ft==true?3:0;
    if(ft==true)
       medal++;
    else if(ft==false){
       medal=0;
    }
    
	  
}

function  chapterOpenCallback(node,tree){
	// ..do nothing on this page;
}

function updateDiffculity(){
	var el = getEventTarget();
	var v = $(el).val();	
    myQst.dft = v;	    
    if(myQst.isRight==true) 
        myQst.ev= 4;
    else
        myQst.ev= 2;
    
}
function updateReputation(){
	var el = getEventTarget();
	var v = $(el).val();	
    myQst.rep = v;	     
    if(myQst.isRight==true) 
        myQst.ev= 4;
    else
        myQst.ev= 2;
    
}
function setStartIndex(){
	var el = $(getEventTarget());
	var s  =el.val();
	startIdx = s;
	pickQuestion();
}
function scall(){
	document.getElementById("menu_wrapper").style.top=(document.documentElement.scrollTop)+"px";
	document.getElementById("menu_wrapper").style.left=(document.documentElement.scrollLeft)+"px";
}
function gotoQuestion(){
	var jidx  = $("#jumpIdx").val();
	if(jidx>qlength)jidx = qlength-1;
	if(jidx<1 || !jidx || jidx=='')jidx = 1;
	cindex = jidx*1-1;
	parseQuestion(qlist,cindex);
	
}
//window.onscroll=scall;
//window.onresize=scall;
//window.onload=scall;
//-->
</script>
<div id="dialog"></div>
</body>
</html>
