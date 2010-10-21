<?php
$imgsrc = $_GET['imgsrc'];
if($imgsrc==''){
    
    echo "没有指定图片";

}else{
?>
<img src="<?php echo $imgsrc;?>" />
<?php 
  }
?>