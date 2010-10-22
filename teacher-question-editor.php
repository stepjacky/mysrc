<?php
    
    $url = "question-edit.php?id=".$_GET['id'];
	header ("HTTP/1.1 303 See Other");
	header ("Location: $url");
	exit(0);
?>