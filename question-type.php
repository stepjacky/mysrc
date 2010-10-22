<html>
<head>
<script type="text/javascript">
var cindex=-1;
$(function(){ 	
	var mygrid=$("#questiontype").jqGrid({
	    url:'question-type-controller.php',
	    datatype: 'json',
	    mtype: 'GET',
	    colNames:['编号','题目类型'],
	    colModel :[ 
	      {name:'id', index:'id', width:55}, 
	      {name:'name', index:'name', width:100,editable:true} 
	    ],
	    pager: '#questionpager',
	    rowNum:10,
	    rowList:[10,20,30],
	    rownumbers: true, 
	    gridview : true, 
	    sortname: 'id',
	    sortorder: 'asc',
	    viewrecords: true,
	    caption: '题目类型管理',
	    width:500,
	    height:200,
	    editurl:"question-type-controller.php",
	    multiselect: true,
	    toolbar : [true,"top"], 
	    loadComplete: gridLoadComplete,
	    gridComplete: gridCompleteCallback,
	    afterInsertRow:afterInsertRowCallback,
	    loadError:function(xhr,st,err){loadErrorCallback(xhr,st,err);}
	  }).navGrid("#questionpager",{edit:true,add:true,del:true});
	  
	  $("#m1").click( function() { 
		  var s; 
		  s = $("#questiontype").jqGrid('getGridParam','selarrrow');
		  alert(s); 
	  }); 
	  $("#ed1").click( function() {
		   var s = $("#questiontype").jqGrid('getGridParam','selarrrow');
           if(s.length!=0){
		       cindex = s[0];		       
		   	   //$("#questiontype").jqGrid('editRow',cindex);
               //这一行是用来显示一个日期选择器在编辑的时候
		   	   $('#questiontype').jqGrid('editRow',cindex,true,pickdates); 
		   	   this.disabled = 'true';
		       $("#sved1,#cned1").attr("disabled",false);
		   
           }else{
               alert('没有选择行!');

           }

      }); 
	  $("#sved1").click( function() {
		        $("#questiontype").jqGrid('saveRow',cindex);
		        $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });
      $("#cned1").click( function() { 
                $("#questiontype").jqGrid('restoreRow',cindex);
                $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });  
      
      $("#questiontype").jqGrid('filterToolbar'); 

});//end of document ready function 
function gridLoadComplete(){
	var ret;	
	ret = $("#questiontype").jqGrid('getRowData',"1");
    //alert(ret.name); 
	
}
function gridCompleteCallback(){
	var ids = $("#questiontype").jqGrid('getDataIDs'); 
	for(var i=0;i < ids.length;i++){ 
		var cl = ids[i]; 
		be = "<input style='height:22px;width:20px;' type='button' value='E' onclick=\"$('#questiontype').editRow('"+cl+"');\" />"; 
		se = "<input style='height:22px;width:20px;' type='button' value='S' onclick=\"$('#questiontype').saveRow('"+cl+"');\" />"; 
		ce = "<input style='height:22px;width:20px;' type='button' value='C' onclick=\"$('#questiontype').restoreRow('"+cl+"');\" />"; 
		$("#questiontype").jqGrid('setRowData',ids[i],{act:be+se+ce});
	} 
}
function afterInsertRowCallback(rowid,aData){ 
    var r  =aData.id%2;
    if(r==0){
    	$("#questiontype").jqGrid('setCell',rowid,'name','',{color:'green'});
    }else{
    	$("#questiontype").jqGrid('setCell',rowid,'name','',{color:'red'});
    }
	
} 
function pickdates(id){ 
	$("#"+id+"_name","#questiontype").datepicker({dateFormat:"yy-mm-dd"}); 
}
function loadErrorCallback(){
	$("#rsperror").html("Type: "+st+"; Response: "+ xhr.status + " "+xhr.statusText); 
	 
}
</script>
</head>
<body>
<b>Response:</b><span id="rsperror" style="color:red"></span> 
<hr/>
<table id="questiontype"></table>
<div id="questionpager"></div>
<br />
<button id="m1">获取所选行</button>
<button id="ed1">编辑所选</button>
<button id="sved1" disabled='true'>保存</button>
<button id="cned1" disabled='true'>退出</button>

</body>
</html>
