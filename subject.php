<html>
<head>
<script type="text/javascript">
var cindex=-1;
var mygrid={};
$(function(){ 	
	mygrid=$("#subjectmanage").jqGrid({
	    url:'subject-controller.php',
	    datatype: 'json',
	    mtype: 'GET',
	    colNames:['编号','名称','备注','图片',],
	    colModel :[ 
	      {name:'id', index:'id', width:55}, 
	      {name:'name', index:'name', width:100,editable:true},
	      {name:'remark',index:'remark',width:200,editable:true},
	      {name:'image',index:'image',width:200,editable:true}
	    ],
	    pager: '#subjectpager',
	    rowNum:10,
	    rowList:[10,20,30],
	    rownumbers: true, 
	    gridview : true, 
	    sortname: 'id',
	    sortorder: 'asc',
	    viewrecords: true,
	    caption: '学科管理',
	    width:600,
	    height:200,
	    editurl:"subject-controller.php",
	    multiselect: true,
	    toolbar : [true,"top"], 
	    loadComplete: gridLoadComplete,
	    gridComplete: gridCompleteCallback,
	    afterInsertRow:afterInsertRowCallback,
	    loadError:function(xhr,st,err){loadErrorCallback(xhr,st,err);}
	  }).navGrid("#subjectpager",{edit:true,add:true,del:true});

	  $("#t_subjectmanage").append("<input type='button' value='添加到年级' style='height:20px;font-size:-3'/>"); 
	  $("#t_subjectmanage").css("height","25");
		  $("input","#t_subjectmanage").click(function(){ 
		  var s = mygrid.jqGrid('getGridParam','selarrrow');
		  if(!catenode){
			  message('请选择一个年级');
              return;
		  }
		  if(s){
		  var myparam = {"sid[]":s,"act":"add","gid":catenode.id};		  
		  $.ajax({
                type:"GET",
                url :"subject-editor.php",
                data :$.param(myparam),
                dataType:"text",
                success:function(data){
                   
                      message(data);
                   
                },
                error:function(data){
                      alert(data);
                }

			  });
		  }else{
               message("请先选择学科!");
			  }

	  }); 
	  
	  $("#m1").click( function() { 
		  var s; 
		  s = $("#subjectmanage").jqGrid('getGridParam','selarrrow');
		  alert(s); 
	  }); 
	  $("#ed1").click( function() {
		   var s = $("#subjectmanage").jqGrid('getGridParam','selarrrow');
           if(s.length!=0){
		       cindex = s[0];		       
		   	   //$("#subjectmanage").jqGrid('editRow',cindex);
               //这一行是用来显示一个日期选择器在编辑的时候
		   	   $('#subjectmanage').jqGrid('editRow',cindex,true,pickdates); 
		   	   this.disabled = 'true';
		       $("#sved1,#cned1").attr("disabled",false);
		   
           }else{
               alert('没有选择行!');

           }

      }); 
	  $("#sved1").click( function() {
		        $("#subjectmanage").jqGrid('saveRow',cindex);
		        $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });
      $("#cned1").click( function() { 
                $("#subjectmanage").jqGrid('restoreRow',cindex);
                $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });  
      
      $("#subjectmanage").jqGrid('filterToolbar'); 

});//end of document ready function 
function gridLoadComplete(){
	var ret;	
	ret = $("#subjectmanage").jqGrid('getRowData',"1");
    //alert(ret.name); 
	
}
function gridCompleteCallback(){
	var ids = $("#subjectmanage").jqGrid('getDataIDs'); 
	for(var i=0;i < ids.length;i++){ 
		var cl = ids[i]; 
		be = "<input style='height:22px;width:20px;' type='button' value='E' onclick=\"$('#subjectmanage').editRow('"+cl+"');\" />"; 
		se = "<input style='height:22px;width:20px;' type='button' value='S' onclick=\"$('#subjectmanage').saveRow('"+cl+"');\" />"; 
		ce = "<input style='height:22px;width:20px;' type='button' value='C' onclick=\"$('#subjectmanage').restoreRow('"+cl+"');\" />"; 
		$("#subjectmanage").jqGrid('setRowData',ids[i],{act:be+se+ce});
	} 
}
function afterInsertRowCallback(rowid,aData){ 
    var r  =aData.id%2;
    if(r==0){
    	$("#subjectmanage").jqGrid('setCell',rowid,'name','',{color:'green'});
    }else{
    	$("#subjectmanage").jqGrid('setCell',rowid,'name','',{color:'red'});
    }
	
} 
function pickdates(id){ 
	$("#"+id+"_name","#subjectmanage").datepicker({dateFormat:"yy-mm-dd"}); 
}
function loadErrorCallback(xhr,st,err){
	$("#rsperror").html("Type: "+st+"; Response: "+ xhr.status + "; "+xhr.statusText+" err: "+err); 
	 
}
</script>
</head>
<body>
<b>Response:</b>
<span id="rsperror" style="color: red"></span>
<hr />
<table id="subjectmanage"></table>
<div id="subjectpager"></div>
<br />
<button id="m1">获取所选行</button>
<button id="ed1">编辑所选</button>
<button id="sved1" disabled='true'>保存</button>
<button id="cned1" disabled='true'>退出</button>

</body>
</html>
