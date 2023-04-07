<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web_assignment";
// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for errors
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create the contacts table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS contacts (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL,
  subject VARCHAR(50) NOT NULL,
  message TEXT NOT NULL
)";

if ($conn->query($sql) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

// Prepare and bind the insert statement
$stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $subject, $message);

// Set the form data to variables
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Execute the insert statement
if ($stmt->execute() === TRUE) {
  echo "Thank you for your message!";
} else {
  echo "Error: " . $stmt->error;
}

// Close the database connection
$stmt->close();
$conn->close();
?>