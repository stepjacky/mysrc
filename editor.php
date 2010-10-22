<div> 
          	<?
          	$base = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/ppedu/";
          if(isset($_GET['dataType'])){
          	 $params='';
          	 $pstr='';
          	 if(isset($_GET['params'])){
          	  $params=$_GET['params'];
          	  $paires = explode('|',$params);
          	  foreach($paires as $par){
          	  	foreach(explode(',',$par) as $nv){
          	  		$pstr.=$nv[0].'='.$nv[1].'&';
          	  	}
          	  	
          	  }
          	 }
          	 include ($_GET['dataType'].".php");
          }else{
          	  echo "不存在的数据类型:<br/>".$_GET["dataType"];
          }  	   
         ?>             
</div>