<?php

$title = "Login";

// Define variables and initialize with empty values
$name = $email = $password = $c_password = $gender = "";
$name_err = $email_err =  $password_err = $c_password_err = $gender_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";
    } 
    //validate email
    if(empty(trim($_POST['email']))){
        $email_err = "Please enter your email.";
    }
    else{
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
                    $name = "This email is already in use.";
                } else{                 
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["c_password"]))){
        $c_password_err = "Please confirm password.";     
    } else{
        $c_password = trim($_POST["c_password"]);
        if(empty($password_err) && ($password != $c_password)){
            $c_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($password_err) && empty($c_password_err)){
        $member_id = rand(100, 7);
        $role = 'user';
        $reg_date = date('Y-m-d');
        // Prepare an insert statement
        $sql = "INSERT INTO users (name, password, email, gender, member_id, role, reg_date) VALUES (?, ? , ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            //set parameter
            if(isset($_POST['name'])){
                $param_name = $_POST['name'];
            }else{
                $name_err = 'name is not defined';
            }

            if(isset($_POST['gender'])){
                echo $param_gender = $_POST['gender'];
            }else{
                $gender_err = 'gender is not defined';
            }
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            $param_email = $email;
            $param_member_id = rand(400000, 800000);
            $param_role = 'user'; 
            $param_reg_date =  date('Y-m-d');
            


            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssiss", $param_name, $param_password, $param_email, $param_gender, $param_member_id, $param_role, $param_reg_date);
    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php?member_id=$param_member_id");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}