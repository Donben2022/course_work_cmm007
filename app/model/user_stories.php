<?php 

$title = 'Stories';

$conn = connect_db();

$error = $success = $message = '';

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
    $sql = 'SELECT * FROM stories WHERE user_id='.$userId.
    'INNER JOIN story_categories ON stories.category_id=story_categories.id
    INNER JOIN locations ON stories.location_id=locations.id';

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
                // 'reg_date' => $row['created_at'],
                // 'reg_date' => $row['created_at'],
                // 'reg_date' => $row['created_at'],
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

