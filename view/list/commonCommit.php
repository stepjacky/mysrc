<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

<?php 
require_once '../../tools/utils.php';
use utils\HtmlUtils;
$util = new HtmlUtils();
$entry = array();
$fileName = basename(__FILE__);
$entryName = $util->getEntryName($fileName);
?>
<script type="text/javascript">
  var entryName = "<?php echo $entryName;?>";
  jQuery(document).ready(function($){
	  var contentWindow = function(id){ 
			new MUI.Window({
				id: 'contentWindow',
				title: '评论内容',
				contentURL: '../'+entryName+'.php?id='+id,
				width: 340,
				height: 150
			});
	 };


      
	  jQuery("#school").jqGrid({
        url:"../model/"+entryName+".php",
	  	datatype: "json",
	  	postData:{"action":"list"},
        mtype:"POST",
	  	height: 250,
	     	colNames:['编号','发布日期','IP地址','内容','文章编号','店铺编号','公告编号','删除'],
	     	colModel:[
	     		{name:'id',index:'id', width:100},
	     		{name:'publishdate',index:'publishdate', width:100},
	     		{name:'ip',index:'ip', width:100},
	     		{name:'content',index:'content', width:120,height:100,formatter:contentFormatter},
	     		{name:'artitle_id',index:'artitle_id', width:100,formatter:artitleFormatter},
	     		{name:'shopper_id',index:'shopper_id', width:100,formatter:shopperFormatter},
	     		{name:'indexmessage_id',index:'indexmessage_id', width:100,formatter:indexmsgFormatter},
	     		{name:'id',index:'id', width:50,formatter:deleteFormatter},               
	     		
	     	],         
	     	multiselect: true,
	     	caption: "评论列表",
	     	rowNum:10,
	       	rowList:[10,20,30],
	       	pager: '#pager2',
	       	sortname: 'publishdate',
	        viewrecords: true,
	        sortorder: "desc",
	        jsonReader : {
	           repeatitems: false,
	           id: "0"
	        }
	  });// end of jQGrid initilize 

      function contentFormatter(cellvalue,options,rowObject){
          var ta = $("<textarea></textarea>");
          ta.text(cellvalue);
          var p =$("<p></p").append(ta); 
          return p.html();
    	 //contentWindow(cellvalue);

      }

      function shopperFormatter(cellvalue,options,rowObject){
    	  return cellvalue;
      }
	  
      function artitleFormatter(cellvalue,options,rowObject){
    	  return cellvalue;
      }

      function indexmsgFormatter(cellvalue,options,rowObject){
    	  return cellvalue;
      }
	  
	  function deleteFormatter(cellvalue, options, rowObject){		         
		  var link =  jQuery('<a onclick="doDeleteRecord('+cellvalue+');"></a>');
          link.text('删除');
          link.attr('href','javascript:;');
          return jQuery('<p></p>').append(link).html();
	  }
	 
	  function doUpdateMain(url,title){
	      MUI.updateContent({
	          element: $('mainPanel'),
	          url: url,
	          title: title,
	          padding: { top: 8, right: 8, bottom: 8, left: 8 }
	      }); 

	  }
	  function doDeleteRecord(id){
		  var page = jQuery("#school").getGridParam("page");
	      var options =  {
	              "data":"action=delete&id="+id,
	              "onSuccess": function(json, responseXML){
	    	           MochaUI.notification(json.message);
	    	           jQuery("#school").setGridParam({"page":page,"rows":10}).trigger("reloadGrid");
	              },
	              "onFailure":function(xhr){
	                   alert("发送错误:"+xhr.responseText);
	              }
	              
	              
	      }; 
	      var myRequest = new Request.JSON(options);
	      myRequest.post("../model/"+entryName+".php");       
	    
	  }
	  
	  
  });//end of document ready function 

  
</script>
</head>

<body>
<table id="school"></table>
<div id="pager2"></div>
</body>
</html>
