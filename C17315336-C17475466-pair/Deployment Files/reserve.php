<?php
	define('HOST','localhost');
	define('USERNAME', 'root');
	define('PASSWORD','');
	define('DB','webdev2');
	
	$con = mysqli_connect(HOST,USERNAME,PASSWORD,DB);
	
	$per_id = $_GET['id'];
	$isbn = $_GET['isbn'];
	
	$sql = "insert into reserved (per_id, isbn) values ('$per_id','$isbn')";
	
	if(mysqli_query($con, $sql)){
		header("location: catalogue.php");
	}
?>
