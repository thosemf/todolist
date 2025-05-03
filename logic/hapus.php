<?php
include '../koneksi.php';

$id_todo = mysqli_real_escape_string($koneksi, $_GET['id']);

$sql = "DELETE FROM todo WHERE id_todo='$id_todo' AND id_user='$id_user'";
$query = mysqli_query($koneksi, $sql);

if (!$query) {
    $_SESSION['valid-msg']['db'] = "Terjadi kesalahan, tolong coba lagi.";
    echo("<script>alert('" . $_SESSION['valid-msg']['db'] . "');</script>");
}
header("location: ../index.php");
exit();
?>