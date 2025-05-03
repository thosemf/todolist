<?php
include '../koneksi.php';

$namemail = mysqli_real_escape_string($koneksi, $_POST['namemail']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

$sql = "SELECT * FROM user WHERE username='$namemail' OR email='$namemail'";

include 'validator.php';

if ($valid_query -> num_rows === 1) {
    $user = mysqli_fetch_assoc($valid_query);
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("location: ../index.php");
        exit();
    } else {
        $_SESSION['valid-msg']['db'] = "Password salah.";
    }
} else {
    $_SESSION['valid-msg']['db'] = "Akun tidak ditemukan.";
}
header("location: ../view/login.php");
exit();
?>