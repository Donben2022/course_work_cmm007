<?php 

$title = 'View Story';
$conn = connect_db();


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

function checkAccess($userId){
    global $conn;
    $sql = 'SELECT * FROM users WHERE id='.'\''.$userId. '\' '. 'LIMIT 1';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        return $data;
    }else{
        return $data = [];
    }
}

function getSingleStory($storyId){
    global $conn;
    $sql = "SELECT * FROM stories
        INNER JOIN story_categories AS category ON stories.category_id = category.id 
        INNER JOIN locations ON stories.location_id = locations.id 
        WHERE stories.id= $storyId";
 
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
                'user_id' => $row['user_id'],
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