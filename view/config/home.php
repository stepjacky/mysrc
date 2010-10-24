<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<script type="text/javascript">


  jQuery(document).ready(function($){

	  
      $("#dynpics").click(function(){
          return false;
      }).buttonset();
      $("#selectpic").click(function(){
    	  imageShowWindow();
          return false;

      }).button();
      $("#uploadpic").click(function(){
    	  window.open('../view/config/jquery_upload_crop/upload_crop_v1.2.php','avatar');
          return false;

          }).button();
     
      
      $("#embedevents").click(function(){}).button();
      $("#shoppercatalog").click(function(){}).button();

      $(".setAdInfo").click(function(){
            //指定中间众多广告
          var pos = $(this).attr("pos");  
    	  imageShowWindow(pos);

      }).button(); 
     
      var tb = $("table");
      var msg = "正在处理,请稍后...";
      
     var dyninfos = [];

      
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
                    "url":"../model/config/home.php",
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


  	var shopperImageWindow = function(imgsrc){ 
  		new MUI.Window({
  			id: 'shopperImageWindow',
  			title: '查看商家图片',
  			contentURL: 'jquery_upload_crop/upload_pic/shopperimage.php?imgsrc='+imgsrc,
  			width: 400,
  			height: 300
  		});
  	};

    function setShopperCatalogPos(pos){
        if(selectCatalog==-1){
               notify("警告:请先选择店家类别");
               return false;

        }

        var req = new Request.JSON({
               "url":"../model/shoppercatalog.php",
               "onSuccess":function(jsonMessage){
                   notify("设置分类位置 :"+jsonMessage.message);
                   unblock(tb);
               },
               "onFailure":function(xhr){

                   notify(xhr.responseText);

               }

            });
        var postData =  {
             "action":"updatePos",
             "homepos":pos,
             "id":selectCatalog

        };
        req.post(postData);
        

    }


    function setArtitleCatalogPos(pos){
         if(selectCatalog==-1){
             notify("警告:请先选择文章类别");
             return false;

      }

      var req = new Request.JSON({
             "url":"../model/artitlecatalog.php",
             "onSuccess":function(jsonMessage){
                 notify("设置分类位置 :"+jsonMessage.message);
             },
             "onFailure":function(xhr){

                 notify(xhr.responseText);

             }

          });
      var postData =  {
           "action":"updatePos",
           "homepos":pos,
           "id":selectCatalog

      };
      req.post(postData);


    }

    
    
    $(".setShopperCatalog").click(function(){

        var pos = $(this).attr("pos");
        block(tb,msg);
        setShopperCatalogPos(pos);
         

    }).button();


    $(".setArtitleCatalog").click(function(){
          var pos = $(this).attr("pos");
          setArtitleCatalogPos(pos);
    

    }).button();
    
    var selectCatalog = -1;

    var req = new Request.JSON({
            "url":"../model/shoppercatalog.php",
            "onSuccess":function(jsonData){
               var cse = $("#shopperCatalogs");
               var nopt = $("<option></option>");
               nopt.text("请选择店家分类");
               nopt.val(-1);
               cse.append(nopt);
               for(var i=0;i<jsonData.rows.length;i++){
                   var opt = $("<option></option>");
                   opt.val(jsonData.rows[i].id);
                   opt.text(jsonData.rows[i].name);
                   
                   cse.append(opt);
                   //alert(cse.html());
               }

               cse.change(function(){

            	   selectCatalog  =$(this).val();

               });
        
            },
            "onFailure":function(xhr){

                notify("加载店家分类错误:" + xhr.responseText);

            }


        });
    req.post({"action":"list","actionparam":"all"});
    req = new Request.JSON({
            "url":"../model/artitlecatalog.php",
            "onSuccess":function(jsonData){
        
               var cse = $("#artitleCatalogs");
               var sasa = $("#newsasa");
               var foods = $("#newfoods");
               var myfme = $("#cookMenu");
               var emenu = $("#eastCook");
               var wmenu = $("#westCook");
               var nopt = $("<option value='-1'>请选择文章分类</option>");
               cse.append(nopt);
               sasa.append(nopt.clone());
               foods.append(nopt.clone());
               
               for(var i=0;i<jsonData.rows.length;i++){
                   var tmp = jsonData.rows[i];
                   var opt = $("<option></option>");
                   opt.val(tmp.id);
                   opt.text(tmp.name);

                   cse.append(opt);
                   sasa.append(opt.clone());
                   foods.append(opt.clone());
                  
                   
                   var myfmeopt =  opt.clone();
                   if(tmp.cookMenu)myfmeopt.attr("selected",true);
                   myfme.append(myfmeopt);
                   var eastopt = opt.clone();
                   if(tmp.eastCook)eastopt.attr("selected",true);
                   emenu.append(eastopt);
                   var westopt = opt.clone();
                   if(tmp.westCook)westopt.attr("selected",true);
                   wmenu.append(westopt);
                   
                   //alert(cse.html());
               }

               cse.change(function(){

            	   selectCatalog  =$(this).val();

               });

               sasa.change(function(){
                   var req = new Request.JSON({
                       "url":"../model/config/home.php",
                       "onSuccess":function(){
                            notify("更新最新优惠分类成功!"); 
                       
                       },
                       "onFailure":function(xhr){
                           notify("错误: "+xhr.responseText); 

                       }
                       });
                   req.post({
                        "action":"updateSasa",
                        "id":$(this).val()    

                       });
 
               });
               foods.change(function(){
                   var req = new Request.JSON({
                       "url":"../model/config/home.php",
                       "onSuccess":function(){
                            notify("更新最新美食分类成功!"); 
                       
                       },
                       "onFailure":function(xhr){
                           notify("错误: "+xhr.responseText); 

                       }
                       });
                   req.post({
                        "action":"updateNewFoods",
                        "id":$(this).val()    

                       });



               });             
        
            },// end of onsuccess 
            "onFailure":function(xhr){

                notify("加载文章分类错误:" + xhr.responseText);

            }


        });
    req.post({"action":"list","actionparam":"all"});

    //设置菜谱文章类
    $(".setCookMenu").click(function(){
         var fromId = $(this).attr("from");
         var vl = $("#"+fromId).val();         

         var req = new Request.JSON({
             "url":"../model/config/home.php",
             "onSuccess":function(){
                  notify("更新菜谱分类成功!"); 
             
             },
             "onFailure":function(xhr){
                 notify("错误: "+xhr.responseText); 

             }
             });
         req.post({
              "action":"updateCookMenu",
              "id":vl,
              "fieldName":fromId    

             });


    }).button();

    //
    
  });//end of document ready function 
</script>
<style type="text/css">
   .setShopperCatalog .setArtitleCatalog{
   
      width:100%;
   
   }
   .cookMenu{
	   width:100%;
	   height:100%;
	   border:#9C0 thin dotted outset;   
	   font-size:14px;
	   font-weight:bolder;
	   color:#06F;
	   font-family:Verdana, Geneva, sans-serif;
   }


</style>
</head>
<body>
<table width="100%" border="1">
  <tr>
    <td width="21%" scope="col">美食动态</td>
    <td align="left" valign="top" scope="col">
    <input type="button" id="selectpic" value="选择图片" />
    <input type="button" id="uploadpic" value="上传图片" />
   </td>
    <td align="left" valign="top" scope="col">
    <label>最新优惠</label>
    <select name="newsasa" id="newsasa">
    </select>
    </td>
    <td align="left" valign="top" scope="col"><label>最新美食
      <select name="newfoods" id="newfoods">
      </select>
    </label></td>
  </tr>  
  <tr>
    <td height="235" rowspan="12">广告位置 A</td>
    <td width="39%"><button class="setAdInfo" pos="a" style="width:100%">设置图片a</button></td>
    <td width="20%"><button class="setAdInfo" pos="b" style="width:100%">设置图片b</button></td>
    <td width="20%"><button class="setAdInfo" pos="c" style="width:100%">设置图片c</button></td>
  </tr>
  <tr>
    <td><button class="setAdInfo" pos="d" style="width:100%">设置图片d</button></td>
    <td><button class="setAdInfo" pos="e" style="width:100%">设置图片e</button></td>
    <td><button class="setAdInfo" pos="f" style="width:100%">设置图片f</button></td>
  </tr>
  <tr>
    <td rowspan="8">&nbsp;</td>
    <td><button class="setAdInfo" pos="g" style="width:100%">设置图片g</button></td>
    <td><button class="setAdInfo" pos="h" style="width:100%">设置图片h	</button></td>
  </tr>
  <tr>
    <td><button class="setAdInfo" pos="i" style="width:100%">设置图片i</button></td>
    <td><button class="setAdInfo" pos="j" style="width:100%">设置图片j</button></td>
  </tr>
  <tr>
    <td><button class="setAdInfo" pos="k" style="width:100%">设置图片k</button></td>
    <td><button class="setAdInfo" pos="l" style="width:100%">设置图片l</button></td>
  </tr>
  <tr>
    <td><button class="setAdInfo" pos="m" style="width:100%">设置图片m</button></td>
    <td><button class="setAdInfo" pos="n" style="width:100%">设置图片n</button></td>
  </tr>
  <tr>
    <td><button class="setAdInfo" pos="o" style="width:100%">设置图片o</button></td>
    <td><button class="setAdInfo" pos="p" style="width:100%">设置图片p</button></td>
  </tr>
  <tr>
    <td><button class="setAdInfo" pos="q" style="width:100%">设置图片q</button></td>
    <td><button class="setAdInfo" pos="r" style="width:100%">设置图片r</button></td>
  </tr>
  <tr>
    <td><button class="setAdInfo" pos="s" style="width:100%">设置图片s</button></td>
    <td><button class="setAdInfo" pos="t" style="width:100%">设置图片t</button></td>
  </tr>
  <tr>
    <td><button class="setAdInfo" pos="u" style="width:100%">设置图片u</button></td>
    <td><button class="setAdInfo" pos="v" style="width:100%">设置图片v</button></td>
  </tr>
  <tr>
    <td><button class="setAdInfo" pos="w" style="width:100%">设置图片w</button></td>
    <td><button class="setAdInfo" pos="x" style="width:100%">设置图片x</button></td>
    <td><button class="setAdInfo" pos="y" style="width:100%">设置图片y</button></td>
  </tr>
  <tr>
    <td><button class="setAdInfo" pos="z" style="width:100%">设置图片z</button></td>
    <td><button class="setAdInfo" pos="aa" style="width:100%">设置图片aa</button></td>
    <td><button class="setAdInfo" pos="ab" style="width:100%">设置图片ab</button></td>
  </tr>
  <tr>
    <td>广告位置B</td>
    <td colspan="3"><button class="setAdInfo" pos="ac" style="width:100%">设置图片ac</button>
   
      <button class="setAdInfo" pos="ad" style="width:100%">设置图片ad</button>
   
      <button class="setAdInfo" pos="ae" style="width:100%">设置图片ae</button>
    
    </td>
  </tr>
  <tr>
    <td rowspan="5">设置餐馆类型位置</td>
    <td>选择店家分类</td>
    <td>
        <select id="shopperCatalogs" style="width:100%;height:20px;border:dotted 1px green;"></select>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><button class="setShopperCatalog" pos="a" style="width:100%">设置分类位置a</button></td>
    <td><button class="setShopperCatalog" pos="b" style="width:100%">设置分类位置b</button></td>
    <td><button class="setShopperCatalog" pos="c" style="width:100%">设置分类位置c</button></td>
  </tr>
  <tr>
    <td><button class="setShopperCatalog" pos="d" style="width:100%">设置分类位置d</button></td>
    <td><button class="setShopperCatalog" pos="e" style="width:100%">设置分类位置e</button></td>
    <td><button class="setShopperCatalog" pos="f" style="width:100%">设置分类位置f</button></td>
  </tr>
  <tr>
    <td><button class="setShopperCatalog" pos="g" style="width:100%">设置分类位置g</button></td>
    <td><button class="setShopperCatalog" pos="h" style="width:100%">设置分类位置h</button></td>
    <td><button class="setShopperCatalog" pos="i" style="width:100%">设置分类位置i</button></td>
  </tr>
   
    <tr>
    <td><button class="setShopperCatalog" pos="j" style="width:100%">设置分类位置j</button></td>
    <td><button class="setShopperCatalog" pos="k" style="width:100%">设置分类位置k</button></td>
    <td><button class="setShopperCatalog" pos="l" style="width:100%">设置分类位置l</button></td>
  </tr>
   
 
 <tr>
    <td>&nbsp;</td>
    <td>选择文章分类</td>
    <td>
        <select id="artitleCatalogs" style="width:100%;height:20px;border:dotted 1px green;"></select>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>推荐文章</td>
    <td><button class="setArtitleCatalog" pos="x" style="width:100%">设置分类位置x</button></td>
    <td><button class="setArtitleCatalog" pos="y" style="width:100%">设置分类位置y</button></td>
    <td><button class="setArtitleCatalog" pos="z" style="width:100%">设置分类位置z</button></td>
  </tr>
  <tr>
    <td rowspan="2">设置文章类型位置</td>
    <td><button class="setArtitleCatalog" pos="a" style="width:100%">设置分类位置a</button></td>
    <td><button class="setArtitleCatalog" pos="b" style="width:100%">设置分类位置b</button></td>
    <td><button class="setArtitleCatalog" pos="c" style="width:100%">设置分类位置c</button></td>
  </tr>
  <tr>
    <td><button class="setArtitleCatalog" pos="d" style="width:100%">设置分类位置d</button></td>
    <td><button class="setArtitleCatalog" pos="e" style="width:100%">设置分类位置e</button></td>
    <td><button class="setArtitleCatalog" pos="f" style="width:100%">设置分类位置f</button></td>
  </tr>
  <tr>
  <td height="165" rowspan="2">设置菜谱文章分类</td>
    <td><button id="menu"  from="cookMenu" class="setCookMenu">设置菜谱文章类</button></td>
    <td><button id="east"  from="eastCook" class="setCookMenu">设置中餐菜谱文章类</button></td>
    <td><button id="west"  from="westCook" class="setCookMenu">设置西餐菜谱文章类</button>
    </label></td>
  </tr>
  <tr>
    <td><select name="myFoodMenus" size="10" multiple class="cookMenu" id="cookMenu">
    </select></td>
    <td><select name="eastCookMenu" size="10" multiple class="cookMenu" id="eastCook">
    </select></td>
    <td><select name="westCookMenu" size="10" multiple class="cookMenu" id="westCook">
    </select></td>
  </tr>
</table>
<div id="debug" style="height:500px;">
  
</div>
</body>
</html>
