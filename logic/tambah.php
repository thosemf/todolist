<?php
include '../koneksi.php';

$judul = mysqli_real_escape_string($koneksi, $_GET['judul']);
$deskripsi = mysqli_real_escape_string($koneksi, $_GET['deskripsi']);
$id_kategori = mysqli_real_escape_string($koneksi, $_GET['id_kategori']);
$status = mysqli_real_escape_string($koneksi, $_GET['status']);

$sql = "INSERT INTO todo (title, description, status, id_category, id_user) VALUES ('$judul', '$deskripsi', '$status', '$id_kategori', '$id_user')";

include 'validator.php';

if ($valid_query) {
    header("location: ../index.php");
    exit();
} else {
    header("location: ../view/tambah.php");
    exit();
}
?>