

<?php
if (!empty($_POST) && !empty($_POST["loginMail"]) && !empty($_POST["loginPassword"])) {
    $authService = Authentication::getInstance();
    if ($authService->login($_POST["loginMail"], $_POST["loginPassword"])) {
         header("Location: " . BASE_URL);
    } else {
        echo "user not found";
    }
} else if (!empty($_POST)) {

    echo "Username and password are required";
}
?>
<div class="grid-container">
    <div class="item1"></div>
    <div class="item2">
        <div class="nav">
            <ul>
                <li class="home"><a href="<?= BASE_URL ?>">Home</a></li>
                <?php if (Authentication::getInstance()->hasIdentity()) : ?>
                    <li class="tutorials"><a href="<?= BASE_URL . "?page=logout" ?>">Logout</a></li>
                <?php else : ?>
                    <li class="about">
                        <a href="<?= BASE_URL . "?page=login" ?>">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="item3"><form method="post">
            <input type="email" name="loginMail" placeholder="Inser ur email">
            <input type="password" name="loginPassword" placeholder="Entr password">
            <input type="submit" value="Log in">
        </form></div>
    <div class="item5"><p>
            <?php include "./page/footer.php";?>
    </div>
</div>


