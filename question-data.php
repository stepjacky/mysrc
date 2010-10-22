<?
require_once "included/database.php";
switch($_POST['action']){
	case "create":echo doCreate();break;
	//case "retrieve":doRetrieve();break;
	case "update":doUpdate();break;
	case "delete":doDelete();break;
	case "pick":echo doPick();break;
	case "edtTime":echo doEditTime();break;
	case "chtxp" :echo doGetXpByChapter();break;
	case "qupdate": echo doUpdateQst();break;
	case "qsterror":doAddQstError();break;
	case "chtdtl": echo doGetChtDetail();break;
	default:;

}
function getTable(){return "question";};

function doUpdate(){
	$SQL = array();   
	$lastId = $_POST['id'];
	$SQL[] = strutSQLUpdator(getTable(),array('remark'=>$_POST['remark'],'description'=>$_POST['description']),'id='.$lastId);
	$SQL[] = strutSQLUpdator("answer",array("name"=>$_POST["a"],"tip"=>"a"),"question_id=$lastId and tip='a'");
	$SQL[] = strutSQLUpdator("answer",array("name"=>$_POST["b"],"tip"=>"b"),"question_id=$lastId and tip='b'");
	$SQL[] = strutSQLUpdator("answer",array("name"=>$_POST["c"],"tip"=>"c"),"question_id=$lastId and tip='c'");
	$SQL[] = strutSQLUpdator("answer",array("name"=>$_POST["d"],"tip"=>"d"),"question_id=$lastId and tip='d'"); 
      
	foreach($_POST["right"] as $right){
		$SQL[] = strutSQLUpdator("answer",array("iscorrect"=>"y"),"tip='$right' and question_id=$lastId");
	}
	foreach($_POST['wrong'] as $wrong){
		$SQL[] = strutSQLUpdator("answer",array("iscorrect"=>"n"),"tip='$wrong' and question_id=$lastId");
	}
    queryWithTransaction($SQL);
    
}

function doCreate(){
	if(!isset($_POST["right"])){
		return "没有设置正确答案";

	}
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'mydb';
	$link_id = @mysql_connect($dbhost, $dbuser, $dbpass) or exit(mysql_error());
	mysql_query("SET NAMES 'UTF8'");
	mysql_query("SET CHARACTER_SET 'UTF8'");
	mysql_query("SET CHARACTER_SET_RESULTS 'UTF8'");
	mysql_select_db($dbname, $link_id) or exit(mysql_error());
	/* 创建事务 */
	mysql_query('START TRANSACTION', $link_id) or exit(mysql_error());
	$values = array("description"=>$_POST["description"],
   	      "qst_grade_id"=>$_POST["qst_grade_id"],
   	      "qst_subject_id"=>$_POST["qst_subject_id"],
   	      "qst_bvser_id"=>$_POST["qst_bvser_id"],
   	      "qst_type_id"=>$_POST["qst_type_id"],
   	      "qst_chapter_id"=>$_POST["qst_chapter_id"],
	      "remark"=>$_POST['remark'],
	      "owner"=>urlencode($_POST['owner']),
	      "semester"=>$_POST['semester'],
          "difficulty"=>$_POST['diffculity'] 
	)  ;
	$sql = strutSQLInsertor(getTable(),$values);
	mysql_query($sql, $link_id) or exit(mysql_error());
	//如果成功执行上一条语句
	$lastId = getLastInsertId();
	$SQL[] = strutSQLInsertor("answer",array("name"=>$_POST["a"],"tip"=>"a","question_id"=>$lastId));
	$SQL[] = strutSQLInsertor("answer",array("name"=>$_POST["b"],"tip"=>"b","question_id"=>$lastId));
	$SQL[] = strutSQLInsertor("answer",array("name"=>$_POST["c"],"tip"=>"c","question_id"=>$lastId));
	$SQL[] = strutSQLInsertor("answer",array("name"=>$_POST["d"],"tip"=>"d","question_id"=>$lastId));
	foreach($_POST["right"] as $right){
		$SQL[] = strutSQLUpdator("answer",array("iscorrect"=>"y"),"tip='$right' and question_id=$lastId");
	}

	for($i = 0; $i < count($SQL); $i++) {
		if(! mysql_query($SQL[$i], $link_id)) {
			/*
			 * 按理每次更新查询都应该进行判断，
			 * 若 SQL 执行出错，回卷本次事务操作。
			 */
			$err_msg = mysql_error();
			mysql_query('ROLLBACK', $link_id) or exit(mysql_error());
			return "执行有错误在 [$SQL[$i]] : <br/> 信息: $err_msg <br/>事务被回滚";
			exit(0);
		}
	}
	mysql_query('COMMIT', $link_id) or exit(mysql_error());
	close();
	return "添加成功!";

}

function doDelete(){

}
function doPick(){
	$start = $_POST['start'];
	$gid=$_POST['gid'];
	$sid=$_POST['sid'];
	$cid=$_POST['cid'];
	$bid=$_POST['bid'];
	$smid=$_POST['smid'];

	//获取问题数据
	$sql= "select q.id qid,
                  q.description descn, 
                  u.localname uname,
                  q.owner owner, 
                  q.remark remark,
                  q.difficulty difficulty,
                  q.reputation reputation,
                  qt.id tid
                                    
           from   question q,
                  user u,
                  qtype qt
           where  u.email=q.owner 
                  and q.qst_type_id = qt.id
                  and q.qst_grade_id=$gid
                  and q.qst_subject_id=$sid
                  and q.qst_chapter_id=$cid
                  and q.qst_bvser_id=$bid
                  and q.semester='$smid'
                  and q.locked='n'
                  limit $start ,100";
	//loginfo($sql);
	$result = query($sql);
	$qids = array();
	$question = '';
	$i=0;
	while($row=mysql_fetch_assoc($result)){
		$qids[] = $row['qid'];
		$question->rows[$row['qid']]['qid']=$row['qid'];
		$question->rows[$row['qid']]['cell']=array(
            'desc'  =>$row['descn'],
            'uname' =>$row['uname'],
            'email' =>$row['owner'],
            'remark'=>$row['remark'],
		    'reputation'=>$row['reputation'],
		    'difficulty'=>$row['difficulty']
		);
		$i++;
	}

	for($i = 0; $i < count($qids); $i++) {
		$qid = $qids[$i];
		//获取答案数据
		$sql2 = "select a.id aid,
                       a.name aname ,
                       a.tip atip
                from   answer a
                where  a.question_id = $qid";
			
		$result = query($sql2);
		$answer=array();
		$j=0;
		while($row = mysql_fetch_assoc($result)){
			$answer[$j++]=array('key'=>$row['atip'],'vname'=>$row['aname']);

		}
		$question->rows[$qid]['answers'] = $answer;

		//获取正确答案数据
		$sql3 = "select a.id   aid ,
                       a.tip  atip,
                       a.name aname
                      
                from   answer   a,
                       question q
                    
                where  a.question_id=$qid
                       and q.id=a.question_id
                       and a.iscorrect='y'";
		$result = query($sql3);
		$ranswer = array();
		$j=0;
		while($row = mysql_fetch_assoc($result)){
			$ranswer[$j++] = $row['atip'];

		}
		$question->rows[$qid]['correct'] = $ranswer;

	}

	$qjson = jsonEncode($question);
	return $qjson;


}
/**
 * @desc
 * 章节五项
 * 勋章,能力值,做过的题目数,正确率,做题平均时间
 * @return
 * 
 */

function doGetChtDetail(){
    $tmail     = urlencode($_POST['email']);
    $chapters  = $_POST['chapter'];
    $response=array();
    $i=0;
    foreach($chapters as $cid){
       $cdata='';
      
       $cname = getFieldValue("select name from chapter where id=$cid");	
        $cdata->name=$cname;
    	// 本章的勋章和积分
       $sql = "select xp,medal from userexp where email='$tmail' and chapter_id=$cid";
       $result = query($sql);
       $xp=0;
       $medal=0;
       while($row=mysql_fetch_assoc($result)){
       	  $xp = $row['xp'];
       	  $medal = $row['medal'];
       }
       $cdata->xp=$xp;
       $cdata->medal = $medal;
       //本章做过的题目的总数
       $qcount=getFieldValue("select count(question_id) from user_result where email='$tmail' and chapter_id=$cid");
       $cdata->qcount=$qcount;
       //本章做过的正确的题目总数
       $rcount = getFieldValue("select count(question_id) from user_result where email='$tmail' and chapter_id=$cid and correct='y'");
       $cdata->rrate = ($qcount!=0?sprintf("%.1f",$rcount/$qcount):'0')." %";
       //本章节做过的题目的平均时间
       $avgTime =getFieldValue("select avg(avgtime) from question where id in (
select question_id from user_result where email='$tmail' and chapter_id=$cid
)");
       $avgTime=sprintf("%.2f s",$avgTime);
       $cdata->avgTime = $avgTime;
       $response[$i] = $cdata;
       $i++;
    
    
    }//end of foreach
    return jsonEncode($response);
}
/**
 * 章节单项
 * @return  
 * 
 */
function doGetXpByChapter(){
	
	$gid  = $_POST['gid'];
	$sid  = $_POST['sid'];
	$cid  = $_POST['cid'];
	$bid  = $_POST['bid'];
	$smid = $_POST['smid'];
	$email= urlencode($_POST['email']);
	
	$sql= "select count(*) as cot                  
           from   question q,
                  user u,
                  qtype qt
           where  u.email=q.owner 
                  and q.qst_type_id = qt.id
                  and q.qst_grade_id=$gid
                  and q.qst_subject_id=$sid
                  and q.qst_chapter_id=$cid
                  and q.qst_bvser_id=$bid
                  and q.semester='$smid'";
	
    $count = getFieldValue($sql);
	
	$xp=0;
	$me=0;
	$sql = "select xp ,medal from userexp where email='$email' and chapter_id=$cid";
	//loginfo("获取本章经验值和勋章: $sql");
	$result = query($sql);
    while($row = mysql_fetch_assoc($result)){
    	$xp = $row['xp'];
    	$me = $row['medal'];
    }	
    
    
    
	return "{xp:$xp,medal:$me,count:$count}";
}
/**
 * @desc
 * 每道题做完如果提交的话<span style='color:red;font-size:13px;font-weight:bold'>
 * 就会做如下更新,首先,更新该题的做题时间
 * 其次计算该题的得分,能力值,而且根据该题
 * 所在章节,依次把题目自身信息更新到user
 * _result表里,把题目算得的经验值更新
 * 到useexp表里头,而对userexp表要
 * 根据章节之间的关系向上迭代更新</span>
 * @return 没有输出
 * */
function doEditTime(){
	$email = urlencode($_POST['email']);
	$qid = $_POST['qid'];
	$where  = "question_id='$qid' and email='$email'";
	$count = getCountByWhere("user_result",$where);
	if($count==0){
		create("user_result",array("question_id"=>$_POST['qid'],
                                "email"=>$email,
                                "correct"=>$_POST['correct'],
		                        "difficulty"=>$_POST['dft'],
		                        "reputation"=>$_POST['rep'],
		                        "eV"=>$_POST['ev'],
		                        "start_time"=>$_POST['startTime'],
		                        "end_time"=>$_POST['endTime'],
		                        "chapter_id"=>$_POST['cid']		                          
			
		));
		//计算本题的能力值
		$xp    = $_POST['ev'];
		$medal = $_POST['medal'];
		$cid   = $_POST['cid'];
		$qxp = 0;
		
		
		$ccount = getCountByWhere("userexp","email='$email' and chapter_id=$cid");
		
		if($ccount==0){
			create("userexp",array('email'=>$email,'chapter_id'=>$cid));
		}else{
			$xp += getExpValue($cid,$email);
			$medal+=getMedalValue($cid,$email);
		}
		updateExpvalue($cid,$xp,$medal,$email);
		$pid = getParentId($cid);		
		//迭代更新父能力值
		while($pid!=-1){
			$xp    = getBothExpValue($cid,$pid,$email);
			$medal = getBothMedalValue($cid,$pid,$email);
			updateExpvalue($pid,$xp,$medal,$email);
			$cid = $pid;
			$pid = getParentId($cid);
		}

		//更新用户的能力值
		$result = query("select sum(q.difficulty*r.ev) uexp
                         from question q,user_result r  
                         where r.email='$email' and q.id=r.question_id");
		while($row = mysql_fetch_assoc($result)){
			$qxp = sprintf("%.1f",$row['uexp']);
		}

		update("user",array("experience"=>$qxp),"email='$email'");
		//更新用户在线时间
		//不需要了
			
	}
}

function updateExpvalue($cid,$xp,$medal,$email){
	update("userexp",array("xp"=>$xp,"medal"=>$medal),"chapter_id=$cid and email='$email'");

}

function getParentId($cid){
	$pid=-1;
	$result = query("select parent_id pid from chapter where id=$cid");
	while($row = mysql_fetch_assoc($result)){
		$pid = $row['pid'];
	}
	return $pid;

}

function getBothExpValue($cid,$pid,$mail){

	$xp=0;
	$result = query("select sum(xp) xp from userexp where chapter_id in ('$cid','$pid') and email='$email'");
	while($row=mysql_fetch_assoc($result)){
		$xp = $row['xp'];
		
	}
	return $xp;
}

function getBothMedalValue($cid,$pid,$mail){

	$xp=0;
	$result = query("select sum(medal) xp from userexp where chapter_id in ('$cid','$pid') and email='$email'");
	while($row=mysql_fetch_assoc($result)){
		$xp = $row['xp'];
		
	}
	return $xp;
}


function getExpValue($cid,$email){

	$xp=0;
	$result = query("select xp from userexp where chapter_id=$cid and email='$email'");
	while($row=mysql_fetch_assoc($result)){
		$xp = $row['xp'];
		
	}
	return $xp;
}


//勋章值更新

function getMedalValue($cid,$email){

	$xp=0;
	$result = query("select medal from userexp where chapter_id=$cid and email='$email'");
	while($row=mysql_fetch_assoc($result)){
		$xp = $row['medal'];
		
	}
	return $xp;
}

/**
 * 系统功能
 * 
 * */
function doUpdateQst(){
	//题目难度
	$sql = "select question_id qid ,avg(difficulty) davg ,avg(reputation) ravg ,avg((end_time-start_time)/60) tavg from user_result  group by qid" ;
	$result = query($sql);
	$format="%.1f";
	while($row = mysql_fetch_assoc($result)){
	    $qid  = $row['qid'];
	    $davg = sprintf($format,$row['davg']);
	    $ravg = sprintf($format,$row['ravg']);
	    $tavg =sprintf($format,$row['tavg']);
	    update("question",array('difficulty'=>$davg,"reputation"=>$ravg,"avgtime"=>$tavg),"id=$qid");	    	
	}
	echo "更新题目难度,好评度,平均时间完成!";
	
	
}

/**
 * 题目出错处理
 */
function doAddQstError(){
	create("qstreporter",array("email"=>$_POST['email'],"question_id"=>$_POST['qid'],"reason"=>$_POST['reason']));
	
}
?>
