<?php 

$title = 'Stories';

$conn = connect_db();

$link = $conn;

$title = $categoryId = $locationId = $story = $userId = $image = $genErr = "";


$error = $success = $message = '';

function createStory($postData = [])
{
    global $link, $title,$categoryId,$locationId,$story,$userId,$image,$genErr,$error,$success,$message;
    
    if(count($postData) < 0){
        return $error = 'Please fill in your details';
    }
    // Processing form data when form is submitted
    $title = $postData['title'];
    $categoryId = $postData['category_id'];
    $locationId = $postData['location_id'];
    $story = $postData['story'];
    $userId = $postData['user_id'];
    $image = $postData['image'];
        
        // Check input errors before inserting in database
        if(!empty($title) && !empty($categoryId) && !empty($locationId) && !empty($story) 
        && !empty($userId)){
          
            // Prepare an insert statement
            $sql = "INSERT INTO stories (title, category_id, location_id, story, user_id, image, slug, created_at) VALUES (?, ? , ?, ?, ?, ?, ?,?)";
            
            if($stmt = mysqli_prepare($link, $sql)){
                //set parameter
                if(!empty(isset($image))){
                    $target_dir = "uploads/";
                    $imageName = basename($image["name"]);
                    $target_file = $target_dir . basename($image["name"]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    // upload image
                    $path = $target_file;
                    move_uploaded_file($image["tmp_name"], $target_file);
                }else{
                    $path = null;
                }
                $titleExp = explode(' ', $title);
                $slug = implode("-",$titleExp);
                $reg_date =  date('Y-m-d', strtotime('now'));
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssssss", $title, $categoryId, $locationId, $story, $userId,$path, $slug, $reg_date);


        
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    return $success = "Story created successfully";
                } else{
                    return $error =  "Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Close connection
        mysqli_close($link);
}

function checkAccess($username){
    global $conn;
    $sql = 'SELECT * FROM users WHERE username='.'\''.$username. '\' '. 'LIMIT 1';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        return $data;
    }else{
        return $data = [];
    }
}

function getstoriesFull($userId){
    global $conn;

    $sql = ' SELECT * FROM stories 
        INNER JOIN story_categories AS category ON stories.category_id = category.id 
        INNER JOIN locations ON stories.location_id = locations.id 
        ORDER BY stories.id DESC ';

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){

        $data = [];

        while($row = mysqli_fetch_assoc($result)) {

            $formatData = [
                'id' => $row['id'],
                'title' => $row['title'],
                'category_id' => $row['category_id'],
                'location_id' => $row['category_id'],
                'story' => $row['story'],
                'slug' => $row['slug'],
                'image' => $row['image'],
                'status' => $row['status'],
                'reg_date' => $row['created_at'],
                'cat_name' => $row['name'],
                'loca_country' => $row['country'],
                'address' => $row['address'],
            ];

            array_push($data, $formatData);
        }

        return $data;

    }else{
        return $data = [];
    }

}

function getSingleStory($storyId){
    global $conn;
    $sql = "SELECT * FROM stories WHERE id=$storyId ";
    // return $sql;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $data = [];
        while($row = mysqli_fetch_assoc($result)) {
            $formatData = [
                'id' => $row['id'],
                'title' => $row['title'],
                'category_id' => $row['category_id'],
                'location_id' => $row['category_id'],
                'story' => $row['story'],
                'slug' => $row['slug'],
                'image' => $row['slug'],
                'status' => $row['status'],
                'reg_date' => $row['created_at'],
            ];

            array_push($data, $formatData);

        }
        return $data;
    }else{
        return $data = [];
    }
}

function getStories($userId){
    global $conn;
    $sql = 'SELECT * FROM stories WHERE user_id='.$userId;
    // return $sql;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $data = [];
        while($row = mysqli_fetch_assoc($result)) {
            $formatData = [
                'id' => $row['id'],
                'title' => $row['title'],
                'category_id' => $row['category_id'],
                'location_id' => $row['category_id'],
                'story' => $row['story'],
                'slug' => $row['slug'],
                'image' => $row['slug'],
                'status' => $row['status'],
                'reg_date' => $row['created_at'],
            ];

            array_push($data, $formatData);

        }
        return $data;
    }else{
        return $data = [];
    }
}

function getstorybylocation($locationId){
    global $conn;
    $sql = 'SELECT * FROM stories WHERE location_id='.$locationId;
    // return $sql;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $data = [];
        while($row = mysqli_fetch_assoc($result)) {
            $formatData = [
                'id' => $row['id'],
                'title' => $row['title'],
                'category_id' => $row['category_id'],
                'location_id' => $row['location_id'],
                'story' => $row['story'],
                'slug' => $row['slug'],
                'image' => $row['slug'],
                'status' => $row['status'],
                'reg_date' => $row['created_at'],
            ];

            array_push($data, $formatData);

        }
        return $data;
    }else{
        return $data = [];
    }
}

function getstorybyCategory($categoryId){
    global $conn;

    $sql = 'SELECT * FROM stories WHERE location_id='.$categoryId;
    // return $sql;
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $data = [];
        while($row = mysqli_fetch_assoc($result)) {

            $formatData = [
                'id' => $row['id'],
                'title' => $row['title'],
                'category_id' => $row['category_id'],
                'location_id' => $row['location_id'],
                'story' => $row['story'],
                'slug' => $row['slug'],
                'image' => $row['slug'],
                'status' => $row['status'],
                'reg_date' => $row['created_at'],
            ];

            array_push($data, $formatData);

        }
        return $data;
    }else{
        return $data = [];
    }
}

function getAllCategories(){
    global $conn;
    $sql = 'SELECT * FROM story_categories';
    // return $sql;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $data = [];
        while($row = mysqli_fetch_assoc($result)) {
            $formatData = [
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'slug' => $row['slug'],
                'created_at' => $row['created_at'],
            ];

            array_push($data, $formatData);

        }
        return $data;
    }else{
        return $data = [];
    }
}

function getSingleCategory($catId){
    
}

function getAllLocations(){
    global $conn;
    $sql = 'SELECT * FROM locations';
    // return $sql;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $data = [];
        while($row = mysqli_fetch_assoc($result)) {
            $formatData = [
                'id' => $row['id'],
                'country' => $row['country'],
                'city' => $row['city'],
                'state' => $row['state'],
                'created_at' => $row['created_at'],
            ];

            array_push($data, $formatData);

        }
        return $data;
    }else{
        return $data = [];
    }
}



function getSingleLocations($locateId){

}

