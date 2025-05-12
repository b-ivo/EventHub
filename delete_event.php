<?php
session_start();
if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== "admin") {
    die(json_encode(["status" => "error", "message" => "Access denied."]));
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventhub";

$conn = new mysqli($servername, $password, $dbname);
if ($conn->connect_error) die(json_encode(["status" => "error", "message" => "Connection failed."]));

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    die(json_encode(["status" => "error", "message" => "Invalid event ID."]));
}

$id = $_POST['id'];
$sql = "DELETE FROM events WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(["status" => "success", "message" => "Event deleted."]);
$stmt->close();
$conn->close();
?>