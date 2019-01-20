<main>
    <section id="hero">
        <div>
            <h1 style="font-family: 'Calibri Light'">Mateřská škola Sluníčko</h1>
        </div>
    </section>
<?php

$vypis = "";

$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * from akce_skoly where id_akce = :id");
$stmt->bindParam(':id', $_GET["id_akce"]);
$stmt->execute();
$akce = $stmt->fetch();


$idAkce = $akce["id_akce"];
$nazev = $akce["nazev"];
$popis = $akce["popis"];
$datum = $akce["datum"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $stmt = $conn->prepare("UPDATE akce_skoly SET nazev = :nazev, popis = :popis, datum = :datum where id_akce = :id");
        $stmt->bindParam(':nazev', $_POST["nazev"]);
        $stmt->bindParam(':popis', $_POST["popis"]);
        $stmt->bindParam(':datum', $_POST["datum"]);
        $stmt->bindParam(':id', $_GET["id_akce"]);
        $stmt->execute();
    }catch(Exception $e) {
        echo 'Chyba: ' .$e->getMessage();
    }

    echo "Akce upravena!";

}
?>

    <form method="post" class="simple-form">
        <input type="nazev" name="nazev" placeholder="Nazev" value="<?= $nazev; ?>"/>
        <label for="description-textarea">Popis:</label>
        <textarea name="popis" id="popis"><?php echo $popis; ?></textarea>
        <input type="datum" name="datum" placeholder="Datum konani" value="<?= $datum; ?>"/>
        <input type="submit" name="isSubmitted" value="Upravit">
    </form></main>
