<?php

$title = "Register";//page title

$link = connect_db();

// Define variables and initialize with empty values
$name = $email = $password = $c_password = "";
$name_err = $email_err =  $password_err = $c_password_err = $genErr = "";

function register($postData = []){
    global $link, $name, $email, $password, $c_password, $name_err, $email_err, $password_err,
    $c_password_err, $genErr;
    
    if(count($postData) < 0){
        return $genErr = 'Please fill in your details';
    }
    // Processing form data when form is submitted
        // Validate username
    if(empty(trim($postData["name"]))){
        return $name_err = "Please enter your name.";
    } 
    //validate email
    if(empty(trim($postData['email']))){
        return $email_err = "Please enter your email.";
    }
    else{

        // Prepare a select statement
        $sql = "SELECT email FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($postData["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already in use.";
                } else{                 
                    $email = trim($postData["email"]);
                }
            } else{
                 $genErr = "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        
    }
        // Validate password
        if(empty(trim($postData["password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($postData["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($postData["password"]);
        }
        
        // Validate confirm password
        if(empty(trim($postData["c_pwd"]))){
            $c_password_err = "Please confirm password.";     
        } else{
            $c_password = trim($postData["c_pwd"]);
            if(empty($password_err) && ($password != $c_password)){
                $c_password_err = "Password did not match.";
            }
        }
        
        // Check input errors before inserting in database
        if(empty($name_err) && empty($password_err) && empty($c_password_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO users (name, password, email, username, link, created_at) VALUES (?, ? , ?, ?, ?, ?)";
            
            if($stmt = mysqli_prepare($link, $sql)){
                //set parameter
                if(isset($postData['name'])){
                    $param_name = $postData['name'];
                }else{
                    $name_err = 'name is not defined';
                }

                $fetchname = explode(" ", $param_name);
                $username = strtolower($fetchname[0].rand(100, 999));

                $linkUrl = $_SERVER['HTTP_ORIGIN'].'?page=user_dashboard&access='.$username;

                $param_password = password_hash($password, PASSWORD_DEFAULT); 
                $param_email = $email;
                $param_username = $username;
                $param_link = $linkUrl;
                $param_reg_date =  date('Y-m-d', strtotime('now'));
                


                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssss", $param_name, $param_password, $param_email, $param_username, $param_link, $param_reg_date);


        
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    header("location: $linkUrl");
                } else{
                    return $genErr =  "Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Close connection
        mysqli_close($link);
}






