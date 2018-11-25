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
    <div class="item3"></div>
    <div class="item5"><p>
            <?php include "./page/footer.php";?>
    </div>
</div>