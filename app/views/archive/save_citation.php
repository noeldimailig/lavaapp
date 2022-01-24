<?php
	require_once('class/database.php');

	$con = new database();

  $userid = $_POST['userid'];
  $docid = $_POST['docid'];
  $cited = $_POST['cited'];

  $citation = $con->checkCitation($userid, $docid);

  if($citation == false && $cited == 1){
  	$db = $con->opencon();
	  $query = 'INSERT INTO citations (user_id, doc_id, cited) VALUES (?, ?, ?)';
	  $stmt = $db->prepare($query);
	  $stmt->execute([$userid, $docid, $cited]);
	  if($stmt->rowCount()>0) echo "Citation saved.";
  }
  else echo "Citation already exists.";
 
?>