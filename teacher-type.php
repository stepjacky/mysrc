<html>
<head>
<script type="text/javascript">
var cindex=-1;
$(function(){ 	
	var mygrid=$("#teachertype").jqGrid({
	    url:'teacher-type-controller.php',
	    datatype: 'json',
	    mtype: 'GET',
	    colNames:['编号','名称','备注'],
	    colModel :[ 
	      {name:'id', index:'id', width:55}, 
	      {name:'name', index:'name', width:100,editable:true},
	      {name:'remark',index:'remark',width:200,editable:true}
	    ],
	    pager: '#teachertypepager',
	    rowNum:10,
	    rowList:[10,20,30],
	    rownumbers: true, 
	    gridview : true, 
	    sortname: 'id',
	    sortorder: 'asc',
	    viewrecords: true,
	    caption: '职称管理',
	    width:500,
	    height:200,
	    editurl:"teacher-type-controller.php",
	    multiselect: true,
	    toolbar : [true,"top"], 
	    loadComplete: gridLoadComplete,
	    gridComplete: gridCompleteCallback,
	    afterInsertRow:afterInsertRowCallback,
	    loadError:function(xhr,st,err){loadErrorCallback(xhr,st,err);}
	  }).navGrid("#teachertypepager",{edit:true,add:true,del:true});
	  
	  $("#m1").click( function() { 
		  var s; 
		  s = $("#teachertype").jqGrid('getGridParam','selarrrow');
		  alert(s); 
	  }); 
	  $("#ed1").click( function() {
		   var s = $("#teachertype").jqGrid('getGridParam','selarrrow');
           if(s.length!=0){
		       cindex = s[0];		       
		   	   //$("#bookversion").jqGrid('editRow',cindex);
               //这一行是用来显示一个日期选择器在编辑的时候
		   	   $('#teachertype').jqGrid('editRow',cindex,true,pickdates); 
		   	   this.disabled = 'true';
		       $("#sved1,#cned1").attr("disabled",false);
		   
           }else{
               alert('没有选择行!');

           }

      }); 
	  $("#sved1").click( function() {
		        $("#teachertype").jqGrid('saveRow',cindex);
		        $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });
      $("#cned1").click( function() { 
                $("#teachertype").jqGrid('restoreRow',cindex);
                $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });  
      
      $("#teachertype").jqGrid('filterToolbar'); 

});//end of document ready function 
function gridLoadComplete(){
	var ret;	
	ret = $("#teachertype").jqGrid('getRowData',"1");
    //alert(ret.name); 
	
}
function gridCompleteCallback(){
	
}
function afterInsertRowCallback(rowid,aData){ 
    var r  =aData.id%2;
    if(r==0){
    	$("#teachertype").jqGrid('setCell',rowid,'name','',{color:'green'});
    }else{
    	$("#teachertype").jqGrid('setCell',rowid,'name','',{color:'red'});
    }
	
} 
function pickdates(id){ 
	$("#"+id+"_name","#teachertype").datepicker({dateFormat:"yy-mm-dd"}); 
}
function loadErrorCallback(){
	$("#rsperror").html("Type: "+st+"; Response: "+ xhr.status + " "+xhr.statusText); 
	 
}
</script>
</head>
<body>
<b>Response:</b><span id="rsperror" style="color:red"></span> 
<hr/>
<table id="teachertype"></table>
<div id="teachertypepager"></div>
<br />
</body>
</html>
