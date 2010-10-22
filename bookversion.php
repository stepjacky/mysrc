<html>
<head>
<script type="text/javascript">
var cindex=-1;
$(function(){ 	
	var mygrid=$("#bookversion").jqGrid({
	    url:'bookversion-controller.php',
	    datatype: 'json',
	    mtype: 'GET',
	    colNames:['编号','名称','备注'],
	    colModel :[ 
	      {name:'id', index:'id', width:55}, 
	      {name:'name', index:'name', width:100,editable:true},
	      {name:'remark',index:'remark',width:200,editable:true}
	    ],
	    pager: '#bookversionpager',
	    rowNum:10,
	    rowList:[10,20,30],
	    rownumbers: true, 
	    gridview : true, 
	    sortname: 'id',
	    sortorder: 'asc',
	    viewrecords: true,
	    caption: '教材版本管理',
	    width:500,
	    height:200,
	    editurl:"bookversion-controller.php",
	    multiselect: true,
	    toolbar : [true,"top"], 
	    loadComplete: gridLoadComplete,
	    gridComplete: gridCompleteCallback,
	    afterInsertRow:afterInsertRowCallback,
	    loadError:function(xhr,st,err){loadErrorCallback(xhr,st,err);}
	  }).navGrid("#bookversionpager",{edit:true,add:true,del:true});
	  
	  $("#m1").click( function() { 
		  var s; 
		  s = $("#bookversion").jqGrid('getGridParam','selarrrow');
		  alert(s); 
	  }); 
	  $("#ed1").click( function() {
		   var s = $("#bookversion").jqGrid('getGridParam','selarrrow');
           if(s.length!=0){
		       cindex = s[0];		       
		   	   //$("#bookversion").jqGrid('editRow',cindex);
               //这一行是用来显示一个日期选择器在编辑的时候
		   	   $('#bookversion').jqGrid('editRow',cindex,true,pickdates); 
		   	   this.disabled = 'true';
		       $("#sved1,#cned1").attr("disabled",false);
		   
           }else{
               alert('没有选择行!');

           }

      }); 
	  $("#sved1").click( function() {
		        $("#bookversion").jqGrid('saveRow',cindex);
		        $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });
      $("#cned1").click( function() { 
                $("#bookversion").jqGrid('restoreRow',cindex);
                $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });  
      
      $("#bookversion").jqGrid('filterToolbar'); 

});//end of document ready function 
function gridLoadComplete(){
	var ret;	
	ret = $("#bookversion").jqGrid('getRowData',"1");
    //alert(ret.name); 
	
}
function gridCompleteCallback(){
	var ids = $("#bookversion").jqGrid('getDataIDs'); 
	for(var i=0;i < ids.length;i++){ 
		var cl = ids[i]; 
		be = "<input style='height:22px;width:20px;' type='button' value='E' onclick=\"$('#bookversion').editRow('"+cl+"');\" />"; 
		se = "<input style='height:22px;width:20px;' type='button' value='S' onclick=\"$('#bookversion').saveRow('"+cl+"');\" />"; 
		ce = "<input style='height:22px;width:20px;' type='button' value='C' onclick=\"$('#bookversion').restoreRow('"+cl+"');\" />"; 
		$("#bookversion").jqGrid('setRowData',ids[i],{act:be+se+ce});
	} 
}
function afterInsertRowCallback(rowid,aData){ 
    var r  =aData.id%2;
    if(r==0){
    	$("#bookversion").jqGrid('setCell',rowid,'name','',{color:'green'});
    }else{
    	$("#bookversion").jqGrid('setCell',rowid,'name','',{color:'red'});
    }
	
} 
function pickdates(id){ 
	$("#"+id+"_name","#bookversion").datepicker({dateFormat:"yy-mm-dd"}); 
}
function loadErrorCallback(){
	$("#rsperror").html("Type: "+st+"; Response: "+ xhr.status + " "+xhr.statusText); 
	 
}
</script>
</head>
<body>
<b>Response:</b><span id="rsperror" style="color:red"></span> 
<hr/>
<table id="bookversion"></table>
<div id="bookversionpager"></div>
<br />

</body>
</html>
