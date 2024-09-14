<?php
// Database credentials
$servername = "localhost";  // MySQL host (default is localhost)
$username = "root";         // MySQL username (default is 'root' for XAMPP)
$password = "";             // MySQL password (default is empty for XAMPP)
$dbname = "sai";        // Replace with your database name
$port = 3306;               // Default MySQL port

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect data from the login form
$username_input = $_POST['username'];
$password_input = $_POST['password'];

// Use a prepared statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username_input, $password_input);

// Execute the query
if ($stmt->execute()) {
    echo "Data has been successfully inserted!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Redirect to area.html
header("Location: area.html");
exit();
?>