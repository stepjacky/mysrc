<?php
if(!isset($_GET['email']))exit(0);
$email = urlencode($_GET['email']);

// DATEDIFF(curdate(),urt.start_time)<=14 and

$SQLCOUNT = "select 
count(urt.question_id) ids 
from user_result urt
left join chapter c left join subject s on c.subject_id=s.id  on urt.chapter_id = c.id
left join user u on urt.email=u.email
where  urt.email='$email'";




require_once "included/database.php";
$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
if(!$page) $page=0;
if(!$limit) $limit=10;
if(!$sidx) $sidx =1; 
$count = getFieldValue($SQLCOUNT); 
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
 
$SQL = "select 
u.localname username, 
urt.start_time  time, 
c.name  chapter ,
s.name subject  ,
urt.question_id question , 
urt.correct correct 
from user_result urt
left join chapter c left join subject s on c.subject_id=s.id  on urt.chapter_id = c.id
left join user u on urt.email=u.email
where urt.email='$email' ORDER BY urt.start_time desc LIMIT $start , $limit";
// the actual query for the grid data 
$result = query($SQL);
// we should set the appropriate header information. Do not forget this.
header("Content-type: text/json;charset=utf-8");
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_assoc($result)) {
    $responce->rows[$i]['id']=$row['question'];
    $responce->rows[$i]['cell']=array(
      $row['username'],
      $row['time'],
      $row['subject'],
      $row['chapter'],
      $row['question'],
      $row['correct']=='y'?'正确':'错误'
      );
    $i++;
}        
echo jsonEncode($responce);
?>