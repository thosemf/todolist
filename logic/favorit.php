<?php
include '../koneksi.php';

$id_todo = mysqli_real_escape_string($koneksi, $_GET['id']);

$f_sql = "SELECT favorite FROM todo WHERE id_todo='$id_todo' AND id_user='$id_user'";
$f_query = mysqli_query($koneksi, $f_sql);
$currFav = mysqli_fetch_assoc($f_query)['favorite'];

$setFav;
if ($f_query -> num_rows == 1) {
    $setFav = (int) $currFav == '1' ? '0' : '1' ?? null;
} else {
    header("location: ../index.php");
    exit();    
}

$sql = "UPDATE todo SET favorite='$setFav' WHERE id_todo='$id_todo' AND id_user='$id_user'";
$query = mysqli_query($koneksi, $sql);

$fs = [];
foreach ($_GET as $key => $value) {
    if ($key !== 'id' && $value !== '') {
        $safeKey = mysqli_real_escape_string($koneksi, $key);
        $safeValue = mysqli_real_escape_string($koneksi, $value);
        $fs[] = "$safeKey=$safeValue";
    }
}

if ($query) {
    header("location: ../index.php" . (!empty($fs) ? '?' . implode('&', $fs) : ''));
    exit();
} else {
    header("location: ../index.php");
    exit();
}
?>