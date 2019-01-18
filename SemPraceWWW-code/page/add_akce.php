<?php
$vypis = "";

$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $stmt = $conn->prepare("INSERT INTO akce_skoly(nazev, popis, datum) VALUES (:nazev,:popis,:datum)");

    $stmt->bindParam(':nazev', $_POST["nazev"]);
    $stmt->bindParam(':popis', $_POST["popis"]);
    $stmt->bindParam(':datum', $_POST["datum"]);
    $stmt->execute();

    $vypis = "Akce přidána";
}

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($vypis)) {
        echo $vypis;
    }
?>



<form method="post">
    <input type="nazev" name="nazev" placeholder="Nazev"/>
    <label for="description-textarea">Popis:</label>
    <textarea name="popis" id="popis"></textarea>
    <input type="datum" name="datum" placeholder="Datum konani"/>
    <input type="submit" name="isSubmitted" value="yes">
</form>
