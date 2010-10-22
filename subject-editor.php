<?php

include_once "included/database.php";

switch($_GET["act"]){
	case 'add':
		$msg='添加完成 :<br/>';
		foreach($_GET['sid'] as $sid){
			$count = getCountByWhere("subject_grade","subject_id=".$sid." and grade_id=".$_GET['gid']);
			if($count==0){
			   create("subject_grade",array("subject_id"=>$sid,"grade_id"=>$_GET['gid']));
			   
			}else{				
			   $msg.= "年级 : ".$_GET['gid']." 已包含学科  : ".$sid."<br/>";	
			}
			
		}
		echo $msg;
		;break;
	case 'remove':
		foreach($_GET['sid'] as $sid){
			delete("subject_grade",array("subject_id"=>$sid,"grade_id"=>$_GET['gid']));
		}
		;break;
	case 'update':
		foreach($_GET['sid'] as $sid){
			update("subject_grade", array("grade_id"=>$_GET['gid']), "subject_id=$sid");
		}

		break;
	case 'filter':
		$gid = $_GET['gid'];
		$sql= "select s.id as sid,s.name as sname from subject as s ,subject_grade as g where s.id=g.subject_id and g.grade_id=".$gid;
		 
		$result  =query($sql);
		$s="[";
		$c="";
		while($row = mysql_fetch_assoc($result)){
			$c.="{sid:'".$row["sid"]."',sname:'".$row["sname"]."'},";
		}
		$s.=substr($c,0,strlen($c)-1);
		$s.="]";
		echo $s;
		break;
	default:
		 
		;
}

?>