<main>
    <section id="hero">
        <div>
            <h1 style="font-family: 'Calibri Light'">Mateřská škola Sluníčko</h1>
        </div>
    </section>
<?php
$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("select count(nazev) from trida join ucitel u on trida.id_trida = u.id_trida where id_ucitel = :id and u.id_trida = :idTrida");
$stmt->bindParam(":id", $_SESSION["id"]);
$stmt->bindParam(":idTrida", $_GET["id_trida"]);
$stmt->execute();

$user = $stmt->fetch();
$pridat = "Přidat dítě do třídy";
$vypis = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO kontakt (telefon, email, ulice, psc, mesto) VALUES 
(:telefon,:email,:ulice,:psc,:mesto)");
    $stmt->bindParam(':telefon', $_POST["telefon"]);
    $stmt->bindParam(':email', $_POST["email"]);
    $stmt->bindParam(':ulice', $_POST["ulice"]);
    $stmt->bindParam(':psc', $_POST["psc"]);
    $stmt->bindParam(':mesto', $_POST["mesto"]);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT last_insert_id()");
    $stmt->execute();

    $id = $stmt->fetch();

    $stmt = $conn->prepare("INSERT INTO dite(jmeno, prijmeni, vek, id_trida, id_kontakt) values 
(:jmeno,:prijmeni,:vek,:id_trida,:id_kontakt)");
    $stmt->bindParam(':jmeno', $_POST["jmeno"]);
    $stmt->bindParam(':prijmeni', $_POST["prijmeni"]);
    $stmt->bindParam(':vek', $_POST["vek"]);
    $stmt->bindParam(':id_trida', $_GET["id_trida"]);
    $stmt->bindParam(':id_kontakt', $id["last_insert_id()"]);

    $stmt->execute();
    $vypis = "Dítě přidáno";




    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($vypis)) {
        echo $vypis;
    }


}
?>

<?php
$stmt = $conn->prepare("select id_dite,jmeno,prijmeni,vek,telefon,email,ulice,psc,mesto from dite join kontakt k on dite.id_kontakt = k.id_kontakt
join trida t on dite.id_trida = t.id_trida where dite.id_trida = ?");
$stmt->execute(array($_GET["id_trida"]));

$data = $stmt->fetchAll();


if ($_SESSION["role"] == 'reditel' || $user["count(nazev)"] > 0) { ?>
    <form method="post" class="simple-form" >
        <input type="jmeno" name="jmeno" placeholder="Jmeno">
        <input type="prijmeni" name="prijmeni" placeholder="Prijmeni">
        <input type="vek" name="vek" placeholder="Vek ditete">
        <input type="telefon" name="telefon" placeholder="Telefon">
        <input type="email" name="email" placeholder="Email">
        <input type="ulice" name="ulice" placeholder="Ulice">
        <input type="psc" name="psc" placeholder="psc">
        <input type="mesto" name="mesto" placeholder="mesto">
        <input type="submit" name="isSubmitted" value="Přidat dítě">
    </form>
    <?php

    echo '<table align="center" class="blueTable" style="height: 50px;" width="100px">
';

    echo '  
  <thead>
<tr>
<th>Jméno</th>
<th>Přijmení</th>
<th>Věk</th>
<th>Telefon</th>
<th>Email</th>
<th>Ulice</th>
<th>Psc</th>
<th>Mesto</th>
</tr>
</thead>
<tfoot>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
</tfoot>';

    echo ' <tbody>';
    foreach ($data as $row) {

        echo '   
   <tr > 
    <td >' . $row["jmeno"] . '</td >
    <td >' . $row["prijmeni"] . '</td > 
    <td >' . $row["vek"] . '</td >
    <td >' . $row["telefon"] . '</td >
    <td >' . $row["email"] . '</td >
    <td >' . $row["ulice"] . '</td >
    <td >' . $row["psc"] . '</td >
    <td >' . $row["mesto"] . '</td >
    <td>
        <a href="?page=delete-dite&action=delete&id_dite=' . $row["id_dite"] . '">Smazat</a>
        <a href="?page=update_dite&action=delete&id_dite=' . $row["id_dite"] . '">Upravit</a>
    </td>
  </tr >';

    }

    echo '</tBody></table>';
}else{
    echo '<table align="center" class="blueTable" style="height: 50px;" width="100px">
';

    echo '  
  <thead>
<tr>
<th>Jméno</th>
<th>Přijmení</th>
<th>Email</th>
</tr>
</thead>
<tfoot>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
</tfoot>';

    echo ' <tbody>';
    foreach ($data as $row) {

        echo '   
   <tr > 
    <td >' . $row["jmeno"] . '</td >
    <td >' . $row["prijmeni"] . '</td > 
    <td >' . $row["email"] . '</td >
  </tr >';

    }

    echo '</tBody></table>';
}
?></main>
