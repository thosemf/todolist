<?php
if (!isset($koneksi)) {
    include __DIR__ . '/koneksi.php';
}
?>
</head>

<body>
<nav>
    <div class="inner">
        <div class="logo">
            <?php if (!in_array(THIS, ['login.php', 'register.php'])) { ?>
                <h1><a href="<?= ROOT ?>">Todo List</a></h1>
            <?php } else { ?>
                <h1 id="off">Todo List</h1>
            <?php } ?>
        </div>
        <?php if (!in_array(THIS, ['profile.php', 'login.php', 'register.php'])): ?>
            <div class="profile">
                <a class="circle" href="<?= ROOT . "/view/profile.php" ?>"><?= $username ?></a>
            </div>
        <?php endif ?>
    </div>
</nav>