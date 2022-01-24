<?php
	require_once('class/database.php');

	$con = new database();

  $userid = $_POST['userid'];
  $docid = $_POST['docid'];

  $citation = $con->checkBookmark($userid, $docid);

  if($citation == false){
  	$db = $con->opencon();
	  $query = 'INSERT INTO bookmarks (user_id, doc_id) VALUES (?, ?)';
	  $stmt = $db->prepare($query);
	  $stmt->execute([$userid, $docid]);
	  if($stmt->rowCount()>0) echo " Bookmark saved.";
  }
  else echo " Bookmark already exists.";
 
?>