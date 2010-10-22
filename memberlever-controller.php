<?php
require_once "included/database.php";
$tableName='memberlever';
//
$sqlconditions='';
if (isset($_POST['oper']))
{
	switch($_POST['oper'])
	{
		case 'add':
			$name=$_POST['name'];
			create($tableName,array('name'=>$name));
			break;
		case 'edit':
			$id=$_POST['id'];
			$name=$_POST['name'];
			update($tableName,array('name'=>$name),'id='.$id);
			break;
		case 'del':
			$id=$_POST['id'];
			remove($tableName,array('id'=>$id));
			break;
	}
}
if ($_GET['_search']=='true')
{
	$SQL="\t where" ;
	$mark=false;
	if (isset($_GET['id']))
	{
		$SQL=$SQL . "\t id=" .$_GET['id'] . "\t and";
		$mark=true;
	}
	if(isset($_GET['name']))
	{
		$SQL=$SQL . "\t name like '%" .$_GET['name'] . "%' and";
		$mark=true;
	}
	if ($mark==true)
	$sqlconditions=substr($SQL,0,strlen($SQL)-3);
	//echo $sqlconditions;
}
//
$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
if(!$page) $page=0;
if(!$limit) $limit=10;
if(!$sidx) $sidx =1;
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
id,
name 
FROM $tableName $sqlconditions 
ORDER BY $sidx $sord LIMIT $start , $limit"; 
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
	$row['id'],
	$row['name']
	);
	$i++;
}
echo jsonEncode($responce);
?>
