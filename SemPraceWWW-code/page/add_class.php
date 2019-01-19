<?php
$vypis = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO trida (nazev, popis) values 
    (:nazev, :popis)");
    $stmt->bindParam(':nazev', $_POST["nazev"]);
    $stmt->bindParam(':popis', $_POST["popis"]);
    $stmt->execute();

    $vypis = "Třída přidána";
}

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($vypis)) {
        echo $vypis;
    }
?>



<form method="post">
    <input type="nazev" name="nazev" placeholder="Nazev"/>
    <label for="description-textarea">Popis:</label>
    <textarea name="popis" id="popis"></textarea>
    <input type="submit" name="isSubmitted" value="yes">
</form>

