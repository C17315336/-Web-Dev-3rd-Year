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
 
// Define variables and initialize with empty values
$firstname = $lastname = $email = $access = $url = "";

$firstname_err = $lastname_err = $email_err = $access_err = $url_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate firstname
    $input_firstname = trim($_POST["firstname"]);
    if(empty($input_firstname)){
        $firstname_err = "Please enter firstname.";     
    } else{
        $firstname = $input_firstname;
    }
    
    // Validate lastname
    $input_lastname = trim($_POST["lastname"]);
    if(empty($input_lastname)){
        $lastname_err = "Please enter the lastname.";     
    } else{
        $lastname = $input_lastname;
    }
    
    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an email.";     
    } else{
        $email = $input_email;
    }
    
    // Validate access
    $input_access = trim($_POST["access"]);
    $access = $input_access;
    
    // Validate url
    $input_url = trim($_POST["url"]);
    if(empty($input_url)){
        $url_err = "Please enter an url.";     
    } else{
        $url = $input_url;
    }
    
    
    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($access_err) && empty($url_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET firstname=?, lastname=?, email=?, access=?, url=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssi", $param_firstname, $param_lastname, $param_email, $param_access, $param_url, $param_id);
            
            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_access = $access;
            $param_url = $url;
            $param_id = $id;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;
            $_SESSION["url"] = $url;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: tables.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $firstname = $row["firstname"];
                    $lastname = $row["lastname"];
                    $email = $row["email"];
                    $access = $row["access"];
                    $url = $row["url"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: 404.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: 404.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="url" content="">
    <meta name="author" content="">

    <title>CE Listings - Update</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <script>
        function printFunc() {
            window.print();
        }

    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-address-book"></i>
                </div>
                <div class="sidebar-brand-text mx-3">CE Listings <sup>Est. 2019</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Book Database
            </div>

            <!-- Nav Item - Catelog -->
            <li class="nav-item">
                <a class="nav-link" href="catalogue.php">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Catalogue &amp; Search</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Personal Area
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="reservered.php">
                    <i class="fas fa-fw fa-bookmark"></i>
                    <span>My Reservations</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($_SESSION["firstname"]); ?> <?php echo htmlspecialchars($_SESSION["lastname"]); ?></span>
                                <img class="img-profile rounded-circle" src="<?php echo htmlspecialchars($_SESSION["url"]); ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php?id=<?php echo htmlspecialchars($_SESSION["id"]); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <?php
                                if ($_SESSION["access"] == '1') {
                                    echo "<a class='dropdown-item' href='tables.php'>
                                    <i class='fas fa-cogs fa-sm fa-fw mr-2 text-gray-400'></i>
                                    Admin
                                    </a>";
                                }   
                                ?>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">User Details</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-lg-12 mb-4">

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">User - <?php echo $firstname; ?> <?php echo $lastname; ?></h6>
                                </div>
                                <div class="card-body">
                                    <p>Please edit the input values and submit to update the record.</p>
                                    <hr>
                                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>"><label for="firstname"><strong>First Name</strong></label><input class="form-control" type="text" value="<?php echo $firstname; ?>" name="firstname"></div>
                                                <span class="small"><?php echo $firstname_err; ?></span>
                                            </div>
                                            <div class="col">
                                                <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>"><label for="lastname"><strong>Last Name</strong></label><input class="form-control" type="text" value="<?php echo $lastname; ?>" name="lastname"></div>
                                                <span class="small"><?php echo $lastname_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>"><label for="email"><strong>Email</strong></label><input class="form-control" type="text" value="<?php echo $email; ?>" name="email"></div>
                                                <span class="small"><?php echo $email_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group <?php echo (!empty($access_err)) ? 'has-error' : ''; ?>">
                                                    <label for="access"><strong>Access</strong></label>
                                                    <select name="access" class="form-control" value="<?php echo $access; ?>">
                                                        <option value="1" <?php
                                                                if($access=='1')
                                                                {
                                                                    echo "selected";
                                                                }
                                                                ?>>Admin</option>
                                                        <option value="0" <?php
                                                                if($access=='0')
                                                                {
                                                                    echo "selected";
                                                                }
                                                                ?>>Normal</option>
                                                    </select>
                                                    <span class="small"><?php echo $access_err; ?></span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group <?php echo (!empty($url_err)) ? 'has-error' : ''; ?>"><label for="url"><strong>URL</strong></label><input class="form-control" type="text" value="<?php echo $url; ?>" name="url"></div>
                                                <span class="small"><?php echo $url_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                            <input type="submit" class="btn btn-primary" value="Save Settings">
                                            <a href="tables.php" class="btn btn-default">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; CE Listings</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
