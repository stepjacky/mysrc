<html>
<head>
<script type="text/javascript">
var cindex=-1;
var mygrid = {};
var idlist  = 'lvlist';
var idpager = 'lvpager';
var jqlistid = "#"+idlist;
var jqpagerid = "#"+idpager;
$(function(){	
	mygrid=$("#memberleverlist").jqGrid({
	    url:'memberlever-controller.php',
	    datatype: 'json',
	    mtype: 'GET',
	    colNames:['编号','名称'],
	    colModel :[ 
		  {name:'id',index:'id',width:30},
	      {name:'name', index:'name', width:160,editable: true}	    
		],
	
	    pager: "#memberleverpager",
	    rowNum:10,
	    rowList:[10,20,30],
	    rownumbers: true, 
	    gridview : true, 
	    sortname: 'id',
	    sortorder: 'asc',
	    viewrecords: true,
	    caption: '用户级别管理',
	    width:420,
	    height:200,
	    editurl:"memberlever-controller.php",
	    multiselect: true,
	    toolbar : [true,"top"], 
	    loadComplete: gridLoadComplete,
	    gridComplete: gridCompleteCallback,
	    afterInsertRow:afterInsertRowCallback,
	    loadError:function(xhr,st,err){loadErrorCallback(xhr,st,err);}
	  }).navGrid("#memberleverpager",{edit:true,add:true,del:true});
	  
	  $("#m1").click( function() { 
		  var s; 
		  /*s = mygrid.jqGrid('getGridParam','selarrrow');*/
		  s = $("#memberleverlist").jqGrid('getGridParam','selarrrow');
		  alert(s); 
	  }); 
	  $("#ed1").click( function() {
		   /*var s = mygrid.jqGrid('getGridParam','selarrrow');*/
		   var s =$("#memberleverlist").jqGrid('getGridParam','selarrrow');
           if(s.length!=0){
		       cindex = s[0];		       
		   	   /*mygrid.jqGrid('editRow',cindex);*/
		   	   $("#memberleverlist").jqGrid('editRow',cindex);
               //这一行是用来显示一个日期选择器在编辑的时候
		   	   this.disabled = 'true';
		       $("#sved1,#cned1").attr("disabled",false);
		       
		   
           }else{
               alert('没有选择行!');

           }

      }); 
     
	  $("#sved1").click( function() {
		        /*mygrid.jqGrid('saveRow',cindex);*/
		        $("#memberleverlist").jqGrid('saveRow',cindex);
		        $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });
      $("#cned1").click( function() { 
                /*mygrid.jqGrid('restoreRow',cindex);*/
                $("#memberleverlist").jqGrid('restoreRow',cindex);
                $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });  
      
      /*mygrid.jqGrid('filterToolbar');*/
      $("#memberleverlist").jqGrid('filterToolbar'); 

});//end of document ready function 
function gridLoadComplete(){
	var ret;	
	/*ret = mygrid.jqGrid('getRowData',"1");*/
	ret = $("#memberleverlist").jqGrid('getRowData',"1");
    //alert(ret.name); 
	
}
function gridCompleteCallback(){}
function afterInsertRowCallback(rowid,aData){ 
    var r  =aData.id%2;
    if(r==0){
    	mygrid.jqGrid('#memberleverlist',rowid,'name','',{color:'green'});
    }else{
    	mygrid.jqGrid('#memberleverlist',rowid,'name','',{color:'red'});
    }
	
} 
function pickdates(id){ 
	//$("#"+id+"_regtime",dlist).datepicker({dateFormat:"yy-mm-dd"}); 
	//$("#"+id+"_birthday",dlist).datepicker({dateFormat:"yy-mm-dd"}); 
}
function loadErrorCallback(xhr,st,err){
	$("#rsperror").html("Type: "+st+"; Response: "+ xhr.status + " "+xhr.statusText); 
	 
}
</script>
</head>
<body>
<b>Response:</b><span id="rsperror" style="color:red"></span> 
<hr/>
<table id="memberleverlist"></table>
<div id ="memberleverpager"></div>
<br />

</body>
</html>