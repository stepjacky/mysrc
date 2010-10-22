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
$entity = $entitylist==null?:$entitylist[0];

$name      = getProperty($entity, "name");
$intro     = getProperty($entity, "intro");
$catalogId = getProperty($entity, "catalogId");
$image     = getProperty($entity, "image");


?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>

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
     <button id="selectPic">选择图片</button> <button id="viewPic">查看图片</button> <button id="uploadPic">上传图片</button>
     <input name="image" value="<?php echo $image;?>"/>
     </td>
   </tr>
   <tr>
     <td>产品简介</td>
     <td><textarea name="intro" id="intro" style=" width:400px; height:80px; border:#06F dashed inset 1px"><?php echo $intro;?></textarea></td>
   </tr>
   <tr>
     <td>产品分类</td>
     <td><select name="catalogId" id="catalogId">
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