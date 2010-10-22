<button id="qupdate">更新题目难度,好评度,平均时间</button>
<br />
<label id="qmsg"></label>
<script language="javascript">
<!--
   $(function(){
      $("#qupdate").click(function(){
           var t = $(getEventTarget());
           t.attr("disabled",true);
           $("#qmsg").html("<img src='images/ajax-loader.gif'/>正在更新...");
           $.ajax({
                type:"POST",
                url:"question-data.php",
                data:"action=qupdate",
                success:function(msg){
        	   $("#qmsg").html("更新完成...");
        	   t.attr("disabled",false);
               },
                error:function(msg){
            	   t.attr("disabled",false);
                }




               });





       });

   });

//-->
</script>
