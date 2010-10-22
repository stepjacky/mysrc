<?php
require_once "included/database.php";
$tableName='question';
//
$searchsql="";
if(isset($_POST['oper']))
{
	switch($_POST['oper'])
	{
		case 'add':
			break;
		case 'edit':
			break;
		case 'del':
			doDeleteQst();
			exit(0);
		case 'locked':
			doLocked('y');
			exit(0);
		case 'unlocked':
			doLocked('n');
			exit(0);
		default:;
	}
}

function doLocked($locked){
	$SQL=array();
	foreach($_POST['qid'] as $qid){
		$SQL[]=strutSQLUpdator('question',array('locked'=>$locked),'id='.$qid);
	}
    queryWithTransaction($SQL);
}
function doDeleteQst(){
	$SQL=array();
	foreach($_POST['qsts'] as $qid){
		$SQL[] = strutSQLDeletor('answer','question_id='.$qid);
		$SQL[] = strutSQLDeletor('question','id='.$qid);
	
	    
	}
	
	queryWithTransaction($SQL);
	
	
}
$field ='';
if($_GET['_search']=='true'){
	
	if(isset($_GET['searchField']) && isset($_GET['searchString']) && isset($_GET['searchOper']))
	{
		
		$field  = $_GET['searchField'];
		if($field=="id")$field='q.id';
	    $opr    = convertOpr($_GET['searchOper']);
	    $svalue = $_GET['searchString'];
	    if(stripos($opr,"LIKE")==false && stripos($opr,"IN")==false){
	    	$searchsql="and ".$field.$opr."'".$svalue."'";	    	
	    }else if(stripos($opr,"LIKE")!=false){
	    	$searchsql="and ".$field." ".$opr." '%".$svalue."%'";	 
	    }else if(stripos($opr,"IN")){
	    	$searchsql="and ".$field." ".$opr." ('".$svalue."')";
	    }
	   
	    
	}
    //loginfo($searchsql);
    	
}




//
$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
if(!$page) $page=0;
if(!$limit) $limit=10;
if(!$sidx) $sidx ="id"; 

$count = getCount($tableName); 

if($searchsql!=""){
  $tname = $tableName;
  if(stripos($field,".")!=false){	
    $alias = substr($field,0,stripos($field,"."));
    $tname = 	$tableName." ".$alias;  
  }
  $count = getCountByWhere($tname,substr($searchsql,4));
}

if(isset($_GET['myqst'])){
  $searchsql.=" and  q.owner='".urlencode($_GET['myqst'])."'\t";
  $count = getCountByWhere($tableName." q ","owner='".urlencode($_GET['myqst'])."'");
}// calculate the total pages for the query 
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
$SQL = "SELECT q.id id
,q.description 
,g.name gname
,s.name sname
,v.name vname
,c.name cname
,t.name tname
,q.tag  tag
,u.localname owner 
,q.locked locked
FROM $tableName q,
subject s,
qtype t,
chapter c,
bookversion v,
grade g,
user u
WHERE s.id=q.qst_subject_id
AND c.id = q.qst_chapter_id
AND v.id = q.qst_bvser_id
AND g.id = q.qst_grade_id
AND t.id = q.qst_type_id
AND u.email = q.owner $searchsql
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
     $row['id']
    ,$row['tname']
    ,$row['cname']
    ,$row['owner']
    ,strip_tags($row['tag'],"<img></img>")   
    ,$row['gname']
    ,$row['sname']
    ,$row['vname']       
    ,$row['locked']=='y'?"是":"否"
    ,strip_tags($row['description'],"<img></img>")
    );
    $i++;
}        
echo jsonEncode($responce);

?>
