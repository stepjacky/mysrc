<html>
<head>
<script type="text/javascript">
var cindex=-1;
$(function(){ 	
	var mygrid=$("#school").jqGrid({
	    url:'school-controller.php',
	         
	    datatype: 'json',
	    mtype: 'GET',
	    colNames:['编号','学校名称'],
	    colModel :[ 
	      {name:'id', index:'id', width:55}, 
	      {name:'name', index:'name', width:100,editable:true} 
	    ],
	    pager: '#schoolpager',
	    rowNum:10,
	    rowList:[10,20,30],
	    rownumbers: true, 
	    gridview : true, 
	    sortname: 'id',
	    sortorder: 'asc',
	    viewrecords: true,
	    caption: '学校管理',
	    width:500,
	    height:200,
	    editurl:"school-controller.php",
	             
	    multiselect: true,
	    toolbar : [true,"top"], 
	    loadComplete: gridLoadComplete,
	    gridComplete: gridCompleteCallback,
	    afterInsertRow:afterInsertRowCallback,
	    loadError:function(xhr,st,err){loadErrorCallback(xhr,st,err);}
	  }).navGrid("#schoolpager",{edit:true,add:true,del:true});
	  
	  $("#m1").click( function() { 
		  var s; 
		  s = $("#school").jqGrid('getGridParam','selarrrow');
		  alert(s); 
	  }); 
	  $("#ed1").click( function() {
		   var s = $("#school").jqGrid('getGridParam','selarrrow');
           if(s.length!=0){
		       cindex = s[0];		       
		   	   //$("#school").jqGrid('editRow',cindex);
               //这一行是用来显示一个日期选择器在编辑的时候
		   	   $('#school').jqGrid('editRow',cindex,true,pickdates); 
		   	   this.disabled = 'true';
		       $("#sved1,#cned1").attr("disabled",false);
		   
           }else{
               alert('没有选择行!');

           }

      }); 
	  $("#sved1").click( function() {
		        $("#school").jqGrid('saveRow',cindex);
		        $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });
      $("#cned1").click( function() { 
                $("#school").jqGrid('restoreRow',cindex);
                $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });  
      
      $("#school").jqGrid('filterToolbar'); 

});//end of document ready function 
function gridLoadComplete(){
	var ret;	
	ret = $("#school").jqGrid('getRowData',"1");
    //alert(ret.name); 
	
}
function gridCompleteCallback(){
	var ids = $("#school").jqGrid('getDataIDs'); 
	for(var i=0;i < ids.length;i++){ 
		var cl = ids[i]; 
		be = "<input style='height:22px;width:20px;' type='button' value='E' onclick=\"$('#school').editRow('"+cl+"');\" />"; 
		se = "<input style='height:22px;width:20px;' type='button' value='S' onclick=\"$('#school').saveRow('"+cl+"');\" />"; 
		ce = "<input style='height:22px;width:20px;' type='button' value='C' onclick=\"$('#school').restoreRow('"+cl+"');\" />"; 
		$("#school").jqGrid('setRowData',ids[i],{act:be+se+ce});
	} 
}
function afterInsertRowCallback(rowid,aData){ 
    var r  =aData.id%2;
    if(r==0){
    	$("#school").jqGrid('setCell',rowid,'name','',{color:'green'});
    }else{
    	$("#school").jqGrid('setCell',rowid,'name','',{color:'red'});
    }
	
} 
function pickdates(id){ 
	$("#"+id+"_name","#school").datepicker({dateFormat:"yy-mm-dd"}); 
}
function loadErrorCallback(){
	$("#rsperror").html("Type: "+st+"; Response: "+ xhr.status + " "+xhr.statusText); 
	 
}
</script>
</head>
<body>
<b>Response:</b><span id="rsperror" style="color:red"></span> 
<hr/>
<table id="school"></table>
<div id="schoolpager"></div>
<br />
<button id="m1">获取所选行</button>
<button id="ed1">编辑所选</button>
<button id="sved1" disabled='true'>保存</button>
<button id="cned1" disabled='true'>退出</button>

</body>
</html>
