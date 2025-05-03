<!-- © 2025 thosemf -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="view/global.css" class="rel">
    <link rel="stylesheet" href="view/index.css" class="rel">
</head>

<body>
    <?php
    include 'nav.php';

    $sql = "SELECT todo.*, category.category FROM todo
            INNER JOIN category ON todo.id_category=category.id_category
            WHERE todo.id_user='$id_user'";

    $fCat = mysqli_real_escape_string($koneksi, $_GET['cat'] ?? '');
    $fStats = mysqli_real_escape_string($koneksi, $_GET['stats'] ?? '');
    $fFav = mysqli_real_escape_string($koneksi, $_GET['fav'] ?? '');
    $fSrch = mysqli_real_escape_string($koneksi, $_GET['s'] ?? '');

    isset($fCat) && !empty($fCat) ? $sql .= " AND todo.id_category='$fCat'" : ''; // Kategori
    
    $stats_enum = ['pending', 'done'];
    in_array($fStats, [0, 1]) ? $sql .= " AND todo.status='" . $stats_enum[$fStats] . "'" : ''; // Status

    isset($fSrch) && !empty($fSrch) ? $sql .= " AND todo.title LIKE '%$fSrch%'" : ''; // Search

    in_array($fFav, [0, 1]) ? $sql .= " AND todo.favorite='$fFav'" : ''; // Favorit

    $order = '';
    $fFav == 2 ? $order .= "todo.favorite DESC, " : '';
    $order .= "todo.created_at ASC";
    $sql .= " ORDER BY " . $order;

    // echo "SQL: $sql";
    $query = mysqli_query($koneksi, $sql);
    ?>

    <section>
        <div class="top">
            <form class="filter" method="get">
                <label class="label-cat" for="cat">Kategori :</label>
                <select class="select-cat" name="cat" onchange="this.form.submit()">
                    <?php $k_query = mysqli_query($koneksi, "SELECT * FROM category ORDER by id_category"); ?>
                    <option value="" <?= $fStats == '' ? 'selected' : '' ?>>Semua</option>
                    <?php while ($kat = mysqli_fetch_assoc($k_query)): ?>
                    <option value="<?= $kat['id_category'] ?>" <?= $kat['id_category'] == $fCat ? 'selected' : '' ?>>
                        <?= $kat['category'] ?>
                    </option>
                    <?php endwhile ?>
                </select>
                <label class="label-stats" for="stats">Status :</label>
                <select class="select-stats" name="stats" onchange="this.form.submit()">
                    <option value="" <?= $fStats == '' ? 'selected' : '' ?>>Semua</option>
                    <option value="0" <?= $fStats == '0' ? 'selected' : '' ?>>Pending</option>
                    <option value="1" <?= $fStats == '1' ? 'selected' : '' ?>>Done</option>
                </select>
                <label class="label-fav" for="fav">Favorit :</label>
                <select class="select-fav" name="fav" onchange="this.form.submit()">
                    <option value="" <?= $fFav == '' ? 'selected' : '' ?>>Semua</option>
                    <option value="2" <?= $fFav == '2' ? 'selected' : '' ?>>Sematkan</option>
                    <option value="1" <?= $fFav == '1' ? 'selected' : '' ?>>Favorit</option>
                    <option value="0" <?= $fFav == '0' ? 'selected' : '' ?>>Sembunyikan</option>
                </select>

                <label class="label-ser" for="s">Search: </label>
                <input class="input-ser" type="text" name="s" value="<?= $fSrch ?>" onchange="this.form.submit()">

                <input id="btn-filter" type="submit" value="Filter">
            </form>
            <a class="button" id="btn-tambah" href="view/tambah.php">Tambah</a>
        </div>

        <div class="cards">
            <?php while ($todo = mysqli_fetch_assoc($query)): ?>
            <div class="todo">
                <h3 class="judul"><?= $todo['title'] ?></h3>

                <input type="checkbox" class="toggdes" name="toggdes_<?= $todo['id_todo'] ?>"
                    id="toggdes_<?= $todo['id_todo'] ?>" hidden>
                <label class="deskripsi" name="toggdes_<?= $todo['id_todo'] ?>"
                    for="toggdes_<?= $todo['id_todo'] ?>"><?= $todo['description'] ?></label>

                <div class="bottom">
                    <div class="info">
                        <span class="kategori"><?= $todo['category'] ?></span>
                        <span class="status <?= $todo['status'] ?>"><?= $todo['status'] ?></span>
                    </div>
                    <div class="aksi">
                        <a class="button favorit <?= $todo['favorite'] == '1' ? 'y' : 'n' ?>"
                            href="logic/favorit.php?id=<?= $todo['id_todo'] ?>&cat=<?= $fCat ?>&stats=<?= $fStats ?>&fav=<?= $fFav ?>&s=<?= $fSrch ?>">❤</a>
                        <?php if ($todo['status'] == 'pending'): ?>
                        <a class="button edit" href="view/edit.php?id=<?= $todo['id_todo'] ?>">Edit</a>
                        <?php endif ?>
                        <a class="button hapus" href="logic/hapus.php?id=<?= $todo['id_todo'] ?>"
                            onclick="return confirm('Hapus Todo?')">Hapus</a>
                    </div>
                </div>
            </div>
            <?php endwhile ?>
        </div>
    </section>
</body>

</html>