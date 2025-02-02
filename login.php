<?php
session_start();
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$username = $data["username"];
$password = $data["password"];

$query = $conn->prepare("SELECT * FROM users WHERE username=?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user["password"])) {
    $_SESSION["user"] = $user["username"];
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid credentials"]);
}
?>
