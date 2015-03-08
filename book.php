<?php 
	
	include('edb.class.php');
	$db = new edb('localhost','root','strip','wedding');

	$id = $_GET["id"];
	$book = $_GET["book"];	
	
	$query = "update `rsvp` SET want_to_book='".$book."' where id='".$id."'";
	
	echo $query;
	
	$result = $db->q($query);
	
	if($result){
		echo $result;
	}
	
	
?>