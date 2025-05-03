<?php
include '../koneksi.php';

$sql = "SELECT name, email, birth_date FROM user WHERE id_user = '$id_user'";
$query = mysqli_query($koneksi, $sql);

if ($query -> num_rows === 1):
$user = mysqli_fetch_assoc($query);
$name = $user['name'];
$email = $user['email'];
$birth_date = $user['birth_date'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Todo</title>
    <link rel="stylesheet" href="global.css" class="rel">
    <link rel="stylesheet" href="form.css" class="rel">
    <style>
        .card div {
            text-align: center;
            color: white;
        }
        .profile-section {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px solid #333;
        }

        .profile-section:last-child {
            display: flex;
            justify-content: space-between;
        }
        .kembali {
            color: white;
            background-color: rgb(0, 110, 255);
        }
        .kembali:hover {
            background-color: rgb(0, 85, 205);
        }
        .logout {
            color: white;
            background-color: rgb(216, 0, 0);
        }
        .logout:hover {
            background-color: rgb(181, 0, 0);
        }
    </style>
</head>
<body>
    <?php include '../nav.php'; ?>
    
    <section>
        <div class="card">
            <h2>Halo,</h2>

            <div class="profile-section">
                <h2><?= $username ?></h2>
                <small><?= $email ?></small>
            </div>
            <div class="profile-section">
                <h2><?= $name ?></h2>
                <small><?= date('F j, Y', strtotime($birth_date)) ?></small>
            </div>
            <div class="profile-section">
                <a class="button kembali" href="<?= ROOT ?>">Kembali</a>
                <a class="button logout" href="../logic/logout.php">Logout</a>
            </div>
        </div>
    </section>
</body>

</html>

<?php endif ?>