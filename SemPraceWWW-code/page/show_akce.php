<main>
    <section id="hero">
        <div>
            <h1 style="font-family: 'Calibri Light'">Mateřská škola Sluníčko</h1>
        </div>
    </section>
<?php
$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("select trida.nazev,akce_skoly.nazev, akce_skoly.popis,datum,id_akce
from trida join trida_akce using (id_trida) join akce_skoly using (id_akce)");
$stmt->execute();

$data = $stmt->fetchAll();


if ($_SESSION["role"] == 'reditel') {
    echo '<table align="center" class="blueTable" style="height: 50px;" width="100px">
';

    echo '  
  <thead>
<tr>
<th>Nazev třídy</th>
<th>Nazev akce</th>
<th>Popis akce</th>
<th>Datum konání</th>
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
    <td >' . $row[0] . '</td >
    <td >' . $row[1] . '</td > 
    <td >' . $row[2] . '</td >
    <td >' . $row[3] . '</td >
    <td>
        <a href="?page=delete_akce&action=delete&id_akce=' . $row["id_akce"] . '">D</a>
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
<th>Nazev třídy</th>
<th>Nazev akce</th>
<th>Popis akce</th>
<th>Datum konání</th>
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
      <td >' . $row[0] . '</td >
    <td >' . $row[1] . '</td > 
    <td >' . $row[2] . '</td >
    <td >' . $row[3] . '</td >
  </tr >';

    }

    echo '</tBody></table>';
}?></main>
