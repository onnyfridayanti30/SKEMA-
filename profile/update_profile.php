<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login/login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "skema_nyoba");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$updateQuery = "UPDATE users SET username=?, email=?";
$params = [$username, $email];
$types = "ss";

// Password
if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $updateQuery .= ", password=?";
    $types .= "s";
    $params[] = $hashedPassword;
}

// Foto profil
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
    $imageName = 'img/' . uniqid() . "_" . basename($_FILES["profile_image"]["name"]);
    $targetPath = __DIR__ . '/' . $imageName;
    move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetPath);
    $updateQuery .= ", profile_image=?";
    $types .= "s";
    $params[] = $imageName;
}

$updateQuery .= " WHERE id=?";
$types .= "i";
$params[] = $user_id;

$stmt = $conn->prepare($updateQuery);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$stmt->close();

$conn->close();
header("Location: profile.php");
exit();
?>
