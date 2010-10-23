<?php 
require_once '../tools/utils.php';

$entry = array();
$idInput = "";
$fileName = basename(__FILE__);
$entryName = getEntryName($fileName);

$action = "create";
$id=-1;
if(isset($_GET['action'])){
    $action = $_GET['action'];
    if($action=='update'){
        if(!isset($_GET['id'])){
            echo '{"message":"没有收到主键为Id"}';
            exit(0);
        }
        $id = $_GET['id'];
        $idInput = "<input type=\"hidden\" name=\"id\" value=\"".$_GET['id']."\"/>";
       
      
    }
}


$sql = "select * from $entryName where id=$id";
$entitylist = queryForEntities($sql);
$entity = $entitylist==null?null:$entitylist[0];

$name      = getProperty($entity, "name");
$intro     = getProperty($entity, "intro");
$catalogId = getProperty($entity, "catalogId");
$image     = getProperty($entity, "image");

$sql = "select id,name from catalog";
$catalogs = queryForEntities($sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<script type="text/javascript">
jQuery(document).ready(function($){ 
	
	$("#saveAction").click(function() {
		try {
			$("form").formProceed( {
				"errorPanel":"errorPanel",
				"rules" : ruls,
				"messages" : megs,
				"url" : "../dataaccess/<?php echo $entryName;?>.php",
				"type" : "post",
				"data":"action=<?php echo $action;?>",
				"fckFieldName":"content",
				
				"validateSuccess" : function() {
					//alert("验证通过");
				},
				"validateFailure" : function() {
					//alert("表单验证失败");
				},
				"beforeSubmit" : function() {
					//alert("准备发送");
				},
				"submitSuccess" : function(data) {
					notify(data.message);
				},
				"submitFailure" : function(data) {
					alert("处理错误");
				}

			});
		} catch (ex) {
			alert(ex.message);
		}
         return false;
	}).button();

	var ruls = {
		"name" : {
			"required" : true,
			"min" : 3
			
		},
		"catalogId":{
			"required":true
		}

	};
	var megs = {
		"name" : {
			"required" : "产品名称不能为空",
			"min" : "产品名称长度不能小于"
		},
		"catalog":{
			"required":"产品分类不能为空"
		}
	};


	$("#selectPic").click(function(){
		imageSelectWindow();
		return false;
    }).button();
	$("#viewPic").click(function(){
		showImageWindow($("#image").val());
		return false;
    }).button();
	$("#uploadPic").click(function(){
		window.open('../scripts/jquery_upload_crop/upload_crop_v1.2.php','avatar');
		return false;

    }).button();


	var imageSelectWindow = function(){
	    new MUI.Window({
	        id: 'imageSelectWindow',
	        title: '选择产品图片',
	        width: 600,
	        height: 350,
	        resizeLimit: {'x': [450, 2500], 'y': [300, 2000]},
            toolbar:true,
            toolbarURL:'../view/util/imageTools.html',
            toolbarHeight:30,
	        scrollbars: false, // Could make this automatic if a 'panel' method were created
	        toolbarOnload:function(){
                $("#selectImg").click(function(){
                	//MochaUI.closeWindow($("imageShowWindow"));
                    //alert(selectImage);
                    $("#image").val(selectImage);
                    MochaUI.closeAll();  
                    return false;
                }).button();

                
            },
	        onContentLoaded: function(){    
	       
	            new MUI.Column({
	                container: 'imageSelectWindow_contentWrapper',//'splitWindow_contentWrapper',
	                id: 'imageSelectWindow_sideColumn',
	                placement: 'left',
	                width: 170,
	                resizeLimit: [100, 300]
	            });
	        
	            new MUI.Column({
	                container: 'imageSelectWindow_contentWrapper',//splitWindow_contentWrapper',
	                id: 'imageSelectWindow_mainColumn',
	                placement: 'main',
	                width: null,
	                resizeLimit: [100, 300]
	            });
	        
	            new MUI.Panel({
	                header: false,
	                id: 'imageSelectWindow_panel1',                   
	                contentURL: '../scripts/jquery_upload_crop/upload_pic/shopperimage.php?imgsrc=http://www.google.com.hk/intl/zh-CN/images/logo_cn.png',
	                column: 'imageSelectWindow_mainColumn',
	                panelBackground: '#fff'
	            });
	        
	            new MUI.Panel({
	                header: false,
	                id: 'imageSelectWindow_panel2',
	                addClass: 'panelAlt',                   
	                contentURL: '../scripts/jquery_upload_crop/upload_pic/left.php',
	                column: 'imageSelectWindow_sideColumn'                    
	            });
           
	        }           
	    });
	};// end of imageWindow


	var showImageWindow = function(imgsrc){ 
		new MUI.Window({
			id: 'showImageWindow',
			title: '查看产品图片',
			contentURL: '../scripts/jquery_upload_crop/upload_pic/shopperimage.php?imgsrc='+imgsrc,
			width: 400,
			height: 300
		});
	};
});
</script>

</head>
 <body>
 <form>
 <?php echo $idInput;?>
 <table width="100%" border="1">
   <tr>
     <th width="32%" scope="col" colspan="2" id="errorPanel">&nbsp;</th>
   </tr>
   <tr>
     <td>产品名称</td>
     <td><input type="text" name="name" id="name" style="width:260px; " value="<?php echo $name;?>" /></td>
   </tr>
   <tr>
     <td>产品图片</td>
     <td>
     <button id="selectPic" type="button">选择图片</button> 
     <button id="viewPic" type="button">查看图片</button> 
     <button id="uploadPic" type="button">上传图片</button>
     <input name="image" value="<?php echo $image;?>" id="image" type="hidden"/>
     </td>
   </tr>
   <tr>
     <td>产品简介</td>
     <td><textarea name="intro" id="intro" style=" width:400px; height:80px; border:#06F dashed inset 1px"><?php echo $intro;?></textarea></td>
   </tr>
   <tr>
     <td>产品分类</td>
     <td><select name="catalogId" id="catalogId">
     <?php 
        $selected="";
        foreach ($catalogs as $cata){
          if($catalogId == $cata['id']){
          	  $selected="\tselected=\"true\"\t";
          }else $selected="";	
     ?>
        <option value="<?php echo $cata['id'];?>" <?php echo $selected;?>>
        <?php echo $cata['name'];?>
        </option>
     <?php }?>
     </select></td>
   </tr>
   <tr>
     <td>&nbsp;</td>
     <td><button type="button" id="saveAction">保存产品</button></td>
   </tr>
 </table>
</form>
    </body>
</html>