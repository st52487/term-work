<!--<style>
    table.blueTable {
        border: 1px solid #1C6EA4;
        background-color: #EEEEEE;
        text-align: left;
        border-collapse: collapse;
    }
    table.blueTable td, table.blueTable th {
        border: 2px solid #AAAAAA;
        padding: 3px 2px;
    }
    table.blueTable tbody td {
        font-size: 13px;
    }
    table.blueTable tr:nth-child(even) {
        background: #D0E4F5;
    }
    table.blueTable thead {
        background: #1C6EA4;
        background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        border-bottom: 6px solid #444444;
    }
    table.blueTable thead th {
        font-size: 15px;
        font-weight: bold;
        color: #FFFFFF;
        border-left: 2px solid #D0E4F5;
    }
    table.blueTable thead th:first-child {
        border-left: none;
    }

    table.blueTable tfoot {
        font-size: 14px;
        font-weight: bold;
        color: #FFFFFF;
        background: #D0E4F5;
        background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
        background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
        background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
        border-top: 2px solid #444444;
    }
    table.blueTable tfoot td {
        font-size: 14px;
    }
    table.blueTable tfoot .links {
        text-align: right;
    }
    table.blueTable tfoot .links a{
        display: inline-block;
        background: #1C6EA4;
        color: #FFFFFF;
        padding: 2px 8px;
        border-radius: 5px;
    }
</style>-->



<?php
$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = $conn->query("select id_ucitel,jmeno,prijmeni,druhrole,nazev from ucitel join role r on ucitel.id_role = r.id_role join trida t on ucitel.id_trida = t.id_trida;")->fetchAll();

?>
<a href="?page=user-add">Přidat uživatele</a>

<?php
echo '<table align="center" class="blueTable" style="height: 50px;" width="100px">
';

echo '  
  <thead>
<tr>
<th>Id</th>
<th>Jméno</th>
<th>Přijmení</th>
<th>Role</th>
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
    <td >' . $row["nazev"] . '</td >
    <td>
        <a href="?page=user-update&action=update&id_ucitel='.$row["id_ucitel"].'">U</a>
        <a href="?page=delete-user&action=delete&id_ucitel='.$row["id_ucitel"].'">D</a>
    </td>
  </tr >';

}

echo '</tBody></table>';