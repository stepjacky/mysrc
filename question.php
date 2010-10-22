<html>
<head>
<script type="text/javascript">
var cindex=-1;
$(function(){ 	
	var mygrid=$("#list").jqGrid({
	    url:'question-controller.php',
	    datatype: 'json',
	    mtype: 'GET',
	    colNames:['编号','类型', '章节','出题者','关键字','年级','学科','教材版本','锁定','内容'],
	    colModel :[ 
	      {name:'id', index:'id', width:55},	
	      {name:'tname', index:'qst_type_id', width:100},        
	      {name:'cname',index:'qst_chapter_id',width:100},
	      {name:'owner',index:'owner',width:100},
	      {name:'tag',index:'tag',width:150}, 
	      {name:'gname',index:'qst_grade_id',width:150},
	      {name:'sname',index:'qst_subject_id',width:150},  
	      {name:'bname',index:'qst_bvser_id',width:150},  
	      {name:'locked',index:'locked',width:150},  
	      {name:'description', index:'description', width:200,edittype:"textarea", editoptions:{rows:"3",cols:"30"}} 
           
 
	    ],
	
	    pager: '#pager',
	    rowNum:10,
	    rowList:[10,20,30],
	    rownumbers: true, 
	    gridview : true, 
	    sortname: 'id',
	    sortorder: 'asc',
	    viewrecords: true,
	    caption: '题目管理',
	    width:800,
	    height:300,
	    editurl:"question-controller.php",
	    multiselect: true,
	    //toolbar : [true,"top"], 
	    loadComplete: gridLoadComplete,
	    gridComplete: gridCompleteCallback,
	    afterInsertRow:afterInsertRowCallback,
	    loadError:function(xhr,st,err){loadErrorCallback(xhr,st,err);}
	  }).navGrid("#pager",{edit:false,add:false,del:true});
	  
	  $("#ed1").click( function() {
		   var s = $("#list").jqGrid('getGridParam','selarrrow');
           if(s.length!=0){
		       cindex = s[0];		       
		   	   //$("#list").jqGrid('editRow',cindex);
               //这一行是用来显示一个日期选择器在编辑的时候
		   	   $('#qtabs').tabs('url' , 1 , 'question-edit.php?id='+cindex);
               $('#qtabs').tabs('select',1);       
		   
           }else{
               alert('没有选择行!');

           }

      }); 
      $("#addqst").click(function(){
    	  $('#qtabs').tabs('url' , 1 , 'question-edit.php');
          $('#qtabs').tabs('select',1);

      });	
      $("#delqst").click(function(){
          if(!confirm("你确定要删除这些题目吗!!"))return;
    	  var s = $("#list").jqGrid('getGridParam','selarrrow');
    	  if(s && s.length!=0 && s!='undefined'){
    		  var qsts = [];
              for(i=0;i<s.length;i++){
		          var qst = mygrid.jqGrid('getRowData',s[i]);
		          qsts[i] = qst.id;
              }
              var me = getEventTarget();
              $(me).attr("disabled",true);
              $(me).html("正在操作,请稍等...");
              var param={oper:"del","qsts[]":qsts};
              $.ajax({
                  type:'POST',
                  url:'question-controller.php',
                  data:$.param(param),
                  success:function(){
                     alert("操作成功");
                     $(me).attr("disabled",false);
                     $(me).html("删除题目");
                  },
                  error:function(data){
                     alert("操作错误:"+data);
                     $(me).attr("disabled",false);
                     $(me).html("删除题目");
                  }

                });

		      }else{
	    	  alert("请选择题目编号!");
		      }
          }

      ); 
      $("#toglocked").click(function(){
    	  dolocked(true);
      });
      $("#togunlocked").click(function(){
    	  dolocked(false); 
      });
      
      $("#list").jqGrid('filterToolbar'); 

});//end of document ready function 

function dolocked(flag){

	  var s = $("#list").jqGrid('getGridParam','selarrrow');
	  if(s && s.length!=0 && s!='undefined'){
  	  var param={oper:flag?'locked':'unlocked',"qid[]":s};
  	  var me = getEventTarget();
        $(me).attr("disabled",true);
        $(me).html("正在操作,请稍等...");
  	   $.ajax({
             type:'POST',
             url:'question-controller.php',
             data:$.param(param),
             success:function(){
                alert("操作成功");
                $(me).attr("disabled",false);
                $(me).html(flag?"锁定题目":"解锁题目");
             },
             error:function(data){
                alert("操作错误:"+data);
                $(me).attr("disabled",false);
                $(me).html(flag?"锁定题目":"解锁题目");
             }

           });

    }else{
  	  message("请选择题目编号!");
    }
     

	
}
function gridLoadComplete(){
	var ret;	
	ret = $("#list").jqGrid('getRowData',"1");
    //alert(ret.name); 
	
}
function gridCompleteCallback(){}
function afterInsertRowCallback(rowid,aData){ 
    var r  =aData.id%2;
    if(r==0){
    	$("#list").jqGrid('setCell',rowid,'name','',{color:'green'});
    }else{
    	$("#list").jqGrid('setCell',rowid,'name','',{color:'red'});
    }
	
} 
function pickdates(id){ 
	$("#"+id+"_name","#list").datepicker({dateFormat:"yy-mm-dd"}); 
}
function loadErrorCallback(xhr,st,err){
	$("#rsperror").html("Type: "+st+"; Response: "+ xhr.status + " "+xhr.statusText); 
	 
}
</script>
</head>
<body>
<b>Response:</b><span id="rsperror" style="color:red"></span> 
<hr/>
<table id="list"></table>
<div id="pager"></div>
<br />
<button id="ed1">编辑所选</button>
<button id="addqst">添加题目</button>
<button id="delqst">删除题目</button>
<button id="toglocked">锁定题目</button>
<button id="togunlocked">解锁题目</button>
</body>
</html>
