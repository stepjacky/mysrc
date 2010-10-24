<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript">

jQuery(document).ready(function($){
	
	 $("#selectpic").click(function(){
    	  imageShowWindow();
          return false;

      }).button();
      $("#uploadpic").click(function(){
    	  window.open('../view/config/jquery_upload_crop/upload_crop_v1.2.php','avatar');
          return false;

          }).button();
	
	
	
      var imageShowWindow = function(){

        var pos = arguments[0] || false;
          
  	    new MUI.Window({
  	        id: 'imageShowWindow',
  	        title: '查看商家图片',
  	        width: 600,
  	        height: 350,
  	        resizeLimit: {'x': [450, 2500], 'y': [300, 2000]},
            toolbar:true,
            toolbarURL:'../view/config/util/'+(pos?'ad':'image')+'Tools.html',
            toolbarHeight:pos?30:60,
  	        scrollbars: false, // Could make this automatic if a 'panel' method were created
  	        toolbarOnload:function(){
                var applyBtn=null;
                var fimg = {};
                if(!pos){
                    applyBtn = $("#dynimgs input");
                    fimg.action = "updateflash";
                    $("#dynimgs").buttonset();
                }else{//is a advertiement
                    applyBtn = $("#setAd");
                	fimg.pos = pos;
                    fimg.action = "updateAd";
                    applyBtn.button();
                }


                applyBtn.click(function(){

                    if(!pos){
                    	 fimg.id = this.id.substring(4);
                    }                  
                    
                    var href = $("#href").val();
                    //alert(href);
                    if(!selectImage || !href){
                          alert("请先选择图片或者填写地址");
                          return false;
                     }
                    
                var urlpattern =/((http|https|ftp):(\/\/|\\\\)((\w)+[.]){1,}([a-z]{1,3}|[0-9]{1,3})(((\/[\~]*|\\[\~]*)(\w)+)|[.](\w)+)*(((([?](\w)+){1}[=]*))*((\w)+){1}([\&](\w)+[\=]((\w)+|-|%|\+|\#|(\w)+)*)*))/; 
                if(!urlpattern.test(href)){
                        alert("请输入正确的网址");
                        return false;
                }
                href = encodeURI(href);
                selectImage = encodeURI(selectImage);
                fimg.image=selectImage;
                fimg.href=href;
                var req = new Request.JSON({
                    "url":"../model/config/foodfash.php",
                    "onSuccess":function(jsonData){
                         alert(jsonData.message);
                    },
                    "onFailure":function(xhr){
                         alert(xhr.responseText); 
                    }
                });
                req.post(fimg);
                return false;

             }); 
            
                

                
                  
              },//end of toolbarOnload
  	        onContentLoaded: function(){    
  	       
  	            new MUI.Column({
  	                container: 'imageShowWindow_contentWrapper',//'splitWindow_contentWrapper',
  	                id: 'imageShowWindow_sideColumn',
  	                placement: 'left',
  	                width: 170,
  	                resizeLimit: [100, 300]
  	            });
  	        
  	            new MUI.Column({
  	                container: 'imageShowWindow_contentWrapper',//splitWindow_contentWrapper',
  	                id: 'imageShowWindow_mainColumn',
  	                placement: 'main',
  	                width: null,
  	                resizeLimit: [100, 300]
  	            });
  	        
  	            new MUI.Panel({
  	                header: false,
  	                id: 'imageShowWindow_panel1',                   
  	                contentURL: '../view/config/jquery_upload_crop/upload_pic/shopperimage.php?imgsrc=http://www.google.com.hk/intl/zh-CN/images/logo_cn.png',
  	                column: 'imageShowWindow_mainColumn',
  	                panelBackground: '#fff'
  	            });
  	        
  	            new MUI.Panel({
  	                header: false,
  	                id: 'imageShowWindow_panel2',
  	                addClass: 'panelAlt',                   
  	                contentURL: '../view/config/jquery_upload_crop/upload_pic/left.php',
  	                column: 'imageShowWindow_sideColumn'                    
  	            });
             
  	        }           
  	    });
  	};// end of imageWindow

	
	var ids = ['a','b','c','d','e','f','g','h','i','j'];
	

	function loadPosInfo(){

         var req = new Request.JSON({
           "url":"../model/config/foodfash.php",
           "onSuccess":function(json){
        	   initilize(json);
        	   
        	 
           },
           "onFailure":function(xhr){
              alert(xhr.responseText);

           }


             });
         var pd = {};
         pd.action = "loadnamepos";
         req.post(pd);


   }

	
	function initilize(idata){
        var tb =$("table");
		var pd = {};
		pd.action="list";
		pd.actionparam="all";
		
	    var req = new Request.JSON({
	         "url":"../model/artitleCatalog.php",
	         "onSuccess":function(jsonData){
	    	   block(tb,"正在加载...");
	    	   for(var j=0;j<ids.length;j++){
                 var ta = $("<option value='-1'>请选择分类</option>");
                 $("#"+ids[j]).append(ta);
               }
	            var rows = jsonData.rows;
	            for(var i=0;i<rows.length;i++){
	                var cata = $("<option></option>");
	                cata.val(rows[i].id);
	                cata.text(rows[i].name);
	                for(var j=0;j<ids.length;j++){
	                   var ta = cata.clone();
	                   var p = ids[j];
                      
		               if(idata[p] && idata[p]['artitleCatalogId']==rows[i].id){
		                   ta.attr("selected",true);
		                   $("#"+ids[j]+"_name").val(idata[p]['name']);
	                   }
	                   $("#"+ids[j]).append(ta);
	                  
	                }

	            }
	            unblock(tb);

	        
	         },//end of success 
	         "onFailure":function(xhr){
	              alert(xhr.responseText);

	         }
	        });
	       req.post(pd);
	       block(tb,"正在加载,请稍等... ...");

    }
	loadPosInfo();	
    $("select").change(function(){

           var name  = $("#"+this.id+"_name").val();
           if(!name || $(this).val()==-1){
             notify("位置"+this.id.toUpperCase()+" 名称必须填写/必须选择一个分类!");
             return ;
           }
           
           
           var pd = {};
           pd.action="updateFoodfash";
           pd.pos = this.id;
           pd.name = name;
           pd.artitleCatalogId = $(this).val();
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
             
         

    });
	
});//end of document ready function
</script>
</head>
<body>
<table width="100%" border="1">
  <tr>
    <th colspan="3" scope="col">精彩时尚设置</th>
  </tr>
  <tr>
    <td><input type="button" id="selectpic" value="选择图片" />
    <input type="button" id="uploadpic" value="上传图片" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>位置A
      <input type="text" name="a_name" id="a_name" />
      <select name="a" id="a">
    </select></td>
    <td>位置B
      <input type="text" name="b_name" id="b_name" />
      <select name="b" id="b">
    </select></td>
    <td>位置C
      <input type="text" name="c_name" id="c_name" />
      <select name="c" id="c">
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>位置D
      <input type="text" name="d_name" id="d_name" />
      <select name="d" id="d">
    </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>位置E
      <input type="text" name="e_name" id="e_name" />
      <select name="e" id="e">
    </select></td>
    <td>位置F
      <input type="text" name="f_name" id="f_name" />
      <select name="f" id="f">
    </select></td>
    <td>位置G
      <input type="text" name="g_name" id="g_name" />
      <select name="g" id="g">
    </select></td>
  </tr>
  <tr>
    <td>位置H
      <input type="text" name="h_name" id="h_name" />
      <select name="h" id="h">
    </select></td>
    <td>位置I
      <input type="text" name="i_name" id="i_name" />
      <select name="i" id="i">
    </select></td>
    <td>位置J
      <input type="text" name="j_name" id="j_name" />
      <select name="j" id="j">
    </select></td>
  </tr>
 
</table>
</body>
</html>