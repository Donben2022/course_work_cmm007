<?php 

$title = 'Profile page';
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

function checkAccess1($userId){
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