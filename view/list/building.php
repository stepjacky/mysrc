<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

<script type="text/javascript">

  jQuery(document).ready(function($){
	  jQuery("#school").jqGrid({
        url:"../model/building.php",
	  	datatype: "json",
	  	postData:{"action":"list"},
        mtype:"POST",
	  	height: 250,
	     	colNames:['编号','名称', '描述','修改','删除'],
	     	colModel:[
	     		{name:'id',index:'id', width:60},
                {name:'name',index:'name', width:100},
	     		{name:'intro',index:'intro', width:200},
	     		{name:'id',index:'id', width:50,formatter:mofidyFormatter},
	     		{name:'id',index:'id', width:50,formatter:deleteFormatter},
                
	     		
	     	],
         
	     	multiselect: true,
	     	caption: "建筑列表",
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
	  });// end of jQGrid initilize 
	  function mofidyFormatter(cellvalue, options, rowObject){
          var url ='../view/building.php?action=update&id='+cellvalue;
          var link =  jQuery('<a onclick="doUpdateMain(\''+url+'\',\'修改建筑\');"></a>');
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
    	           MochaUI.notification(json.message);
    	           jQuery("#school").setGridParam({"page":page,"rows":10}).trigger("reloadGrid");
              },
              "onFailure":function(xhr){
                   alert("发送错误:"+xhr.responseText);
              }
              
              
      }; 
      var myRequest = new Request.JSON(options);
      myRequest.post("../model/building.php");       
    
  }
</script>
</head>

<body>
<table id="school"></table>
<div id="pager2"></div>
</body>
</html>
