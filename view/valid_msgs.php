<?php
if (!isset($koneksi)) {
    include __DIR__ . '/../koneksi.php';
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['valid-msg']) && !empty($_SESSION['valid-msg'])): ?>
    <ul class="valid-msg">
        <?php foreach ($_SESSION['valid-msg'] as $msg): ?>
            <li><?= htmlspecialchars($msg) ?></li>
        <?php endforeach;
        unset($_SESSION['valid-msg']); ?>
    </ul>
<?php endif ?>