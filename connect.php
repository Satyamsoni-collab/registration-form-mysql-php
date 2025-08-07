<?php

// Step 1: Connect to MySQL
$servername = "localhost";
$username = "root";
$password = "Satyam#9235";
$database = "registration_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Step 2: Get data from form if submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "Form reached!";
  $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
  $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
  $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';
  $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
  $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
  $phone = isset($_POST['number']) ? htmlspecialchars($_POST['number']) : '';

  // Step 3: Prepare and bind
  $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, gender, email, password, phoneNumber) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $firstName, $lastName, $gender, $email, $password, $phone);

  if ($stmt->execute()) {
    echo "✔️ Registration successful!";
  } else {
    echo "❌ Error: " . $stmt->error;
  }

  $stmt->close();
}


$conn->close();
?>