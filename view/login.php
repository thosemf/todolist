<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="global.css" class="rel">
    <link rel="stylesheet" href="form.css" class="rel">
</head>
<body>
    <?php include '../nav.php'; ?>
    
    <section>
        <div class="card">
            <h2>Login</h2>

            <?php include 'valid_msgs.php'; ?>

            <form action="../logic/login.php" method="post">
                <label class="full" for="namemail">Username / Email</label>
                <input class="full" type="text" name="namemail" required autocomplete="off">

                <label class="full" for="password">Password</label>
                <input class="full" type="password" name="password" required autocomplete="off">

                <input type="submit" name="submit" value="Login">
                <small class="pageswitch">Belum punya akun? <a href="register.php">Register</a></small>
            </form>
        </div>
    </section>
</body>

</html>