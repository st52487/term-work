<main>
    <section id="hero">
        <div>
            <h1 style="font-family: 'Calibri Light'">Mateřská škola Sluníčko</h1>
        </div>
    </section>



<?php
$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = $conn->query("select id_ucitel,jmeno,prijmeni,druhrole,telefon, nazev from ucitel join role r on ucitel.id_role = r.id_role join trida t on ucitel.id_trida = t.id_trida;")->fetchAll();

?>
<?php if($_SESSION["role"] == 'reditel') {?>
    <a href="?page=user-add">Přidat uživatele</a>

    <?php
    echo '<table align="center" class="blueTable" style="height: 50px;" width="100px">
';

    echo '  
  <thead>
<tr>
<th>Jméno</th>
<th>Přijmení</th>
<th>Role</th>
<th>Telefon</th>
<th>Třída</th>
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
    <td >' . $row["druhrole"] . '</td >
     <td >' . $row["telefon"] . '</td >
    <td >' . $row["nazev"] . '</td >
    <?php if ($_SESSION["role"] == \'reditel\') { ?>
    <td>
        <a href="?page=user-update&action=update&id_ucitel=' . $row["id_ucitel"] . '">U</a>
        <a href="?page=delete-user&action=delete&id_ucitel=' . $row["id_ucitel"] . '">D</a>
    </td>
    <?php } ?>
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
<th>Role</th>
<th>Telefon</th>
<th>Třída</th>
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
    <td >' . $row["druhrole"] . '</td >
     <td >' . $row["telefon"] . '</td >
    <td >' . $row["nazev"] . '</td >
  </tr >';

    }

    echo '</tBody></table>';
}?></main>