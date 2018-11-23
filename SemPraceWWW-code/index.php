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
          <?php if (Authentication::getInstance()->hasIdentity()) : ?>
        <li class="tutorials"><a href="<?= BASE_URL . "?page=logout" ?>">Logout</a></li>
          <?php else : ?>
        <li class="about">
            <a href="<?= BASE_URL . "?page=login" ?>">Login</a></li>
          <?php endif; ?>
      </ul>
    </div>
  </div>
    <div class="item3">dsaddddddddddddddddwdqdaaaaaaa
        aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        aaa
        aaaaaaaaaaaaaaaaaadddd</div>
    <div class="item4">adssssssssss</div>

  <div class="item5"><p>
    ©2008 <a href="http://www.ms-kucharovice.cz/">Mateřská školka Kuchařovice</a> | <a
        href="http://www.midasweb.eu">Design</a> | <a href="http://www.daliartstudio.com/">Ilustrace</a> | <a
        href="http://www.tam.cz">PHP</a> | <a href="http://www.plavacek.net">Plaváček webdesign</a> | <a
        href="http://www.levny-webhosting.cz">Webhosting</a></p>
<div id="toplist">
    <div><a href="http://www.toplist.cz"><img src="http://toplist.cz/count.asp?id=916996&amp;logo=" alt="TOPlist"
                                              width="1" height="1"/></a></div>
</div></div>
</div>
           
    



</body>
</html>