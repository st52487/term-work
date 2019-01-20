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


$stmt = $conn->prepare("SELECT * from dite where id_dite = :id");
$stmt->bindParam(':id', $_GET["id_dite"]);
$stmt->execute();
$dite = $stmt->fetch();


$idDite = $dite["id_dite"];
$jmeno = $dite["jmeno"];
$prijmeni = $dite["prijmeni"];
$vek = $dite["vek"];
$idTrida = $dite["id_trida"];
$idKontakt = $dite["id_kontakt"];

$stmt = $conn->prepare("SELECT * from kontakt where id_kontakt = :id");
$stmt->bindParam(':id', $idKontakt);
$stmt->execute();

$kontaktDitete = $stmt->fetch();


$telefon = $kontaktDitete["telefon"];
$email = $kontaktDitete["email"];
$ulice = $kontaktDitete["ulice"];
$psc = $kontaktDitete["psc"];
$mesto = $kontaktDitete["mesto"];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $stmt = $conn->prepare("UPDATE dite SET jmeno = :jmeno, prijmeni = :prijmeni, vek = :vek, id_trida = :id_trida where id_dite = :id");
        $stmt->bindParam(':jmeno', $_POST["jmeno"]);
        $stmt->bindParam(':prijmeni', $_POST["prijmeni"]);
        $stmt->bindParam(':vek', $_POST["vek"]);
        if ($_SESSION["role"] == 'reditel') {
            $stmt->bindParam(':id_trida', $_POST["selectTrida"]);
        } else {
            $stmt->bindParam(':id_trida', $idTrida);
        }

        $stmt->bindParam(':id', $_GET["id_dite"]);
        $stmt->execute();


        $stmt = $conn->prepare("UPDATE kontakt SET telefon = :telefon, email = :email, ulice = :ulice, psc = :psc, mesto = :mesto where id_kontakt = :id");
        $stmt->bindParam(':telefon', $_POST["telefon"]);
        $stmt->bindParam(':email', $_POST["email"]);
        $stmt->bindParam(':ulice', $_POST["ulice"]);
        $stmt->bindParam(':psc', $_POST["psc"]);
        $stmt->bindParam(':mesto', $_POST["mesto"]);
        $stmt->bindParam(':id', $idKontakt);
        $stmt->execute();
    }catch(Exception $e) {
        echo 'Chyba: ' .$e->getMessage();
    }

    echo "Dítě upraveno!";

}

?>

    <form method="post" class="simple-form" >
        <input type="jmeno" name="jmeno" placeholder="Jmeno" value="<?= $jmeno; ?>">
        <input type="prijmeni" name="prijmeni" placeholder="Prijmeni" value="<?= $prijmeni; ?>">
        <input type="vek" name="vek" placeholder="Vek ditete" value="<?= $vek; ?>">
        <input type="telefon" name="telefon" placeholder="Telefon" value="<?= $telefon; ?>">
        <input type="email" name="email" placeholder="Email" value="<?= $email ?>">
        <input type="ulice" name="ulice" placeholder="Ulice" value="<?= $ulice; ?>">
        <input type="psc" name="psc" placeholder="psc" value="<?= $psc; ?>">
        <input type="mesto" name="mesto" placeholder="mesto" value="<?= $mesto; ?>">
        <!-- kdyz bude reditel muze zmenit tridu -->
        <?php
        $sql = "SELECT id_trida,nazev FROM trida";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) { ?>
            <select name="selectTrida" id="selectTrida">
                <?php foreach ($results as $row) { ?>
                    <option value="<?php echo $row['id_trida']; ?>"><?php echo $row['nazev']; ?></option>
                <?php } ?>
            </select>
        <?php } ?>
        <input type="submit" name="isSubmitted" value="Upravit dítě">
    </form></main>
