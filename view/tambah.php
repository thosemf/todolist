<?php
include '../koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM category ORDER by id_category");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Todo</title>
    <link rel="stylesheet" href="global.css" class="rel">
    <link rel="stylesheet" href="form.css" class="rel">
</head>
<body>
    <?php include '../nav.php'; ?>
    
    <section>
        <div class="card">
            <h2>Tambah Todo</h2>

            <?php include 'valid_msgs.php'; ?>

            <form action="../logic/tambah.php" method="get">
                <label class="full" for="judul">Judul</label>
                <input class="full" type="text" name="judul" required autocomplete="off" placeholder="Judul">

                <label class="full" for="deskripsi">Deskripsi</label>
                <textarea class="full" name="deskripsi" required autocomplete="off" placeholder="Deskripsi Todo kamu"></textarea>

                <div class="sb">
                    <label for="id_kategori">Kategori</label>
                    <select name="id_kategori">
                        <?php while ($kat = mysqli_fetch_assoc($query)): ?>
                        <option hidden default disabled>Pilih</option>
                        <option value="<?= $kat['id_category'] ?>"><?= $kat['category'] ?></option>
                        <?php endwhile ?>
                    </select>
                </div>

                <div class="sb">
                    <label for="status">Status</label>
                    <select name="status">
                        <option value="pending" default>Pending</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <input type="submit" name="submit" value="Tambah">
            </form>
        </div>
    </section>
</body>

</html>