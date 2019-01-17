<?php

$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("DELETE FROM users WHERE id_ucitel = :id");
$stmt->bindParam("id", $_GET["id_ucitel"]);
$stmt->execute();

$stmt = $conn->prepare("DELETE FROM ucitel WHERE id_ucitel = :id");
$stmt->bindParam("id", $_GET["id_ucitel"]);
$stmt->execute();

echo "User was deleted";
?>