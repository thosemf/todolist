<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="global.css" class="rel">
    <link rel="stylesheet" href="form.css" class="rel">
</head>
<body>
    <?php include '../nav.php'; ?>
    
    <section>
        <div class="card">
            <h2>Register</h2>

            <?php include 'valid_msgs.php'; ?>

            <form action="../logic/register.php" method="post">
                <label class="full" for="username">Username</label>
                <input class="full" type="text" name="username" required autocomplete="off" placeholder="Username">

                <label class="full" for="name">Nama</label>
                <input class="full" type="text" name="name" required autocomplete="off" placeholder="Nama anda">

                <label class="full" for="email">Email</label>
                <input class="full" type="email" name="email" required autocomplete="off"
                    placeholder="email@domain.com">

                <label class="full" for="password">Password</label>
                <input class="full" type="password" name="password" required autocomplete="off" placeholder="Password">

                <label class="full" for="c_password">Confirm Password</label>
                <input class="full" type="password" name="c_password" required autocomplete="off"
                    placeholder="Konfirmasi password">

                <div class="sb">
                    <label for="birth_date">Tanggal Lahir</label>
                    <input type="date" name="birth_date" required>
                </div>

                <input type="submit" name="submit" value="Register">
                <small class="pageswitch">Sudah punya akun? <a href="login.php">Login</a></small>
            </form>
        </div>
    </section>
</body>

</html>