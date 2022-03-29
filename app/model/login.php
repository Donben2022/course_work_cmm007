<?php

$title = "Login";

// Define variables and initialize with empty values
$email = $password =
 $error = $success = "";
 $conn = connect_db();

function login($postData = []){
    global $email,$password,$error,$success, $conn;
    if(count($postData) < 0){
        return $error = 'Please fill in your details';
    }

    $email = $postData['email'];
    $password = $postData['password'];
   
    // Prepare a select statement
    $sql = "SELECT * FROM users WHERE email ='$email'";
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){

        $data = [];

        while($row = mysqli_fetch_assoc($result)) {

            $formatData = [
                'id' => $row['id'],
                'name' => $row['name'],
                'username' => $row['username'],
                'email' => $row['email'],
                'role' => $row['role'],
                'image' => $row['image'],
            ];

            array_push($data, $formatData);
        }
        
        header("location: ?page=admin_dashboard&access=".$data[0]['username']);

    }else{
        return $error = 'incorrect email or password';
    }
            // Close connection
        mysqli_close($conn);

 }
