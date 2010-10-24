<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<script type="text/javascript">
  //TODO 明天把店家crud搞定
  jQuery(document).ready(function($){
	  jQuery("#school").jqGrid({
        url:"../model/shopper.php",
	  	datatype: "json",
	  	postData:{"action":"list"},
        mtype:"POST",
	  	height: 250,
	     	colNames:['编号','名称','店主','电话','菜系','类型','环境','会员','修改','删除'],
	     	colModel:[
	     		{name:'id',index:'id', width:50},
	     		{name:'name',index:'name', width:100},
	     		{name:'master',index:'master', width:50},
	     		{name:'phone',index:'phone', width:100},
	     		{name:'cookstyles',index:'cookstyles', width:150,formatter:cookstyleFormatter},
	     		{name:'type',index:'type', width:100},
	     		{name:'environment',index:'environment', width:200},
                {name:'memberSupported',index:'memberSupported', width:50,formatter:memberFormatter},
	     		{name:'id',index:'id', width:50,formatter:mofidyFormatter},
	     		{name:'id',index:'id', width:50,formatter:deleteFormatter},               
	     		
	     	],         
	     	multiselect: true,
	     	caption: "店家列表",
	     	rowNum:10,
	       	rowList:[10,20,30],
	       	pager: '#pager2',
	       	sortname: 'id',
	        viewrecords: true,
	        sortorder: "desc",
	        onHeaderClick: function (stat) {
	        	if(stat == 'visible' ){
	        		jQuery("#filter").css("display","none");
	        	}
	        },	
	        jsonReader : {
	           repeatitems: false,
	           id: "0"
	        },
	        grouping: true, 
            groupingView : { 
                groupField : ['type'], 
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

	  jQuery("#school").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false,search:false,refresh:false});
	  jQuery("#school").jqGrid('navButtonAdd',"#pager2",{caption:"搜索",title:"切换搜索",
	  	onClickButton:function(){ 
	  		if(jQuery("#filter").css("display")=="none") {
	  			jQuery(".HeaderButton","#gbox_school").trigger("click");
	  			jQuery("#filter").show();
	  		}
	  	} 
	  });
	  jQuery("#school").jqGrid('navButtonAdd',"#pager2",{caption:"清除",title:"清除搜索",buttonicon:'ui-icon-refresh',
	  	onClickButton:function(){
	  		var stat = jQuery("#school").getGridParam('search');
	  		if(stat) {
	  			var cs = jQuery("#filter")[0];
	  			cs.clearSearch();
	  		}
	  	} 
	  });

	  var sfilters =  jQuery("#filter").jqGrid("filterGrid","#school",
              {
                  //gridModel:true,
                  //gridNames:true,
                  formtype:"vertical",
                  enableSearch:true,
                  enableClear:false,
                  autosearch: false,
                  url:"../model/shopper.php",
                  searchButton:"搜索店家",
                  filterModel:[
                     {"label":"店家名称","name":"name","stype":"text","defval":""},
                     {"label":"商家推荐","name":"searchField","stype":"select","sopt":
                         {"value":"newrecommend:最新动态;newshoppers:本月推荐;weekshoppers:本周推荐"}}


                  ],
                  afterSearch : function() {
                      jQuery(".HeaderButton","#gbox_school").trigger("click");
                      jQuery("#filter").css("display","none");
                  }
              }
      );
     
      jQuery("#sButton").button();
	  
      if(isFF()){
    	  jQuery("#sButton").click(function(){
               var sf  = sfilters[0];
               sf.triggerSearch();


          });      
      }
      
      function memberFormatter(cellvalue ,options,rowObject){

          var jck = jQuery("<input type='checkbox' disabled='true' />");
          jck.attr('checked',cellvalue!=0);
          return jQuery('<p></p>').append(jck).html();
      }
      
	  function mofidyFormatter(cellvalue, options, rowObject){
          var url ='../view/shopper.php?action=update&id='+cellvalue;
          var link =  jQuery('<a onclick="doUpdateMain(\''+url+'\',\'修改店家\');"></a>');
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

	  function cookstyleFormatter(cellvalue,options,rowObject){
         var sel = jQuery('<select></select>');
          for(var i=0;i<cellvalue.length;i++){
             var opt = jQuery('<option></option>');
             opt.val(cellvalue[i].id);
             opt.text(cellvalue[i].name);
             sel.append(opt);
         }
         return jQuery('<p></p>').append(sel).html();
      }


      function configShoppers(ctype){
          //alert(ctype);
          var s = getSelectedRows();
          if(!s || s.length==0){
              alert("请先选择店家!");
              return ;
 
          }
          var postData = {
              "action":"config",
              "ctype":ctype,
              "shoppers":s
          };
          var reqOpt = {
        		  "url":"../model/shopper.php",
                  "onSuccess":function(jsonData){
                      alert(jsonData.message);
                      $(this).button("enable");
                   },
                   "onFailure":function(xhr){
                      alert(xhr.status);
                      $(this).button("enable");
                   }
          };
          var req = new Request.JSON(reqOpt);
          $(this).button("disable");
          req.post(postData);
      }

      function filterShoppers(ctype){
          var postData = {
      	  "_search":"true",
    	  "action":"list",
    	  "fieldName":ctype,
          "fieldValue":true,
    	  "page":1,
    	  "rows":10,
    	  "sidx":"id",
    	  "sord":"asc"
          }
          //TODO 搜索服务器
         
          if(jQuery("#filter").css("display")=="none") {
	  			jQuery(".HeaderButton","#gbox_school").trigger("click");
	  			jQuery("#filter").show();
	  	  } 
      }
      
   	  $(".viewShoppers a").click(function(){
   		 if(this.id){
             if(this.id.indexOf("view_")!=-1){

                 filterShoppers(this.id);

             } else if(this.id.indexOf("set_")!=-1){
                 var stype =this.id.substring(4);
                 setCatalogShopper(stype);   

             } else{
                  configShoppers(this.id);
             }
             

         }
         return false;
  
      });
      var tb = $("#school");
      function setCatalogShopper(stype){

          var rows = getSelectedRows();

         if(!rows || rows.length==0){

              alert("请先选择商家!");
              return false;

             
             
         }
         block(tb,"正在处理，请稍后...");
         var postData = {
             "id":rows,
             "fieldName":stype,
             "action":"homeCatalog"
             };
         var req = new Request.JSON({
             "url":"../model/shopper.php",
             "onSuccess":function(msg){
                   notify(msg.message);
                   unblock(tb);

             },
             "onFailure":function(xhr){

                   notify(xhr.responseText);
                   unblock(tb);
                 
             }
             


         });
         req.post(postData);
         
         
         
             
      }
      
	  function getSelectedRows(){
           return jQuery("#school").jqGrid('getGridParam','selarrrow');
      }

     
	  var postData = {
              "action":"list",
              "actionparam":"all"
             };
      var reqOpt = {
        		  "url":"../model/shoppercatalog.php",
                  "onSuccess":function(jsonData){
    	  for(var i=0;i<jsonData.rows.length;i++){
              var opt = new Option();
              opt.value = jsonData.rows[i].id;
              opt.text = jsonData.rows[i].name;
              $("#shopperGroups").append(opt);
         }
         $("#shopperGroups").change(function(){
        	var vl = $(this).val();
        	if(vl) { 
                if(vl == "clear") { 
                    jQuery("#school").jqGrid('groupingRemove',true); 

                } else {
                    jQuery("#school").jqGrid('groupingGroupBy',vl); 

                } 
            } 

         });
                       
                   },
                   "onFailure":function(xhr){
                      alert(xhr.status);
                   }
          };
       req = new Request.JSON(reqOpt);
       req.post(postData);

      
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
      myRequest.post("../model/shopper.php");       
    
  }
</script>
</head>

<body>

            
      <div id="menu">
        <ul class="menu">
            <li><a href="#" class="parent"><span>查看商家</span></a>
                <div>
                  <ul class="viewShoppers">
                    <li><a id="view_newrecommend" href="#"><span>最新动态</span></a></li>
                    <li><a id="view_newshoppers"  href="#"><span>本月推荐</span></a></li>
                    <li><a id="view_weekshoppers" href="#"><span>本周推荐</span></a></li>
                  </ul>
                </div>
            </li>  
            <li><a href="#" class="parent"><span>设置商家</span></a>
                <div>
                  <ul class="viewShoppers">
                    <li><a id="newrecommend" href="#"><span>设为最新动态</span></a></li>
                    <li><a id="newshoppers"  href="#"><span>设为本月推荐</span></a></li>
                    <li><a id="weekshoppers" href="#"><span>设为本周推荐</span></a></li>
                  </ul>
                </div>
            </li>         
            <li><a href="#" class="parent"><span>设置首页出现商家</span></a>
                <div>
                  <ul class="viewShoppers">
                    <li><a id="set_twoofcatalog" href="#"><span>设为本类重点推荐</span></a></li>
                    <li><a id="set_listofcatalog"  href="#"><span>设为本类主页列表推荐</span></a></li>
                    <li><a onclick="return false;"><select id="shopperGroups"></select></a></li>
                  </ul>
                </div>
            </li>         
        </ul>
</div>

<table id="school"></table>
<div id="pager2"></div>
<div id="filter" style="margin-left:30%;display:none">搜索店家</div>
</body>
</html>
