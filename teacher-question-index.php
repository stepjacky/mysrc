<html>
<head>
<?php 
session_start();
$email='';
$guestView = false;
if(isset($_GET['userId'])){
	$email = urlencode($_GET['userId']);
	$guestView  = true;
}else{
    $email = urlencode($_SESSION['loginuser']);
}
?>
<script type="text/javascript">
var cindex=-1;
var owner = 
$(function(){ 	
	var mygrid=$("#list").jqGrid({
	    url:"question-controller.php?myqst=<?php echo $email;?>",
	    datatype: 'json',
	    mtype: 'GET',
	    colNames:['编号','类型', '章节','出题者','关键字','年级','学科','教材版本','锁定','题目内容'],
	    //,'内容'
	    colModel :[ 
	      {name:'id', index:'id', width:25},	
	      {name:'tname', index:'qst_type_id', width:100},        
	      {name:'cname',index:'qst_chapter_id',width:100},
	      {name:'owner',index:'owner',width:100},
	      {name:'tag',index:'tag',width:150}, 
	      {name:'gname',index:'qst_grade_id',width:150},
	      {name:'sname',index:'qst_subject_id',width:150},  
	      {name:'bname',index:'qst_bvser_id',width:150}, 
	      {name:'locked',index:'locked',width:150}, 
	      {name:'description', index:'description',edittype:'textarea'}
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
	    width:550,
	    height:300,
	    editurl:"question-controller.php",
	    multiselect: true,
	    toolbar : [true,"top"], 
	    loadComplete: gridLoadComplete,
	    gridComplete: gridCompleteCallback,
	    afterInsertRow:afterInsertRowCallback,
	    loadError:function(xhr,st,err){loadErrorCallback(xhr,st,err);}
	  }).navGrid("#pager",{edit:false,add:false,del:false,view:true});
	  $("#addqst").click(function(){
    	  window.location='teacher-question.php';

      });	 
      $("#list").jqGrid('filterToolbar'); 
      $("#edtqst").click(function(){
    	  var s = $("#list").jqGrid('getGridParam','selarrrow');
    	  if(s.length!=0){
		       cindex = s[0];		       
		   	   //$("#list").jqGrid('editRow',cindex);
              //这一行是用来显示一个日期选择器在编辑的时候
              mtabs.tabs('add',"question-edit.php?id="+cindex,"题目编辑");
              mtabs.tabs( "select" , 4); 
              // window.open('teacher-question-editor.php?id='+cindex,'_blank');       
		   
          }else{
              alert('没有选择题目!');

          }

      });

});//end of document ready function 
function gridLoadComplete(){
	var ret;	
	ret = $("#list").jqGrid('getRowData',"1");
    //alert(ret.name); 
	
}
function gridCompleteCallback(){}
function afterInsertRowCallback(rowid,aData){ 
   	
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
<?php if($guestView==false){?>
<button id="addqst" class="sexybutton sexysimple sexyorange" type="reset">添加题目</button>
<button id="edtqst" class="sexybutton sexysimple sexygreen" type="reset">编辑题目</button>
<?php }?>
<span id="rsperror" style="color:red"></span> 
<hr/>
<table id="list"></table>
<div id="pager"></div>
<br />
</body>
</html>
