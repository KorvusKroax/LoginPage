<?php
    if (isset($_SESSION['user'])) {
        header('location: home');
        exit();
    }

    if (isset($_POST['name'])) $name = trim($_POST['name']);
    if (isset($_POST['password'])) $password = $_POST['password'];

    if (isset($_POST['login'])) {
        if (($_SESSION['error'] = validateLogin($name, $password)) == null) {
            $_SESSION['user'] = getUserByName($name);
            header('location: home');
            exit();
        }
    }
?>



<?php require('pages/header.php'); ?>

<main>
    <div class="container narrow">
        <form method="post">
            <div class="field">
                <label for="name">username:</label>
                <input id="name" type="text" name="name" value="<?= isset($name) ? $name : "" ?>">
            </div>
            <div class="field">
                <label for="password">password:</label>
                <input id="password" type="password" name="password" value="<?= isset($password) ? $password : "" ?>">
            </div>
            <br>
            <div class="actions">
                <button type="submit" name="login">login</button>
                <div class="options">
                    <a  href="#">forgot password?</a>
                    <a href="signup">signup</a>
                </div>
            </div>
        </form>
    </div>
</main>

<?php require('pages/footer.php'); ?>
