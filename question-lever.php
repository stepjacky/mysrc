<html>
<head>
<script type="text/javascript">
var cindex=-1;
var listid='#questionbanklist';
var pageid='#questionbankpager';
$(function(){ 	
	var mygrid=$(listid).jqGrid({
	    url:'question-lever-controller.php',
	    datatype: 'json',
	    mtype: 'GET',
	    colNames:['编号','名称', '简介'],
	    colModel :[ 
	      {name:'id', index:'id', width:55}, 
	      {name:'name', index:'name', width:100,editable:true}, 
	      {name:'description', index:'description', width:200,editable:true,edittype:"textarea", editoptions:{rows:"3",cols:"30"}} 
	    ],
	    pager: pageid,
	    rowNum:10,
	    rowList:[10,20,30],
	    rownumbers: true, 
	    gridview : true, 
	    sortname: 'id',
	    sortorder: 'asc',
	    viewrecords: true,
	    caption: '题库管理',
	    width:500,
	    height:200,
	    editurl:"question-lever-controller.php",
	    multiselect: true,
	    toolbar : [true,"top"], 
	    loadComplete: gridLoadComplete,
	    gridComplete: gridCompleteCallback,
	    afterInsertRow:afterInsertRowCallback,
	    loadError:loadErrorCallback
	  }).navGrid(pageid,{edit:true,add:true,del:true});
	  
	  $("#m1").click( function() { 
		  var s; 
		  s = mygrid.jqGrid('getGridParam','selarrrow');
		  alert(s); 
	  }); 
	  $("#ed1").click( function() {
		   var s =mygrid.jqGrid('getGridParam','selarrrow');
           if(s.length!=0){
		       cindex = s[0];		       
		   	   //$(listid).jqGrid('editRow',cindex);
               //这一行是用来显示一个日期选择器在编辑的时候
		   	   mygrid.jqGrid('editRow',cindex,true,pickdates); 
		   	   this.disabled = 'true';
		       $("#sved1,#cned1").attr("disabled",false);
		   
           }else{
               alert('没有选择行!');

           }

      }); 
	  $("#sved1").click( function() {
		  mygrid.jqGrid('saveRow',cindex);
		        $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });
      $("#cned1").click( function() { 
    	  mygrid.jqGrid('restoreRow',cindex);
                $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });  
      
      mygrid.jqGrid('filterToolbar'); 

});//end of document ready function 
function gridLoadComplete(){
	var ret;	
	ret = $(listid).jqGrid('getRowData',"1");
    //alert(ret.name); 
	
}
function gridCompleteCallback(){
	
}
function afterInsertRowCallback(rowid,aData){ 
    var r  =aData.id%2;
    if(r==0){
    	mygrid.jqGrid('setCell',rowid,'name','',{color:'green'});
    }else{
    	mygrid.jqGrid('setCell',rowid,'name','',{color:'red'});
    }
	
} 
function pickdates(id){ 
	$("#"+id+"_name",listid).datepicker({dateFormat:"yy-mm-dd"}); 
}
function loadErrorCallback(){
	$("#rsperror").html("Type: "+st+"; Response: "+ xhr.status + " "+xhr.statusText); 
	 
}
</script>
</head>
<body>
<b>Response:</b><span id="rsperror" style="color:red"></span> 
<hr/>
<table id="questionbanklist"></table>
<div id="questionbankpager"></div>
<br />
<button id="m1">获取所选行</button>
<button id="ed1">编辑所选</button>
<button id="sved1" disabled='true'>保存</button>
<button id="cned1" disabled='true'>退出</button>

</body>
</html>
