<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from database
$sql = "SELECT * FROM teamsoccer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize an empty array to store rows
    $data = [];

    // Fetch rows
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'Number' => $row['Number'],
            'Team Name' => $row['Name_Team'],
            'City Name' => $row['Name_City']
        ];
    }

    // Close connection
    $conn->close();

    // Create CSV file
    $file = fopen('teamsoccer.csv', 'w');

    // Write headers
    fputcsv($file, array_keys($data[0]));

    // Write rows
    foreach ($data as $row) {
        fputcsv($file, $row);
    }

    // Close file
    fclose($file);

    // Download file
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename=teamsoccer.csv');
    readfile('teamsoccer.csv');
    exit;
} else {
    echo "No data found";
}
?>
