<?php
$servername = "localhost";
$username = "root";
$password = ""; // Assuming your XAMPP MySQL password is empty
$dbname = "your_database_name"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
