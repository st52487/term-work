<main>
    <section id="hero">
        <div>
            <h1 style="font-family: 'Calibri Light'">Mateřská škola Sluníčko</h1>
        </div>
    </section>
<?php

$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


try {
    $stmt = $conn->prepare("DELETE FROM trida WHERE id_trida = :id");
    $stmt->bindParam("id", $_GET["id_trida"]);
    $stmt->execute();

    echo "Třída byla smazána!";
}catch(Exception $e) {
    echo 'Chyba: ' .$e->getMessage();
}

?></main>