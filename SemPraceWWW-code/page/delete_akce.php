<?php

$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("DELETE FROM akce_skoly WHERE id_akce = :id");
$stmt->bindParam("id", $_GET["id_akce"]);
$stmt->execute();

$stmt = $conn->prepare("DELETE FROM trida_akce WHERE id_akce = :id");
$stmt->bindParam("id", $_GET["id_akce"]);
$stmt->execute();

echo "Akce byla smazána!";
?>