<?php
   if(!isset($_GET['email'])){
      echo "还没有选择任何用户";
      exit(0);
   }else{
   	 $email  =$_GET['email'];
   }
?>
<html>
<head>
<script type="text/javascript">
var cindex=-1;
var mygrid = {};
var idlist  = 'mlistx';
var idpager = 'mpagerx';
var jqlistid = "#"+idlist;
var jqpagerid = "#"+idpager;
$(function(){ 	
	
    var contar   = $("#dteaconerx");
    var dtable   = $("<table id='"+idlist+"'></table>");
    var navpager = $("<div id='"+idpager+"'></div>");
    contar.empty();
    contar.append(dtable);
    contar.append(navpager);	
	mygrid=$(jqlistid).jqGrid({
	    url:'dostat-controller.php?email=<?php echo $email;?>',
	    datatype: 'json',
	    mtype: 'GET',
	    colNames:['用户名','时间','学科','章节','题号','结果'],
	    colModel :[
	      {name:'username',index:'username',width:80},	     	
	      {name:'time', index:'time',width:200},
	      {name:'subject',index:'subject',width:60}, 
	      {name:'chapter',index:'chapter',width:250},
		  {name:'question',index:'question',width:50}, 
	      {name:'correct',index:'correct',width:50}
		],
	
	    pager: jqpagerid,
	    rowNum:10,
	    rowList:[10,20,30],
	    rownumbers: true, 
	    gridview : true, 
	    sortname: 'start_time',
	    sortorder: 'desc',
	    viewrecords: true,
	    caption: '学生做题统计',
	    width:680,
	    height:300,
	    editurl:'dostat-controller.php?email=<?php echo $email;?>',
	   // multiselect: true,
	   // toolbar : [true,"top"], 
	    loadComplete: gridLoadComplete,
	    gridComplete: gridCompleteCallback,
	    afterInsertRow:afterInsertRowCallback,
	    loadError:function(xhr,st,err){loadErrorCallback(xhr,st,err);}
	  }).navGrid(jqpagerid,{view:true,edit:false,add:false,del:false});
	  
});//end of document ready function 
function gridLoadComplete(){}
function gridCompleteCallback(){}
function afterInsertRowCallback(rowid,aData){}
function pickdates(id){ 
	$("#"+id+"_regtime",jqlistid).datepicker({dateFormat:"yy-mm-dd"});	
}
function loadErrorCallback(xhr,st,err){
	$("#rsperror").html("Type: "+st+"; Response: "+ xhr.status + " "+xhr.statusText); 
	 
}
</script>
</head>
<body>
<b>Response:</b><span id="rsperror" style="color:red"></span> 
<hr/>
<div id="dteaconerx" ></div>
</body>
</html>



