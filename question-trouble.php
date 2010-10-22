<html>
<head>
<script type="text/javascript">
var cindex=-1;
$(function(){ 	
	var mygrid=$("#qrptlist").jqGrid({
	    url:'question-trouble-controller.php',
	    datatype: 'json',
	    mtype: 'GET',
	    colNames:['编号','题目编号', '上报者','问题描述'],
	    colModel :[ 
	      {name:'id', index:'id', width:55},	
	      {name:'qid', index:'question_id', width:100},        
	      {name:'email',index:'email',width:100},
	      {name:'reason',index:'reason',width:100}	     
		],
	
	    pager: '#qrptpager',
	    rowNum:10,
	    rowList:[10,20,30],
	    rownumbers: true, 
	    gridview : true, 
	    sortname: 'id',
	    sortorder: 'asc',
	    viewrecords: true,
	    caption: '错题管理',
	    width:800,
	    height:200,
	    editurl:"question-trouble-controller.php",
	    multiselect: true,
	    // toolbar : [true,"top"], 
	    loadComplete: gridLoadComplete,
	    gridComplete: gridCompleteCallback,
	    afterInsertRow:afterInsertRowCallback,
	    loadError:function(xhr,st,err){loadErrorCallback(xhr,st,err);}
	  }).navGrid("#qrptpager",{edit:false,add:false,del:true});
	  	  
	  $("#edqrpt").click( function() {
		   var id = $("#qrptlist").jqGrid('getGridParam','selarrrow');
		   var myid = id[0];
		   if(myid!='' && myid!='undefined' && myid!=null){
        	   var ret = $("#qrptlist").jqGrid('getRowData',myid); 
        	   alert(ret.qid);
		       $('#qtabs').tabs('url' , 1 , 'question-edit.php?id='+ret.qid);
               $('#qtabs').tabs('select',1);       
		   
           }else{
               alert('没有选择行!');

           }

      }); 
  
      
      $("#qrptlist").jqGrid('filterToolbar'); 

});//end of document ready function 
function gridLoadComplete(){
	
	
}
function gridCompleteCallback(){}
function afterInsertRowCallback(rowid,aData){ 
 
} 
function pickdates(id){ 
	
}
function loadErrorCallback(xhr,st,err){
	$("#rsperror").html("Type: "+st+"; Response: "+ xhr.status + " "+xhr.statusText); 
}
</script>
</head>
<body>
<b>Response:</b><span id="rsperror" style="color:red"></span> 
<hr/>
<table id="qrptlist"></table>
<div id="qrptpager"></div>
<br />
<button id="edqrpt">编辑所选</button>
</body>
</html>
