<?php
	define('HOST','localhost');
	define('USERNAME', 'root');
	define('PASSWORD','');
	define('DB','webdev2');
	
	$con = mysqli_connect(HOST,USERNAME,PASSWORD,DB);
	
	$per_id = $_GET['id'];
	$isbn = $_GET['isbn'];
	
    $sql = "DELETE FROM reserved WHERE per_id = '$per_id' AND isbn = '$isbn'";
	
	if(mysqli_query($con, $sql)){
		header("location: reservered.php");
	}
?>
