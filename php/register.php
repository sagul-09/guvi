<?php

$conn = mysqli_connect("localhost","root","","guvi");        //connecting the database
if(!$conn)
{
    echo "Database not connected" . mysqli_connect_error();
}

if($_SERVER['REQUEST_METHOD'] == "POST") {

    // $query = "INSERT INTO users(first_name, last_name, dob, age, contact_number, email, , password) VALUES ('$_POST[first_name]', '$_POST[last_name]', '$_POST[dob]', '$_POST[age]', '$_POST[contact_number]', '$_POST[email]', '$_POST[password]')";

    // if ($db->query($query) === TRUE) {
    //     echo json_encode(["status" => true, "message" => "User registered successfully"]);
    // }
    // else {
    //     echo json_encode(["status" => false, "message" => "Something Went Wrong!"]);
    // }

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

     // Check name length
    if (strlen($first_name) < 2 || strlen($last_name) < 2) {
        echo "First and last name must be at least 2 characters long.<br>";
    }

    // Check name character type
    if (!ctype_alpha($first_name) || !ctype_alpha($last_name)) {
     echo "First and last name must only contain alphabetic characters.<br>";
    }
    // Check email address using filter validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.<br>";
    }

    // Check email address using regular expression
    if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        echo "Invalid email address.<br>";
    }
    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.<br>";
    }

    // Check password strength
    if (!preg_match("#[A-Z]+#", $password) || !preg_match("#[a-z]+#", $password) || !preg_match("#[0-9]+#", $password) || !preg_match("#\W+#", $password)) {
        echo "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.<br>";
    }

    // Check if password matches confirmed password
    if ($password != $confirmed_password) {
        echo "Passwords do not match.<br>";
    }
   


    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
                                $stmt->bind_param("ssss", $_POST['first_name'] , $_POST['last_name'], $_POST['email'], $_POST['password']);
                                $stmt->execute();
}

?>