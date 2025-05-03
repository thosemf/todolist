<?php
include '../koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$name = mysqli_real_escape_string($koneksi, $_POST['name']);
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);
$c_password = mysqli_real_escape_string($koneksi, $_POST['c_password']);
$birth_date = mysqli_real_escape_string($koneksi, $_POST['birth_date']);

$pwhash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO user (username, password, name, email, birth_date) VALUES ('$username', '$pwhash', '$name', '$email', '$birth_date')";

include 'validator.php';

if ($valid_query) {
    header("location: ../view/login.php");
    exit();
} else {
    header("location: ../view/register.php");
    exit();
}
?>