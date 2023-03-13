<?php

$conn = mysqli_connect("localhost","root","","guvi");        //connecting the database
if(!$conn)
{
    echo "Database not connected" . mysqli_connect_error();
}

if($_SERVER['REQUEST_METHOD'] == "POST") {


     $dob = $_POST['dob'];
     $age = $_POST['age'];
     $contact_number = $_POST['contact_number'];

    //dob validation
// Split the date into day, month, and year components
list($day, $month, $year) = explode('-', $dob);

// Check if the date is valid
if (!checkdate($month, $day, $year)) {
    echo "Invalid date of birth.<br>";
}

// // Compare with current date to ensure age is between 18 and 100 years
// $today = new DateTime();
// $birthday = new DateTime("$year-$month-$day");
// $interval = $today->diff($birthday);
// $age = $interval->y;

// if ($age < 18 || $age > 100) {
//     echo "Invalid date of birth.<br>";
// }

if ($age < 18 || $age > 100) {
    echo "Invalid age.<br>";
}

if (!preg_match("/^[0-9]{10}$/", $contact_number)) {
    echo "Invalid phone number.<br>";
}


    $stmt = $conn->prepare("INSERT INTO users ( dob, age, contact_number) VALUES (?, ?, ?)");
                                $stmt->bind_param("sss", $_POST['dob'], $_POST['age'], $_POST['contact_number']);
                                $stmt->execute();
}

?>