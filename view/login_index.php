<?php require_once __DIR__ . '/_header.php'; ?>

<table>
    <header>
        <div>
            Queasy
        </div>
    </header>

    <form action="index.php?rt=login/handleAction" method="post">
        <p>
            <label for="username-input">Username:</label> 
            <input type="text" name="username" id="username-input">
        </p>
        <p>
            <label for="password-input">Password:</label>
            <input type="password" name="password" id="password-input">
        </p>
        <p>
            <input type="submit" value="Log In" name="login">
            <input type="submit" value="Sign Up" name="sign-up">
        </p>
    </form>
</table>

<?php require_once __DIR__ . '/_footer.php'; ?>
