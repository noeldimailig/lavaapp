<?php
	require_once('class/database.php');

	$con = new database();

  $userid = $_POST['userid'];
  $docid = $_POST['docid'];

  $citation = $con->checkCitationToDelete($userid, $docid);
  $cited = (int)$citation['cited'];
  $previd = $citation['id'];


  if($citation['user_id'] == $userid && $citation['doc_id'] == $docid){
  	$db = $con->opencon();
	  $query = 'INSERT INTO citationscopy (doc_id, cited) VALUES (?, ?)';
	  $stmt = $db->prepare($query);
	  $stmt->execute([$docid, $cited]);
    $stmt->fetch();

	  if($stmt->rowCount() > 0){
      echo $con->copyCitation($userid, $docid);
    }
  }

 
?>