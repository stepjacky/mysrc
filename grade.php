<?
require_once "included/database.php";
if(isset($_POST["action"])){
	$action = $_POST["action"];
	 
	switch($action){
		case "add":
			doAdd();
			break;
		case "remove":;
		break;
		case "update":doUpdate();
		break;
		case "sorted":doSort();break;
		case "load":
			doList($_POST["pid"]);break;
		case "list":
			doListAll();break;
		default:;
	}

}

function doSort(){
	try{
		$sortnum = $_POST['sortnum'];
		if(isset($sortnum)){
			for($st=0;$st<count($sortnum);$st++){
				$sql = "update grade set sortnum=".$st." where id=".$sortnum[$st];
				query($sql);
			}
		}else{
			echo '参数错误';
		}
	}catch(Exception $e){
		echo $e->getMessage();
	}
		
}
function doUpdate(){
	try{
		 
		update("grade",array("name" => $_POST["data"]),"id=".$_POST["id"]);
	}
	catch(Exception $e){
		echo $e -> getMessage();
	}
		
}
function doAdd(){
	try{
		create("grade",
		array("name" => $_POST["data"], "parent_id" => $_POST["pid"]));
	}
	catch(Exception $e){
		echo $e -> getMessage();
	}

}
function doList($parentId){
	if(isset($parentId)){
		$sql = "select * from grade where parent_id=" . $parentId ." order by sortnum asc";
		$results = query($sql);
		$json = '[';
		while($row = mysql_fetch_assoc($results)){
			$json = $json . "{data:'" . $row['name'] . "',attributes:{id:'" . $row['id'] . "'}";
			$where = 'parent_id=' . $row['id'];
			if(getCountByWhere('grade', $where) != 0){
				$json = $json . ",state : 'closed'},";
			}else{
				$json = $json . "},";
			}

		}
		$json = substr($json, 0, strlen($json)-1);
		$json = $json . "]";
		echo $json;
	}
	
}
function doListAll(){
	 $sql = "select * from grade where parent_id !=-1 ";
	 $results = query($sql);
	 $json="";
	 $i=0;
	 while($row = mysql_fetch_assoc($results)){
	 	$json->rows[$i]['id']=$row['id'];
        $json->rows[$i]['cell']=array($row['id'],$row['name']);
        $i++;
	 }
	 echo jsonEncode($json);
}

?>