<?php
$_SESSION['valid-msg'] = [];
$proceed = true;

if (THIS == 'login.php' || THIS == 'register.php') {
    if (THIS == 'login.php') {
        if (empty($namemail)) {
            $_SESSION['valid-msg']['namemail'] = "Nama / Email harus diisi.";
            $proceed = false;
        }
        if (empty($password)) {
            $_SESSION['valid-msg']['password'] = "Password harus diisi.";
            $proceed = false;
        }
    }
    if (THIS == 'register.php') {
        if (empty($username)) {
            $_SESSION['valid-msg']['username'] = "Username harus diisi.";
            $proceed = false;
        } elseif (!preg_match('/^[a-zA-Z0-9_]{2,25}$/', $username)) {
            $_SESSION['valid-msg']['username'] = "Username harus terdiri dari 2-25 karakter dan hanya boleh menggunakan alphabet, numerik, dan undescore.";
            $proceed = false;
        }

        if (empty($name)) {
            $_SESSION['valid-msg']['name'] = "Nama harus diisi.";
            $proceed = false;
        } elseif (!preg_match('/^[a-zA-Z\s.]{2,25}$/', $name)) {
            $_SESSION['valid-msg']['name'] = "Nama harus terdiri dari 2-25 karakter dan hanya boleh menggunakan alphabet, spasi, dan titik.";
            $proceed = false;
        }

        if (empty($email)) {
            $_SESSION['valid-msg']['email'] = "Email harus diisi.";
            $proceed = false;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['valid-msg']['email'] = "Email tidak valid.";
            $proceed = false;
        }

        if (empty($password)) {
            $_SESSION['valid-msg']['password'] = "Password harus diisi.";
            $proceed = false;
        }
        elseif (!preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{8,}$/', $password)) {
            $_SESSION['valid-msg']['password'] = "Password minimal 8 karakter dan harus mengandung uppercase, angka dan simbol.";
            $proceed = false;
        }
        
        if ($c_password !== $password) { 
            $_SESSION['valid-msg']['c_password'] = "Konfirmasi password tidak sama.";
            $proceed = false;
        }

        if (empty($birth_date)) {
            $_SESSION['valid-msg']['birth_date'] = "Tanggal lahir harus diisi.";
            $proceed = false;
        } elseif (strtotime($birth_date) > strtotime(date('Y-m-d'))) {
            $_SESSION['valid-msg']['birth_date'] = "Tanggal lahir tidak boleh melebihi hari ini.";
            $proceed = false;
        }

        $check_sql = "SELECT username, email FROM user WHERE username='$username' OR email='$email'";
        $check_query = mysqli_query($koneksi, $check_sql);
        if ($check_query -> num_rows > 0) {
            $user = mysqli_fetch_assoc($check_query);
            if ($username == $user['username'] && $email == $user['email']) {
                $_SESSION['valid-msg']['db'] = "Username dan email sudah terdaftar.";
            } else if ($username == $user['username']) {
                $_SESSION['valid-msg']['db'] = "Username sudah terdaftar.";
            } else if ($email == $user['email']) {
                $_SESSION['valid-msg']['db'] = "Email sudah terdaftar.";
            }
            $proceed = false;
        }
    }
} elseif (THIS == 'tambah.php' || THIS == 'edit.php') {
    if (empty($judul)) {
        $_SESSION['valid-msg']['judul'] = "Judul harus diisi.";
        $proceed = false;
    }
    if (empty($deskripsi)) {
        $_SESSION['valid-msg']['deskripsi'] = "Deskripsi harus diisi.";
        $proceed = false;
    }
    if (!in_array($status, ['pending', 'done'])) {
        $_SESSION['valid-msg']['status'] = "Status tidak valid.";
        $proceed = false;
    }
    
    $check_sql = "SELECT category FROM category WHERE id_category='$id_kategori'";
    $check_query = mysqli_query($koneksi, $check_sql);
    if (empty($id_kategori) || $check_query -> num_rows === 0) {
        $_SESSION['valid-msg']['id_kategori'] = "kategori tidak valid.";
        $proceed = false;
    }
} else {
    unset($_SESSION['valid-msg']);
    header("location: " . ROOT);
    exit();
}

$valid_query;
if (isset($sql) && $proceed) {
    $valid_query = mysqli_query($koneksi, $sql);
    if (!$valid_query) {
        $_SESSION['valid-msg']['db'] = "Terjadi kesalahan, tolong coba lagi.";
    }
}
?>
