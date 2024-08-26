<?php
// Establishing connection to MySQL database
$conn = new mysqli('localhost', 'root', 'rambok', 'services_db');

// Checking connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Retrieving form data using POST method
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$services = $_POST['services'];
$experience = $_POST['experience'];
$co_workers = $_POST['co-workers'];

// Preparing SQL query to insert data into database
$sql = "INSERT INTO service_providers (name, email, phone, location, services, experience, co_workers_count) 
        VALUES ('$name', '$email', '$phone', '$location', '$services', '$experience', '$co_workers')";

// Executing SQL query and checking for success
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Closing database connection
$conn->close();
?>
