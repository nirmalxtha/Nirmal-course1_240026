<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$username = $data["username"];
$email = $data["email"];
$password = password_hash($data["password"], PASSWORD_DEFAULT);

$query = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$query->bind_param("sss", $username, $email, $password);

if ($query->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Registration failed!"]);
}
?>
