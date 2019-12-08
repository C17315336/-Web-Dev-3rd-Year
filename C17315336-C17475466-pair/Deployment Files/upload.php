<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // check for uploaded file
	if(isset($_FILES['upload']))
	{
		// file name, type, size, temporary name
		$file_name = $_FILES['upload']['name'];
		$file_type = $_FILES['upload']['type'];
		$file_tmp_name = $_FILES['upload']['tmp_name'];
		$file_size = $_FILES['upload']['size'];
		$target_dir = "uploads/";
        $id = $_POST["id"];
	
		if(move_uploaded_file($file_tmp_name,$target_dir.$file_name))
		{
            // query
			$sql = "UPDATE users SET url=? WHERE id = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_url, $param_id);
            
            // Set parameters
            $param_url = "$target_dir$file_name";
            $param_id = $id;
            $_SESSION["url"] = $param_url;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
		}
		else
		{
			echo "File can not be uploaded";
		}
	}
        // Close statement
        mysqli_stmt_close($stmt);
    }

    
    // Close connection
    mysqli_close($link);
}
?>
