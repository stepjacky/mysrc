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
$entity = $entitylist==null?NULL:$entitylist[0];

$name = getProperty($entity, "name");
$intro = getProperty($entity, "intro");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
			"min" : 6
			
		}	};
	var megs = {
		"name" : {
			"required" : "需要填写分类名称",
			"min" : "分类名称长度不能小于"
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
    <td>分类名称</td>
    <td><input type="text" name="name" id="name" value="<?php echo $name;?>" /></td>
  </tr>
  <tr>
    <td>分类说明</td>
    <td><textarea name="intro" id="intro" style=" width:300px; height:50px; border:#06F dashed inset 1px"><?php echo $intro;?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><button type="button" id="saveAction">保存分类</button></td>
  </tr>
</table>
</form>
</body>
</html>