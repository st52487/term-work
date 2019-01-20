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

$stmt = $conn->prepare("SELECT * from trida where id_trida = :id");
$stmt->bindParam(':id', $_GET["id_trida"]);
$stmt->execute();
$trida = $stmt->fetch();


$idTrida = $trida["id_trida"];
$nazev = $trida["nazev"];
$popis = $trida["popis"];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $stmt = $conn->prepare("UPDATE trida SET nazev = :nazev, popis = :popis where id_trida = :id");
        $stmt->bindParam(':nazev', $_POST["nazev"]);
        $stmt->bindParam(':popis', $_POST["popis"]);
        $stmt->bindParam(':id', $_GET["id_trida"]);
        $stmt->execute();
    }catch(Exception $e) {
        echo 'Chyba: ' .$e->getMessage();
    }

    echo "Třída upravena!";

}

?>
    <form method="post" class="simple-form">
        <input type="nazev" name="nazev" placeholder="Nazev" value="<?= $nazev; ?>"/>
        <label for="description-textarea">Popis:</label>
        <textarea name="popis" id="popis"><?php echo $popis; ?></textarea>
        <input type="submit" name="isSubmitted" value="Upravit">
    </form>

</main>