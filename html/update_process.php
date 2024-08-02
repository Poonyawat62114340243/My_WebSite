<?php
include '../html/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST['updateNumber'];
    $nameTeam = $_POST['updateNameTeam'];
    $nameCity = $_POST['updateNameCity'];

    // Prepare SQL statement to update the record
    $sql = "UPDATE teamsoccer SET Name_Team = ?, Name_City = ? WHERE Number = ?";
    
    // Prepare and bind parameters to avoid SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nameTeam, $nameCity, $number);

    if ($stmt->execute()) {
        // Redirect back to the main page after successful update
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$stmt->close();
$conn->close();
?>
