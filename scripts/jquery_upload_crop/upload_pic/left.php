<?php
use utils\Response;
require_once '../../../tools/utils.php';
require_once '../../../tools/jsonutil.php';
use utils\Utils;
$imgBase = "/cs78/scripts/jquery_upload_crop/upload_pic/";
$dir = $_SERVER['DOCUMENT_ROOT']."/cs78/scripts/jquery_upload_crop/upload_pic";

$util= new Utils();
//$util->logInfo("文件目录绝对路径是 : ".$dir);
$files = $util->listFiles($dir,"php");
//$util->logInfo($files);
?>

<script type="text/javascript">
function showImages(imgsrc){
	   selectImage = imgsrc;
       //alert(selectImage);
	   MUI.updateContent({
		    element: $('imageShowWindow_panel1'),                    
		    url: '../scripts/jquery_upload_crop/upload_pic/shopperimage.php?imgsrc='+imgsrc,
		    title: '店家图片',
		    padding: { top: 8, right: 8, bottom: 8, left: 8 }
		});
}
</script>
<ol id='imgul'>
 <?php
     for($i=0;$i<count($files);$i++){
         $imgsrc = $imgBase.$files[$i];
         //$util->logInfo($imgsrc);
         
 ?>
   <li>
   <a href="javascript:;" 
      onclick="showImages('<?php echo $imgsrc;?>');return false;">
       <img alt="<?php echo $imgsrc;?>" src = "<?php echo $imgsrc;?>" style="border:0px; width:120px;height:90px;cursor:hand;"/>
       </a></li>
 <?php } ?>
</ol>

