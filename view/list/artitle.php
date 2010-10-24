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

  jQuery(document).ready(function($){
	  jQuery("#school").jqGrid({
        url:"../model/<?php echo $entryName.".php";?>",
	  	datatype: "json",
	  	postData:{"action":"list"},
        mtype:"POST",
	  	height: 250,
	     	colNames:['编号','标题','发布日期','类型','修改','删除'],
	     	colModel:[
	     		{name:'id',index:'id', width:50},
	     		{name:'title',index:'id', width:200},
                {name:'publishdate',index:'publishdate', width:200},
                {name:'cname',index:'cname', width:200},
	     		{name:'id',index:'id', width:50,formatter:mofidyFormatter},
	     		{name:'id',index:'id', width:50,formatter:deleteFormatter},
                
	     		
	     	],
         
	     	multiselect: true,
	     	caption: "公告列表",
	     	rowNum:10,
	       	rowList:[10,20,30],
	       	pager: '#pager2',
	       	sortname: 'id',
	        viewrecords: true,
	        sortorder: "desc",
	        jsonReader : {
	           repeatitems: false,
	           id: "0"
	        },
	        grouping: true, 
            groupingView : { 
                groupField : ['cname'], 
                groupColumnShow : [true], 
                groupText : ['<b>{0}</b>'], 
                groupCollapse : false, 
                groupOrder: ['desc'], 
                //groupSummary : [true], 
                groupDataSorted : true 
            }, 
            //footerrow: true, 
            userDataOnFooter: true
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

	 $("#cook_newest").click(function(){
          var s = getSelectedRows();
          if(s && s.length>=1){
        	  var pd = {};
              pd.action="updateFoodfash";
              pd.pos = 'z';
              pd.artitleId = s[0];
              var req = new Request.JSON({
     	         "url":"../model/config/foodfash.php",
     	         "onSuccess":function(jsonData){
           	           notify(jsonData.message); 	        
     	         },
     	         "onFailure":function(xhr){
     	              alert(xhr.responseText);

     	         }
     	        });
     	       req.post(pd);
                

          }else{

              notify("请选择一片文章作为主题");
          }

     });

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
      myRequest.post("../model/<?php echo $entryName.".php";?>");       
    
  }
</script>
</head>

<body>
<div id="menu">
        <ul class="menu">
            <li><a href="#" class="parent"><span>美食厨房设置</span></a>
                <div>
                  <ul class="viewShoppers">
                    <li><a id="cook_newest" href="#"><span>设为精彩时尚主题</span></a></li>                    
                  </ul>
                </div>
            </li>                    
        </ul>
</div>
<table id="school"></table>
<div id="pager2"></div>
</body>
</html>
