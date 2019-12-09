<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $email = $dob = $gender = $addr1 = $addr2 = $city = $zip = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_name = trim($_POST["name_text"]);
    $name = $input_name;
    $input_email = trim($_POST["email_text"]);
    $email = $input_email;
    $input_dob = trim($_POST["datepicker"]);
    $dob = $input_dob;
    $input_gender = trim($_POST["select_gender"]);
    $gender = $input_gender;
    $input_addr1 = trim($_POST["addr1_text"]);
    $addr1 = $input_addr1;
    $input_addr2 = trim($_POST["addr2_text"]);
    $addr2 = $input_addr2;
    $input_city = trim($_POST["city_text"]);
    $city = $input_city;
    $input_zip = trim($_POST["zip_text"]);
    $zip = $input_zip;
    
    // Prepare a select statement
        $sql = "SELECT id FROM form WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $input_email);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    echo '<script language="javascript">';
                    echo 'alert("Email already registered, try signing in!")';
                    echo '</script>';
                    header("Refresh:0");
                    exit();
                    
                } else{
                    $email = $input_email;
                }
            } else{
                echo '<script language="javascript">';
                    echo 'alert("Wrong")';
                    echo '</script>';
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    

    // Prepare an insert statement
    $sql = "INSERT INTO form (name, email, dob, gender, addr1, addr2, city, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
     
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssssss", $param_name, $param_email, $param_dob, $param_gender, $param_addr1, $param_addr2, $param_city, $param_zip);
        
        // Set parameters
        $param_name = $name;
        $param_email = $email;
        $param_dob = $dob;
        $param_gender = $gender;
        $param_addr1 = $addr1;
        $param_addr2 = $addr2;
        $param_city = $city;
        $param_zip = $zip;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records created successfully. Redirect to landing page
            echo '<script language="javascript">';
            echo 'alert("Details added successfully")';
            echo '</script>';
            header("Refresh:0");
            exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);


    // Close connection
    mysqli_close($link);

}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Form Validation Exercise</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    <h1>Personal Information</h1>
    <form name="personal_info" id="personal_info" method="post">
        <table align="center" border="0">
            <tbody>
                <tr>
                    <td class="name">
                        Name:
                    </td>
                    <td class="data">
                        <input type="text" name="name_text" id="name_text" width="20" maxlength="40" size="20">
                    </td>
                </tr>
                <tr>
                    <td class="name">
                        E-mail address:
                    </td>
                    <td class="data">
                        <input type="email" name="email_text" id="email_text" width="20" maxlength="40" size="20">
                    </td>
                </tr>
                <tr>
                    <td class="name">
                        Date of Birth (DD/MM/YYYY):
                    </td>
                    <td class="data">
                        <input type="text" name="datepicker" id="datepicker">
                    </td>
                </tr>
                <tr>
                    <td class="name">
                        Gender:
                    </td>
                    <td class="data">
                        <select name="select_gender" id="select_gender">
                            <option value="None"></option>
                            <option value="F">Female</option>
                            <option value="M">Male</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="name">
                        Street address (line 1):
                    </td>
                    <td class="data">
                        <input type="text" name="addr1_text" id="addr1_text" width="6" size="6" maxlength="5">
                    </td>
                </tr>
                <tr>
                    <td class="name">
                        Street address (line 2):
                    </td>
                    <td class="data">
                        <input type="text" name="addr2_text" id="addr2_text" width="6" size="6" maxlength="5">
                    </td>
                </tr>
                <tr>
                    <td class="name">
                        City:
                    </td>
                    <td class="data">
                        <input type="text" name="city_text" id="city_text" width="6" size="6" maxlength="5">
                    </td>
                </tr>
                <tr>
                    <td class="name">
                        ZIP code:
                    </td>
                    <td class="data">
                        <input type="text" name="zip_text" id="zip_text" width="6" size="6" maxlength="5">
                    </td>
                </tr>
                <tr>
                    <td class="name">
                        <input type="button" value="Submit" onclick="validateForm()">
                    </td>
                    <td class="data">
                        <input type="reset" value="Clear">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <div class="success">SUCCESS</div>

    <script>
        function validateForm() {
            var name = document.forms["personal_info"]["name_text"];
            var email = document.forms["personal_info"]["email_text"];
            var dob = document.forms["personal_info"]["datepicker"];
            var addr1 = document.forms["personal_info"]["addr1_text"];
            var addr2 = document.forms["personal_info"]["addr2_text"];
            var city = document.forms["personal_info"]["city_text"];
            var zip = document.forms["personal_info"]["zip_text"];
            var gender = document.forms["personal_info"]["select_gender"];
            var letters = /^[A-Za-z][A-Za-z\s]*$/;

            if (name.value == "") {
                window.alert("Please enter your name.");
                name.focus();
                return false;
            }

            if (!name.value.match(letters)) {
                window.alert("Name should be letters only.");
                name.focus();
                return false;
            }

            if (email.value == "") {
                window.alert("Please enter a valid e-mail address.");
                email.focus();
                return false;
            }

            if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)) {
                window.alert("Please enter a valid email.");
                email.focus();
                return false;
            }

            if (dob.value == "") {
                window.alert("Please enter your Date of Birth.");
                dob.focus();
                return false;
            }


            if (gender.selectedIndex < 1) {
                alert("Please enter your gender.");
                gender.focus();
                return false;
            }

            if (addr1.value == "") {
                window.alert("Please enter your addr1.");
                addr1.focus();
                return false;
            }

            if (addr2.value == "") {
                window.alert("Please enter your addr2.");
                addr2.focus();
                return false;
            }

            if (city.value == "") {
                window.alert("Please enter your city.");
                city.focus();
                return false;
            }

            if (!city.value.match(letters)) {
                window.alert("City should be letters only.");
                city.focus();
                return false;
            }

            if (zip.value == "") {
                window.alert("Please enter your zip.");
                zip.focus();
                return false;
            }

            if (!/[A-za-z]+\s[0-9]+$/.test(zip.value)) {
                window.alert("Please enter a valid ZIP.");
                zip.focus();
                return false;
            }

            document.getElementById('personal_info').submit();


            /*$.ajax({
                type: "GET", //type of method
                url: "add.php", //your page
                data: {
                    name: name,
                    email: email,
                    dob: dob,
                    gender: gender,
                    addr1: addr1,
                    addr2: addr2,
                    city: city,
                    zip: zip
                }, // passing the values
                success: function(res) {
                    var div = $("div");
                    div.animate({
                        height: '100px'
                    }, "slow");
                    div.delay(2000).animate({
                        height: '0px'
                    }, "slow");
                }
            });
*/
            return true;

        }

        function anitmate() {
            var div = $("div");
            div.animate({
                height: '100px'
            }, "slow");
            div.delay(2000).animate({
                height: '0px'
            }, "slow");
        };

        $(function() {
            var d = new Date();
            var year = d.getFullYear();
            d.setFullYear(year);
            $("#datepicker").datepicker({
                changeYear: true,
                changeMonth: true,
                defaultDate: d,
                dateFormat: 'dd/mm/yy',
                maxDate: 0
            });
        });

    </script>
</body>

</html>
