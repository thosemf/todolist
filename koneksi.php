<?php
define("ROOT", "http://localhost/app_todolist");
define("THIS", basename($_SERVER['PHP_SELF']));

$koneksi = mysqli_connect('localhost', 'root', '', 'db_todolist_app');

if (!$koneksi) {
    die(mysqli_connect_error());
}
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!in_array(THIS, ['login.php', 'register.php'])) {
    if (isset($_SESSION['user'])) {  
        $id_user = $_SESSION['user']['id_user'];
        $username = $_SESSION['user']['username'];
    } else {
        session_destroy();
        header("location: " . ROOT . "/view/login.php");
        exit();
    }
}
?>