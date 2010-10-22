<?
require_once "included/database.php";


 
switch($_POST["action"]){
	case "add":
		doAdd();
		break;
	case "remove":;
	break;
	case "update":doUpdate();
	break;
	case "sorted":doSort();break;
	case "load":
		//doList($_POST["pid"]);
		doList();break;
	case "filter":doFilter();break;
	default:;
}



function doSort(){
		
	$sortnum = $_POST['sortnum'];
	if(isset($sortnum)){
		for($st=0;$st<count($sortnum);$st++){
			$sql = "update chapter set sortnum=".$st." where id=".$sortnum[$st];
			query($sql);
		}
	}else{
		echo '参数错误';
	}

		
}
function doUpdate(){

	 
	update("chapter",array("name" => $_POST["data"]),"id=".$_POST["cid"]);
		
		
}
function doAdd(){
	 
	create("chapter", 
	array(
	"name" => $_POST["data"]
	,"parent_id" => $_POST["pid"]
	,"version_id"=>$_POST["vid"]
	,"subject_id"=>$_POST["sid"]
	,"grade_id"=>$_POST["gid"]
	,"semester"=>$_POST['seid']
	));
	 

}
function doList(){
	 
	$sql = "select * from chapter
            where parent_id=".$_POST['pid']." 
            and subject_id=".$_POST['sid']."
            and grade_id=".$_POST['gid']."
            and version_id=".$_POST['vid']."
            and semester='".$_POST['eid']."'
            order by sortnum asc";
	 
	$result = query($sql);
	$json = '[';
	while($row = mysql_fetch_assoc($result)){
		$json = $json . "{data:'" . $row['name'] . "',attributes:{id:'" . $row['id'] . "'}";
		$where = 'parent_id=' . $row['id'];
		if(getCountByWhere("chapter", $where) != 0){
			$json = $json . ",state : 'closed'},";
		}else{
			$json = $json . "},";
		}

	}
	$json = substr($json, 0, strlen($json)-1);
	$json = $json . "]";
	echo $json;
	 

}

function doFilter(){
	 
	$sql = "select * from chapter
            where parent_id=".$_POST['pid']." 
            and subject_id=".$_POST['sid']."
            and grade_id=".$_POST['gid']."
            and version_id=".$_POST['vid']."
            order by sortnum asc";
	 
	$result = query($sql);
	$json = '[';
	while($row = mysql_fetch_assoc($result)){
		$json = $json . "{data:'" . $row['name'] . "',attributes:{id:'" . $row['id'] . "'}";
		$where = 'parent_id=' . $row['id'];
		if(getCountByWhere("chapter", $where) != 0){
			$json = $json . ",state : 'closed'},";
		}else{
			$json = $json . "},";
		}

	}
	$json = substr($json, 0, strlen($json)-1);
	$json = $json . "]";
	echo $json;
	 

}
?>