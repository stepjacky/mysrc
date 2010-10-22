<style type="text/css">
<!--
.caption {
	font-size: 20px;
	font-weight: bold;
	text-transform: capitalize;
	color: #FFF;
	background-color: #333;
	line-height: 45px;
}

.urmk {
	border: thin solid #FC6;
}

#nyrclose {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bolder;
	color: #CC0;
	background-color: #FFF;
	text-align: center;
	display: block;
	border: 1px solid #CF9;
	cursor: default;
	filter: Chroma(Color =     blue);
}
-->
</style>
<table width="509" height="336" border="0" align="center"
	cellpadding="0" cellspacing="0">
	<caption class="caption">答题结果</caption>
	
	<tr>
		<td>正确答案是:</td>
		<td colspan="3">
<span style="font-size:18px;font-weight:bold;color:blue">		
<?php echo $_GET['crt']; ?>
</span>

</td>
	</tr>
	<tr>
		<td width="122">您的回答是:</td>
		<td colspan="3">
	 	<span style="font-size:18px;font-weight:bold;color:blue">	
     <?php echo $_GET['urt']; ?></td>
     </span>
	</tr>
	<tr>
		<td>结果</td>
		<td colspan="3"><img id="rimg" /><?php echo $_GET['urst']; ?> <span
			id="qtip" style="color: #a00; font-size: 11px;"></span></td>
	</tr>
	<tr>
		<td colspan="4" bgcolor="#CCCCCC">对正确答案的解释:</td>
	</tr>
	<tr>
		<td height="82" colspan="4" valign="top" class="urmk"><?php echo $_GET['urmk']; ?></td>
	</tr>
	<tr>
		<td>评价题目:</td>
		<td colspan="2"><label>难度 <select name="diffculity" id="diffculity"
			onChange="updateDiffculity()">
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
		</select> </label></td>
		<td width="278"><label>好评度 <select name="reputation" id="reputation"
			onChange="updateReputation()">
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
		</select> </label> <span style="color: #f00; font-size: 11px;">提示:评价题目可获额外加分</span>

		</td>
	</tr>
	<tr>
		<td colspan="4" align="center">
		<center>
		<button id="nyrclose">关闭</button>
		</center>

		</td>
	</tr>
</table>
<?php
require_once "included/database.php";
$email =  urlencode($_GET['email']);
$qid   =  $_GET['qid'];
$count = getCountByWhere("user_result","email='$email' and question_id=$qid");
$isAsked = ($count!=0)?true:false;
//loginfo($count);
//loginfo($isAsked);
//loginfo($email);

?>
<script language="javascript">
<!--  

  
  $(function(){
	var isAsked = <?php echo $isAsked==true?'true':'false';?>;
    var rimg = $("#rimg");
    var qtip = $("#qtip");
    var dft  = $("#diffculity");
    var rep  = $("#reputation");
     
	if(isAsked==true){
      rimg.attr("src","images/subimg/ask-already.png");
      qtip.text("已经回答过此题!");
      dft.attr("disabled",true);
      rep.attr("disabled",true);
	}else{
      var uft = "<?php echo $_GET['uft'];?>";
      if(uft=='y'){
        rimg.attr("src","images/subimg/ask-right.png");  
      }else if(uft=='n'){
    	rimg.attr("src","images/subimg/ask-wrong.png");
      }
    }    
	$("#nyrclose").click(function(){
		$.nyroModalRemove();   
		if(isAsked==false){		
		var tmedal = Math.trunc(medal,10);
		if(tmedal==1){	
		   myQst.medal = 1;
		   medal= medal%10;
		};
		var dfg={};
	    dfg.type="POST";
	    dfg.url="question-data.php";
	    dfg.data = $.param(myQst);
	    dfg.error=function(msg){
	          alert(msg);
	    };  
	    $.ajax(dfg);
		} 
 
     });		 
			 
  });
//-->
</script>
