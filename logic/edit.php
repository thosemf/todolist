<?php
include '../koneksi.php';

$id_todo = mysqli_real_escape_string($koneksi, $_GET['id']);
$judul = mysqli_real_escape_string($koneksi, $_GET['judul']);
$deskripsi = mysqli_real_escape_string($koneksi, $_GET['deskripsi']);
$id_kategori = mysqli_real_escape_string($koneksi, $_GET['id_kategori']);
$status = mysqli_real_escape_string($koneksi, $_GET['status']);

$sql = "UPDATE todo SET title='$judul', description='$deskripsi', status='$status', id_category='$id_kategori' WHERE id_todo='$id_todo' AND id_user='$id_user'";

include 'validator.php';

if ($valid_query) {
    header("location: ../index.php");
    exit();
} else {
    header("location: ../view/edit.php?id=" . $id_todo);
    exit();
}?>
