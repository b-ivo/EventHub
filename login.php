<?php
session_start();
header("Content-Type: application/json"); // Set JSON output

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventhub";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit();
}

// Validate POST data
if (empty($_POST['email']) || empty($_POST['password'])) {
    echo json_encode(["status" => "error", "message" => "Missing email or password."]);
    exit();
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Prepare SQL query safely
$sql = "SELECT id, password, is_admin FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "Database error."]);
    exit();
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['userRole'] = $user['is_admin'] ? "admin" : "user";

        // Redirect URL based on role
        $redirectUrl = $_SESSION['userRole'] === "admin" ? "admin_dashboard.php" : "user_dashboard.php";

        echo json_encode(["status" => "success", "userRole" => $_SESSION['userRole'], "redirect" => $redirectUrl]); // ✅ Correct JSON formatting
        exit();
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid password."]);
        exit();
    }
} else {
    echo json_encode(["status" => "error", "message" => "User not found."]);
    exit();
}

// Close resources
$stmt->close();
$conn->close();
?>