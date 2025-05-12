<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventhub";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit();
}

// Validate POST data
if (empty($_POST['title']) || empty($_POST['location']) || empty($_POST['date']) || empty($_POST['desc'])) {
    echo json_encode(["status" => "error", "message" => "Missing event details."]);
    exit();
}

// Insert event into database
$title = $_POST['title'];
$category = $_POST['category'];
$location = $_POST['location'];
$date = $_POST['date'];
$desc = $_POST['desc'];

$sql = "INSERT INTO events (category, title, location, date, description) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "Database error."]);
    exit();
}
$stmt->bind_param("sssss", $category, $title, $location, $date, $desc);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["status" => "success", "message" => "Event published successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to publish event."]);
}

$stmt->close();
$conn->close();
?>
