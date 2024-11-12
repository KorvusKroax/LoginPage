<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Korvus">

        <link rel="icon" href="img/favicon.png">

        <link rel="stylesheet" href="css/style.css">

        <script src="js/script.js" defer></script>

        <title>LoginPage</title>
    </head>
    <body>
        <header>
            <div class="container wide">
                <div class="inline">
                    <h1>login page</h1>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <div class="options">
                            <a href="#"><?= $_SESSION['user']['name'] ?></a>
                            <button class="light" onClick="location.href='logout'">logout</button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <div class="container"><?= $_SESSION['error'] ?></div>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
