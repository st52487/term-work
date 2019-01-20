<?php
ob_start();
session_start();
include 'config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="css/layout.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">

    <title>Mateřská škola Sluníčko</title>
</head>
<body>

<header>

    <nav id="nav">
        <a href="<?= BASE_URL ?>">Home</a>
        <a href="<?= BASE_URL . "?page=zvolTridu" ?>">Třídy</a>
        <a href="<?= BASE_URL . "?page=show_akce" ?>">Akce</a>
        <a href="<?= BASE_URL . "?page=jidelnicek" ?>">Jídelníček</a>
        <a href="<?= BASE_URL . "?page=user-read-all" ?>">Zamestnanci</a>
        <?php if (!empty($_SESSION["username"])) { ?>
        <a href="<?= BASE_URL . "?page=add_akce" ?>">Vytvořit akci</a>
            <?php if($_SESSION["role"] == 'reditel'){ ?>
                <a href="<?= BASE_URL . "?page=exportJidelnicek" ?>">Stahnout jidelnicek</a>
                <?php } ?><a href="<?= BASE_URL . "?page=logout" ?>">Logout</a>
        <?php } else { ?>
        <a href="<?= BASE_URL . "?page=login" ?>">Login</a>
        <?php } ?>
    </nav>
</header>
<?php
$file = "./page/" . $_GET["page"] . ".php";
if (file_exists($file)) {
    include $file;
} else {
    include "./page/default.php";
}
?>
<footer>
    <?php include "./page/footer.php"; ?>
</footer>
</body>
</html>