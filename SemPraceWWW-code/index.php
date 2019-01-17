<?php
ob_start();
session_start();
include 'config.php';

function __autoload($className)
{
    if (file_exists('./class/' . $className . '.php')) {
        require_once './class/' . $className . '.php';
        return true;
    }
    return false;
}

?>
<html>
<head>
    <meta content="text/html" charset="utf-8">
    <title>Úvodní stránka - Mateřská škola Jizerská</title>
    <link rel="stylesheet" type="text/css" href="indexStyles.css">
</head>
<body>
<div class="grid-container">
    <div class="item1"></div>
    <div class="item2">
        <div class="nav">
            <ul>
                <li class="home"><a href="<?= BASE_URL ?>">Home</a></li>
                <li class="tutorials"><a href="<?= BASE_URL . "?page=zvolTridu" ?>">Třídy</a></li>
                <li class="home"><a>Akce</a></li>
                <li class="home"><a>Jídelníček</a></li>
                <li class="home"><a>Kontakty</a></li>
                <?php if (!empty($_SESSION["username"])) { ?>
                    <li class="tutorials"><a href="<?= BASE_URL . "?page=user-read-all" ?>">Zamestnanci</a></li>
                    <li class="tutorials"><a href="<?= BASE_URL . "?page=logout" ?>">Logout</a></li>
                    <?php if ($_SESSION["role"] == 'reditel') { ?>
                    <li class="about">
                        <a href="<?= BASE_URL . "?page=user-add" ?>">Pridat uzivatele</a></li>
                    <?php } ?>
                <?php } else { ?>
                    <li class="about">
                        <a href="<?= BASE_URL . "?page=login" ?>">Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="item3">
        <?php
        $file = "./page/" . $_GET["page"] . ".php";
        if (file_exists($file)) {
            include $file;
        } else {
            include "./page/default.php";
        }
        ?>
    </div>
    <div class="item4">
        sfkgsdgk
    </div>
    <div class="item5"><p>
            <?php include "./page/footer.php"; ?>
    </div>
</div>
</body>
</html>