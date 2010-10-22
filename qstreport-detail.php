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
-->
</style>
<table width="509" height="255" border="0" align="center"
	cellpadding="0" cellspacing="0">
	<caption class="caption">
	题目错误反馈
	</caption>
	<tr>
		<td height="31" colspan="4">请填写错误原因:</td>
	</tr>
	<tr>
		<td colspan="4" align="left" valign="top"><center>
		  <textarea name="reason" id="reason" 
           style="width:100%; height:200px; 
           margin:0 0 0 0; 
           background-color:#CCC;
           border:#666 1px solid"
           onMouseOver="this.style.backgroundColor='#BBB'"
           onMouseOut="this.style.backgroundColor='#CCC'"
          ></textarea>
	    </center>		</td>
	</tr>
    <tfoot>
    <tr>
    <td align="center">
    <center>
    <button id="nyrclose" class="sexybutton"><span><span><span class="ok">提交</span></span></span></button>
    
    <button onclick="$.nyroModalRemove(); return false;" class="sexybutton"><span><span><span class="cancel">
             退出
</span></span></span></button>	
    
    </center>
    </td>
    </tr>
    </tfoot>
</table>
<?php
require_once "included/database.php";
$email =  urlencode($_GET['email']);
$qid   =  $_GET['qid'];
?>
<script language="javascript">
<!--  
  var qid  = <?php echo $qid;?>;
  var mail = '<?php echo $email;?>';
  
  $(function(){	 
	$("#nyrclose").click(function(){
		var reason  = $("#reason");
		if(reason==null || reason==''){
			$.nyroModalRemove();
			return;
		}
		$.nyroModalRemove();
        var myparam = {};
        myparam.qid = qid;
        myparam.email = mail;
		myparam.reason = $("#reason").val();
        myparam.action = "qsterror";
        $.ajax({
            type:"POST",
            url:"question-data.php",
            data:$.param(myparam),
            success:function(msg){
            },
            error:function(msg){
               alert(msg);

                }


            });		
		
 
     });		 
			 
  });
//-->
</script>
