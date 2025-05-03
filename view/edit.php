<?php
include '../koneksi.php';

$id_todo = mysqli_real_escape_string($koneksi, $_GET['id']);
$sql = "SELECT * FROM todo WHERE id_todo = '$id_todo' AND id_user = '$id_user'";
$query = mysqli_query($koneksi, $sql);

while ($todo = mysqli_fetch_assoc($query)):

if ($todo['status'] == 'done') {
    header("location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Todo</title>
    <link rel="stylesheet" href="global.css" class="rel">
    <link rel="stylesheet" href="form.css" class="rel">
</head>
<body>
    <?php include '../nav.php'; ?>
    
    <section>
        <div class="card">
            <h2>Edit Todo</h2>

            <?php include 'valid_msgs.php'; ?>

            <form action="../logic/edit.php" method="get">
                <input type="hidden" name="id" value="<?= $id_todo ?>">

                <label class="full" for="judul">Judul</label>
                <input class="full" type="text" name="judul" required autocomplete="off" value="<?= $todo['title'] ?>" placeholder="Judul">

                <label class="full" for="deskripsi">Deskripsi</label>
                <textarea class="full" name="deskripsi" required autocomplete="off" placeholder="Deskripsi Todo kamu"><?= $todo['description'] ?></textarea>

                <div class="sb">
                    <label for="id_kategori">Kategori</label>
                    <select name="id_kategori">
                        <?php $k_query = mysqli_query($koneksi, "SELECT * FROM category ORDER by id_category");
                        while ($kat = mysqli_fetch_assoc($k_query)): ?>
                        <option value="<?= $kat['id_category'] ?>"
                            <?= $todo['id_category'] == $kat['id_category'] ? 'selected' : '' ?>><?= $kat['category'] ?>
                        </option>
                        <?php endwhile ?>
                    </select>
                </div>

                <div class="sb">
                    <label for="status">Status</label>
                    <select name="status">
                        <option value="pending" <?= $todo['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <input type="submit" name="submit" value="Edit">
            </form>
        </div>
    </section>
</body>

</html>

<?php endwhile ?>