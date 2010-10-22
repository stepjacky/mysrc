<html>
<head>
<script type="text/javascript">
var cindex=-1;
var mygrid = {};
var idlist  = 'mlist';
var idpager = 'mpager';
var jqlistid = "#"+idlist;
var jqpagerid = "#"+idpager;
$(function(){ 	
	
    var contar   = $("#dteaconer");
    var dtable   = $("<table id='"+idlist+"'></table>");
    var navpager = $("<div id='"+idpager+"'></div>");
    contar.empty();
    contar.append(dtable);
    contar.append(navpager);	
	mygrid=$(jqlistid).jqGrid({
	    url:'member-controller.php?utype=u',
	    datatype: 'json',
	    mtype: 'GET',
	    colNames:['编号','昵称','邮件','经验','勋章','电话','QQ','MSN','注册日期','类型','锁定状态'],
	    colModel :[
	      {name:'id',index:'id',width:40,editable:false},	     	
	      {name:'localname', index:'localname', width:80,editable: true},
	      {name:'email',index:'email',width:100,editable: true}, 
	      {name:'experience',index:'experience',width:80,editable:false,sorttype:"date"},
		  {name:'medal',index:'medal',width:100,editable: true}, 
	      {name:'phone',index:'phone',width:60},
	      {name:'qq',index:'qq',width:60},  
	      {name:'msn',index:'msn',width:100}, 
	      {name:'regtime',index:'regtime',width:80,editable:false,sorttype:"date"},
	      {name:'usertype',index:'usertype',width:100},
	      {name:'locked',index:'locked',width:100,editable:true,edittype:"select",editoptions:{value:"y:锁定;n:未锁定"}}
		],
	
	    pager: jqpagerid,
	    rowNum:10,
	    rowList:[10,20,30],
	    rownumbers: true, 
	    gridview : true, 
	    sortname: 'id',
	    sortorder: 'asc',
	    viewrecords: true,
	    caption: '学生管理',
	    width:680,
	    height:300,
	    editurl:"member-controller.php?utype=u",
	    multiselect: true,
	    toolbar : [true,"top"], 
	    loadComplete: gridLoadComplete,
	    gridComplete: gridCompleteCallback,
	    afterInsertRow:afterInsertRowCallback,
	    loadError:function(xhr,st,err){loadErrorCallback(xhr,st,err);}
	  }).navGrid(jqpagerid,{view:true,edit:false,add:false,del:true});
	  
	  $("#m1").click( function() { 
		  dolocked(true);
		  
	  }); 
	  $("#ed1").click( function() {
		  dolocked(false);

      }); 

	  $("#userstat").click(function(){
		  var s = mygrid.jqGrid('getGridParam','selarrrow');
		  //alert(s);
          if(s && s.length!=0 && s!='undefined'){
        	  var user = mygrid.jqGrid('getRowData',s[0]);
        	  $('#membertabs').tabs('url' , 4 , 'dostat.php?email='+user.email);
              $('#membertabs').tabs('select',4);      
          }else{
              message("先选择用户!");
          }
      });
	     
	  $("#deluser").click( function() {
		  var s = mygrid.jqGrid('getGridParam','selarrrow');
		  if(s && s.length!=0 && s!='undefined'){
			  var users = [];
              for(i=0;i<s.length;i++){
		          var user = mygrid.jqGrid('getRowData',s[i]);
		          users[i] = user.id;
              }
              var me = getEventTarget();
              $(me).attr("disabled",true);
              $(me).html("正在操作,请稍等...");
              var param={oper:"del","users[]":users};
              $.ajax({
                  type:'POST',
                  url:'member-controller.php',
                  data:$.param(param),
                  success:function(){
                     alert("操作成功");
                     $(me).attr("disabled",false);
                     $(me).html("删除用户");
                  },
                  error:function(data){
                     alert("操作错误:"+data);
                     $(me).attr("disabled",false);
                     $(me).html("删除用户");
                  }

                });

		      }else{
	    	  alert("请选择用户!");
		      }
		  
      });
      $("#cned1").click( function() { 
                mygrid.jqGrid('restoreRow',cindex);
                $("#sved1,#cned1").attr("disabled",true);
                $("#ed1").attr("disabled",false); 
      });  
      
      mygrid.jqGrid('filterToolbar'); 

      function dolocked(flag){
    	  var s = mygrid.jqGrid('getGridParam','selarrrow');
          if(s && s.length!=0 && s!='undefined'){
              var users = [];
              for(i=0;i<s.length;i++){
		          var user = mygrid.jqGrid('getRowData',s[i]);
		          users[i] = user.id;
              }
              var me = getEventTarget();
              $(me).attr("disabled",true);
              $(me).html("正在操作,请稍等...");
              var param={oper:flag?"locked":"unlocked","users[]":users};
              $.ajax({
                    type:'POST',
                    url:'member-controller.php',
                    data:$.param(param),
                    success:function(){
                       alert("操作成功");
                       $(me).attr("disabled",false);
                       $(me).html(flag?"锁定用户":"解锁用户");
                    },
                    error:function(data){
                       alert("操作错误:"+data);
                       $(me).attr("disabled",false);
                       $(me).html(flag?"锁定用户":"解锁用户");
                    }

                  });
          }else{
               alert("请选择用户!");
           
          } 
      }

});//end of document ready function 
function gridLoadComplete(){
	var ret;	
	ret = mygrid.jqGrid('getRowData',"1");
    //alert(ret.name); 
	
}
function gridCompleteCallback(){}
function afterInsertRowCallback(rowid,aData){ 
    var r  =aData.id%2;
    if(r==0){
    	mygrid.jqGrid('setCell',rowid,'name','',{color:'green'});
    }else{
    	mygrid.jqGrid('setCell',rowid,'name','',{color:'red'});
    }
	
} 
function pickdates(id){ 
	$("#"+id+"_regtime",jqlistid).datepicker({dateFormat:"yy-mm-dd"});	
}
function loadErrorCallback(xhr,st,err){
	$("#rsperror").html("Type: "+st+"; Response: "+ xhr.status + " "+xhr.statusText); 
	 
}
</script>
</head>
<body>
<b>Response:</b><span id="rsperror" style="color:red"></span> 
<hr/>
<div id="dteaconer" ></div>
<br />
<button id='m1'>锁定用户</button>
<button id='ed1'>解锁用户</button>
<button id='deluser'>删除用户</button>
<button id='userstat'>做题统计</button>

</body>
</html>



