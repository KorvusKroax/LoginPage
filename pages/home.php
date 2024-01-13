<?php
    if (!isset($_SESSION['user'])) {
        header('location: login');
        exit();
    }
?>



<?php require('pages/header.php'); ?>

<main>
    <div class="container">
        <h2>Helló, <?= $_SESSION['user']['name'] ?>!</h2>
    </div>
</main>

<?php require('pages/footer.php'); ?>
