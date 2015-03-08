<?php 
	
	include('edb.class.php');
	$db = new edb('localhost','root','strip','wedding');

	$name = $_GET["name"];
	$rsvp = $_GET["rsvp"];	
	
	$query = "update `rsvp_items` SET rsvp='".$rsvp."' where name='".$name."'";
	
	echo $query;
	
	$result = $db->q($query);
	
	if($result){
		echo $result;
	}
	
	
?>