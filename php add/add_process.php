<?php
session_start(); // Start the session to use session variables

// Include the database connection file
include '../html/conn.php';

// Check if form submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $name_team = $conn->real_escape_string($_POST['name_team']);
    $name_city = $conn->real_escape_string($_POST['name_city']);

    // Attempt insert query execution
    $sql = "INSERT INTO teamsoccer (Name_Team, Name_City) VALUES ('$name_team', '$name_city')";
    
    if ($conn->query($sql) === TRUE) {
        // Set a session variable to indicate success
        $_SESSION['insert_success'] = true;
        
        // Redirect to index.php after successful insertion
        header("Location: ../html/index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
