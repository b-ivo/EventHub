<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventhub";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role']; 
$is_admin = ($role === "admin") ? 1 : 0;

$sql = "INSERT INTO users (email, password, is_admin) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $email, $password, $is_admin);

if ($stmt->execute()) {
    echo "Signup successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>