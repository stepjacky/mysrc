<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript">

jQuery(document).ready(function($){
	  var tb =$("table");
	 $(".selectPic").click(function(){
		  var pos = this.id.charAt(0);
		  alert(pos);
    	  imageShowWindow(pos);
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
            toolbarURL:'../view/config/util/imageOnly.html',
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
                    
                 
                    //alert(href);
                    if(!selectImage){
                          alert("请先选择图片");
                          return false;
                     }
                selectImage = encodeURI(selectImage);
                fimg.image=selectImage;
                var req = new Request.JSON({
                    "url":"../model/config/foodmap.php",
                    "onSuccess":function(jsonData){
                         notify(jsonData.message);
                         MUI.closeAll();
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

	
	var ids = ['a','b','c','d','e','f'];
	

	function loadPosInfo(){

         var req = new Request.JSON({
           "url":"../model/config/foodmap.php",
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
  	         "url":"../model/config/foodmap.php",
  	         "onSuccess":function(jsonData){
        	      notify(jsonData.message); 	        
  	         },
  	         "onFailure":function(xhr){
  	              alert(xhr.responseText);

  	         }
  	        });
  	       req.post(pd);
             
         

    });

    //添加路段信息
    $("#apply").click(function(){
       
        var pd = {};
        pd.action = "addindicate";
        if(!$("#name").val() || !$("#indicate").val()){
             notify("请填写标题或者路段信息");
             return false;

        }
        pd.name = $("#name").val();
        pd.indicate = $("#indicate").val();
        block(tb,'正在处理。。。');
        var req = new Request.JSON({
            "url":"../model/config/foodmap.php",
            "onSuccess":function(msg){
                 notify(msg.message);
                 unblock(tb);
            },
            "onFailure":function(xhr){
                   alert(xhr.responseText);

            }



                });
        req.post(pd);
  
    }).button();
	
});//end of document ready function
</script>
</head>
<body>
<table width="102%" border="1">
  <tr>
    <th colspan="6" scope="col">美食地图设置</th>
  </tr>
  <tr>
    <td width="28%" ><input type="button" id="uploadpic" value="上传图片" /></td>
    <td width="27%"></td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>位置A
      <input type="text" name="a_name" id="a_name" />
      <select name="a" id="a">
    </select>
    <button id="a_pic" class="selectPic">选择图片</button></td>
    <td>位置B
      <input type="text" name="b_name" id="b_name" />
      <select name="b" id="b">
    </select>
      <button id="b_pic" class="selectPic">选择图片</button></td>
    <td width="28%">位置C
      <input type="text" name="c_name" id="c_name" />
      <select name="c" id="c">
    </select>
      <button id="c_pic" class="selectPic">选择图片</button></td>
    <td width="16%">位置D
      <input type="text" name="d_name" id="d_name" />
      <select name="d" id="d">
    </select>
     <button id="d_pic" class="selectPic">选择图片</button></td>
    <td width="0%">位置E
      <input type="text" name="e_name" id="e_name" />
      <select name="e" id="e">
    </select>
      <button id="e_pic" class="selectPic">选择图片</button></td>
    <td width="1%">位置F
      <input type="text" name="f_name" id="f_name" />
      <select name="f" id="f">
      </select>
      <button id="f_pic" class="selectPic">选择图片</button></td>
  </tr>
  <tr>
    <td height="150">添加标志路段</td>
    <td height="150" colspan="5">
    <dd>路段名称
    <input type="text" name="name" id="name" /><button id="apply">应用设置</button>
    <dd>路段信息
    <textarea name="indicate" id="indicate" cols="60" rows="10"></textarea>
    [多个用半角逗号隔开]</td>
  </tr>
 
</table>
</body>
</html>