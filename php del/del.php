<?php
session_start(); // Start the session to use session variables

// Include the database connection file
include '../html/conn.php';

// Check if ID parameter exists in URL
if (isset($_GET['Number'])) {
    // Sanitize the input (optional, but recommended)
    $Number = intval($_GET['Number']);

    // Prepare a delete statement with a prepared statement
    $sql = "DELETE FROM teamsoccer WHERE Number = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind the parameter
        $stmt->bind_param("i", $Number);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Check if any rows were affected
            if ($stmt->affected_rows > 0) {
                // Set a session variable to indicate success
                $_SESSION['delete_success'] = true;
            } else {
                echo "No records found with Number = $Number";
            }
        } else {
            echo "Error executing delete statement: " . $stmt->error;
        }
        
        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing delete statement: " . $conn->error;
    }
    
    // Redirect back to index.php after deletion
    header("Location: ../html/index.php");
    exit();
} else {
    echo "Number parameter is missing.";
}

// Close the connection
$conn->close();
?>
