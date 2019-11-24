<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = $confirm_password = $firstname = $lastname = "";
$email_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already registered try signing in?";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Validate firstname
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter a firstname.";     
    } else{
        $firstname = trim($_POST["firstname"]);
    }
    
    // Validate lastname
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter a lastname.";     
    } else{
        $lastname = trim($_POST["lastname"]);
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($firstname_err) && empty($lastname_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (email, password, firstname, lastname) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_email, $param_password, $param_firstname, $param_lastname);
            
            // Set parameters
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group row <?php echo (!empty($firstname_err) || !empty($lastname_err)) ? 'has-error' : ''; ?>">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>">
                    <span class="small"><?php echo $firstname_err; ?></span>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>">
                    <span class="small"><?php echo $lastname_err; ?></span>
                  </div>
                </div>
                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                  <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" value="<?php echo $email; ?>">
                    <span class="small"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group row <?php echo (!empty($password_err) || !empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password" value="<?php echo $password; ?>">
                    <span class="small"><?php echo $password_err; ?></span>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="confirm_password" placeholder="Repeat Password" value="<?php echo $confirm_password; ?>">
                    <span class="small"><?php echo $confirm_password_err; ?></span>
                  </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Register Account">
                </div>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.php">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
