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

$stmt = $conn->prepare("select id_trida from ucitel where id_ucitel = :id");
$stmt->bindParam(':id', $_SESSION["id"]);
$stmt->execute();

$idTrida = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $stmt = $conn->prepare("INSERT INTO akce_skoly(nazev, popis, datum) VALUES (:nazev,:popis,:datum)");

    $stmt->bindParam(':nazev', $_POST["nazev"]);
    $stmt->bindParam(':popis', $_POST["popis"]);
    $stmt->bindParam(':datum', $_POST["datum"]);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT last_insert_id()");
    $stmt->execute();

    $id = $stmt->fetch();


    $stmt = $conn->prepare("INSERT INTO trida_akce(id_trida, id_akce) VALUES (:id_trida,:id_akce)");
if($_SESSION["role"] == 'reditel') {
    $stmt->bindParam(':id_trida', $_POST["selectTrida"]);
}else {
    $stmt->bindParam(':id_trida', $idTrida["id_trida"]);
}
    $stmt->bindParam(':id_akce', $id["last_insert_id()"]);

    $stmt->execute();

    $vypis = "Akce přidána";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($vypis)) {
    echo $vypis;
}


?>



<form method="post" class="simple-form">
    <input type="nazev" name="nazev" placeholder="Nazev"/>
    <label for="description-textarea">Popis:</label>
    <textarea name="popis" id="popis"></textarea>
    <input type="datum" name="datum" placeholder="Datum konani"/>
    <?php

    if($_SESSION["role"] == 'reditel') {
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
        <?php }
    }
    ?>
    <input type="submit" name="isSubmitted" value="Přidat">
</form>
</main>