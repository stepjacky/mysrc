<script
	language="javascript" type="text/javascript"
	src="scripts/jquery-1.3.2.min.js"></script>
<script
	language="javascript" type="text/javascript"
	src="scripts/jquery.selectboxes/jquery.selectboxes.min.js"></script>
<?php 
  require_once "included/database.php";
  $locked=array();
  $unlocked=array();
  $sql = "select email,locked from user";
  $result = query($sql);
  while($row = mysql_fetch_assoc($result)){
  	  if($row['locked']=='y'){
  	  	 $locked[] = $row['email'];
  	  	 
  	  }else{
  	  	$unlocked[]=$row['email'];
  	  }
  }
  
?>
<table>
 <thead>
 <tr><th colspan="4">用户锁定管理</th></tr>
 <tr><th>未锁定用户</th>
 <th></th>
 <th>要锁定用户</th>
 <th>已锁定用户</th>
 </tr>
 </thead>
 <tbody>
  <tr>
  <td>
   <select id='unlocked' size="20"
   style='width:200px;'
   >
   
      <?php 
        foreach($unlocked as $u){
        	?>
        <option value='<?php echo $u;?>'><?php echo urldecode($u);?></option> 	
        	
        	<?php 
        }
      ?>    
   </select>
  </td>
  <td>
  <br/><br/><br/><br/><br/><p>
   <button id='lockbtn'>=&gt</button>
   </p>
   <p>
   <button id='unlockbtn'>&lt=</button>
   </p>
   <br/><br/>
   <button>
     提交
   </button>
  </td>
  <td>
     <select id='belocked' size="20"  style='width:200px;'>
     
     </select>  
  </td>
  <td>
  <select id='locked' size="20"  style='width:200px;'>
    <?php 
        foreach($locked as $u){
        	?>
        <option value='<?php echo $u;?>'><?php echo urldecode($u);?></option> 	
        	
        	<?php 
        }
      ?>    
  
  </select>  
  
  </td>
  </tr>
 </tbody>
</table>
<script language="javascript>
<!-- 
   $(function(){
     $("#lockbtn").click(function(){
       
       
        }
     );
     
      $("#unlockbtn").click(function(){
       
       
        }
     );
   });

//-->
</script>