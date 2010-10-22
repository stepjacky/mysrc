<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php 
require_once '../../tools/utils.php';
$fileName = basename(__FILE__);
$entryName = getEntryName($fileName);
?>
<script type="text/javascript">

  jQuery(document).ready(function($){
	  jQuery("#school").jqGrid({
        url:"../dataaccess/<?php echo $entryName.".php";?>",
	  	datatype: "json",
	  	postData:{"action":"list"},
        mtype:"POST",
	  	height: 250,
	     	colNames:['编号','标题','发布日期','修改','删除'],
	     	colModel:[
	     		{name:'id',index:'id', width:50},
	     		{name:'title',index:'id', width:200},
                {name:'publishdate',index:'publishdate', width:200},
	     		{name:'id',index:'id', width:50,formatter:mofidyFormatter},
	     		{name:'id',index:'id', width:50,formatter:deleteFormatter},
                
	     		
	     	],
         
	     	multiselect: true,
	     	caption: "公司新闻列表",
	     	rowNum:10,
	       	rowList:[10,20,30],
	       	pager: '#pager2',
	       	sortname: 'id',
	        viewrecords: true,
	        sortorder: "desc",
	        jsonReader : {
	           repeatitems: false,
	           id: "0"
	        }

		/*
        ,
	        grouping: true, 
            groupingView : { 
                groupField : ['publishdate'], 
                groupColumnShow : [true], 
                groupText : ['<b>{0}</b>'], 
                groupCollapse : false, 
                groupOrder: ['desc'], 
                //groupSummary : [true], 
                groupDataSorted : true 
            }, 
            //footerrow: true, 
            userDataOnFooter: true
			*/
   });// end of jQGrid initilize 
	  function mofidyFormatter(cellvalue, options, rowObject){
          var url ='../view/<?php echo $entryName.'.php';?>?action=update&id='+cellvalue;
          var link =  jQuery('<a onclick="doUpdateMain(\''+url+'\',\'修改公告\');"></a>');
          link.attr('href','javascript:;');
          link.text('修改');
          return jQuery('<p></p>').append(link).html();
            
      }
	  function deleteFormatter(cellvalue, options, rowObject){
		         
		  var link =  jQuery('<a onclick="doDeleteRecord('+cellvalue+');"></a>');
          link.text('删除');
          link.attr('href','javascript:;');
          return jQuery('<p></p>').append(link).html();
	  }

	 function getSelectedRows(){
          return jQuery("#school").jqGrid('getGridParam','selrow');
     }
	  
	  
  });//end of document ready function 

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
                   //alert(json);          
    	           MochaUI.notification(json.message);
    	           jQuery("#school").setGridParam({"page":page,"rows":10}).trigger("reloadGrid");
              },
              "onFailure":function(xhr){
                   alert("发送错误:"+xhr.responseText);
              }
              
              
      }; 
      var myRequest = new Request.JSON(options);
      myRequest.post("../dataaccess/<?php echo $entryName.".php";?>");       
    
  }
</script>
</head>

<body>
<table id="school"></table>
<div id="pager2"></div>
</body>
</html>
