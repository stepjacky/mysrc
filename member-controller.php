<?php
require_once "included/database.php";
$tableName='user';
$sqlconditions='';
//
if(isset($_POST['oper']))
{
	switch($_POST['oper'])
	{
		case 'add':
			break;
		case 'edit':
			break;
		case 'editPro':
			doEditStudentProfile();
			exit(0);
			break;
		case 'editAdv':
			doEditTeacherAdv();
			exit(0);
			break;
		case 'locked':
			doLockedUser('y');
			exit(0);
			break;
		case 'unlocked':
			doLockedUser('n');
			exit(0);
			break;			
		case 'del':
			doDeleteUser();
			exit(0);
			break;
	}
}

function doDeleteUser(){
	$SQL=array();
    foreach($_POST['users'] as $user){
		$SQL[]=strutSQLDeletor('user','id='.$user);
	}
    queryWithTransaction($SQL);
	
}
function doLockedUser($locked){
	$SQL=array();
	foreach($_POST['users'] as $user){
		$SQL[]=strutSQLUpdator('user',array('locked'=>$locked),'id='.$user);
	}
    queryWithTransaction($SQL);
	
}
function doEditTeacherAdv(){
	$count = getCountByWhere("teacher_adv","email='".$_POST['email']."'");
	if($count==0){
		create("teacher_adv",array(
	            "servyear" => $_POST['servyear'],
				"aword" => $_POST['aword'],
				"technical"=> $_POST['technical'],
				"teacher_grade_id"=> $_POST['teacher_grade_id'],
				"honor"=> $_POST['honor'],
				"servyear_show"=> $_POST['servyear_show'],
				"technical_show"=> $_POST['technical_show'],
				"aword_show"=> $_POST['aword_show'],
				"teacher_grade_show"=> $_POST['teacher_grade_show'],
				"honor_show"=> $_POST['honor_show'],
		        "email"=>$_POST['email']
			
		));

	}else{
		update("teacher_adv",array(
	            "servyear" => $_POST['servyear'],
				"aword" => $_POST['aword'],
				"technical"=> $_POST['technical'],
				"teacher_grade_id"=> $_POST['teacher_grade_id'],
				"honor"=> $_POST['honor'],
				"servyear_show"=> $_POST['servyear_show'],
				"technical_show"=> $_POST['technical_show'],
				"aword_show"=> $_POST['aword_show'],
				"teacher_grade_show"=> $_POST['teacher_grade_show'],
				"honor_show"=> $_POST['honor_show']
		        ),
		        "email='".$_POST['email']."'"       
		      );
	}
}

function doEditStudentProfile(){
	$farray = array(
   	   "localname"=>$_POST['localname'],
   	   "pwd"=>$_POST['pwd'],
   	   "sex"=>$_POST['sex'],
   	   "birthday"=>$_POST['birthday'],
   	   "qq"=>$_POST['qq'],
   	   "msn"=>$_POST['msn'],
   	   "address"=>$_POST['address'],
   	   "school"=>$_POST['school'],   	  
   	   "phone"=>$_POST['phone'],
   	   "signature"=>$_POST['signature']	
	);
	if(isset($_POST['parent']) && isset($_POST['grade_id'])){
		 $farray["parent"]=$_POST['parent'];
   	     $farray["grade_id"]=$_POST['grade_id'];
	}
	update("user",$farray,"email='".$_POST['email']."'");
}



if($_GET['_search']=='true')
{
	$sql="\t and ";
	$mark=false;
	if(isset($_GET['localname']))
	{
		$sql=$sql . "\t u.localname like '%" .$_GET['localname'] . "%' and";
		$mark=true;
	}
	if (isset($_GET['usertype']))
	{
		$sql=$sql . "\t u.usertype='" .$_GET['usertype'] ."' and";
		$mark=true;
	}
	if (isset($_GET['regtime']))
	{
		$sql=$sql ."\t u.regtime='" .$_GET['regtime'] ."' and";
		$mark=true;
	}
	if (isset($_GET['email']))
	{
		$sql=$sql . "\t u.email like '%" . $_GET['email'] . "%' and";
		$mark=true;
	}
	if (isset($_GET['experience']))
	{
		$sql=$sql . "\t u.experience=" . $_GET['goldcoin'] . " and";
		$mark=true;
	}
	if (isset($_GET['onlinesum']))
	{
		$sql=$sql. "\t u.onlinesum=" .$_GET['onlinesum'] ." and";
		$mark=true;
	}
	if (isset($_GET['lastlogin']))
	{
		$sql=$sql . "\t u.lastlogin='" .$_GET['lastlogin'] . "' and";
		$mark=true;
	}
	if ($mark==true)
	$sqlconditions=substr($sql,0,strlen($sql)-3);
	//echo $sqlconditions;
}
//
$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
if(!$page) $page=0;
if(!$limit) $limit=10;
if(!$sidx) $sidx ='id';
if(!$sord) $sord='asc';
$count = getCount($tableName);
// calculate the total pages for the query
if( $count > 0 && $limit > 0) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
// if for some reasons the requested page is greater than the total
// set the requested page to total page
if ($page > $total_pages) $page=$total_pages;

// calculate the starting position of the rows
$start = $limit*$page - $limit;

// if for some reasons start position is negative set it to 0
// typical case is that the user type 0 for the requested page
if($start <0) $start = 0;

// the actual query for the grid data
$SQL = "SELECT
u.id,
u.localname  ,
u.experience,
sum(uxp.medal) medal,
u.email, 
u.phone, 
u.qq,
u.msn,
u.regtime,
u.usertype,
u.locked
FROM $tableName u
left join userexp uxp on uxp.email=u.email
WHERE u.usertype='".$_GET['utype']."' $sqlconditions
group by u.email
ORDER BY $sidx $sord LIMIT $start , $limit"; 
//loginfo($SQL);
$result = query($SQL);
// we should set the appropriate header information. Do not forget this.
header("Content-type: text/json;charset=utf-8");
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_assoc($result)) {
	$responce->rows[$i]['id']=$row['id'];
	$responce->rows[$i]['cell']=array(
	$row['id']
	,$row['localname']
	,urldecode($row['email'])
	,$row['experience']
	,$row['medal']
	,$row['phone']
	,$row['qq']
	,$row['msn']
	,$row['regtime']
	,$row['usertype']
	,$row['locked']
	);
	$i++;
}
echo jsonEncode($responce);

?>
