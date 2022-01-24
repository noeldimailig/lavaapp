<?php
	require_once('class/database.php');

	$con = new database();

  $userid = $_POST['userid'];
  $docid = $_POST['docid'];

  $citation = $con->checkBookmarkToDelete($userid, $docid);

  if($citation['user_id'] == $userid && $citation['doc_id'] == $docid){
  	$db = $con->opencon();
    $sql = 'DELETE FROM bookmarks WHERE user_id = ? AND doc_id = ?';
    $s = $db->prepare($sql);
    $s->execute([$userid, $docid]);
    if($s->rowCount() > 0)  echo "true";
    else echo "false";
  }

 
?>