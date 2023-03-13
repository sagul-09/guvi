<?php

$conn = mysqli_connect("localhost","root","","guvi");        //connecting the database
if(!$conn)
{
    echo "Database not connected" . mysqli_connect_error();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $query = "SELECT * FROM users WHERE email='$_POST[email]'";
    $result = $db->query($query);
    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if($user["password"] == $_POST["password"]) {
            echo json_encode(["status" => true, "message" => "logged in successfully", "user" => $user]);
        }
        else {
            echo json_encode(["status" => false, "message" => "Incorrect password, retry again", "user" => null]);
        }
    }
    else {
        echo json_encode(["status" => false, "message" => "user doesn't exist check your email", "user" => null]);
    }
}