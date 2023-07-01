<?php require_once __DIR__ . '/_header.php'; ?>

<?php if (isset($_SESSION['new-user'])) {
    echo '<p style="color: green;">Registration successful!</p>';
    unset($_SESSION['new-user']);
} ?>

<span>Welcome, <?php print_r($_SESSION['username']); ?>.</span>

<?php require_once __DIR__ . '/_footer.php'; ?>
