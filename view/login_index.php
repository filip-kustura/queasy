<?php require_once __DIR__ . '/_header.php'; ?>

<?php require_once __DIR__ . '/warning.php'; ?>

<form action="index.php?rt=login/handleAction" method="post" id="login-form" class="centered">
    <p>
        <label for="username-input">Username:</label> 
        <input type="text" name="username" id="username-input">
    </p>
    <p>
        <label for="password-input">Password:</label>
        <input type="password" name="password" id="password-input">
    </p>
    <p>
        <input type="submit" value="Log In" name="login" id="login-button">
        <input type="submit" value="Sign Up" name="sign-up">
    </p>
</form>

<?php require_once __DIR__ . '/_footer.php'; ?>
