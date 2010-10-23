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


$sql = "select * from news where id=$id";
$entitylist = queryForEntities($sql);
$entity = $entitylist==null?NULL:$entitylist[0];


$entities = get_html_translation_table(HTML_ENTITIES);
$trans = array_flip($entities);
$xcontent = strtr($entity["content"],$trans);
$title = $entity['title'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript">
jQuery(document).ready(function($){ 
	$("#saveAction").click(function() {
		try {
			$("form").formProceed( {
				"errorPanel":"errorPanel",
				"rules" : ruls,
				"messages" : megs,
				"url" : "../dataaccess/news.php",
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
		"title" : {
			"required" : true,
			"min" : 6
			
		},
		"content":{
			"required":true
		}

	};
	var megs = {
		"title" : {
			"required" : "需要新闻标题",
			"min" : "新闻标题长度不能小于"
		},
		"content":{
			"required":"新闻内容不能为空"
		}
	};

});
</script>

</head>

<body>
<form>
<?php echo $idInput;?>
<table width="100%" border="1">
  <tr>
    <th scope="col" colspan="2" id="errorPanel">&nbsp;</th>
    
  </tr>
  <tr>
    <td>新闻标题</td>
    <td><input type="text" name="title" id="title" style="width:500px;" value="<?php echo $title; ?>" /></td>
  </tr>
  <tr>
    <td>新闻内容</td>
    <td>
    <?php
       createFckeditor("content",$xcontent);
    ?>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><button type="button" id="saveAction">保存新闻</button></td>
  </tr>
</table>
</form>
</body>
</html>