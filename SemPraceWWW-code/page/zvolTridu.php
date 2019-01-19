
<main>
    <section id="hero">
        <div>
            <h1 style="font-family: 'Calibri Light'">Mateřská škola Sluníčko</h1>
        </div>
    </section>
<?php

/*if(basename(__FILE__) == 'zvolTridu.php') { ?>
    <section id="hero">
        <div>
            <h1 style="font-family: 'Calibri Light'">Mateřská škola Sluníčko</h1>
        </div>
    </section>
<?php }*/


$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = $conn->query("SELECT id_trida,nazev FROM trida")->fetchAll();

if($_SESSION["role"] != 'reditel') {
    echo '<table width="400px" border="1">';

    echo '  
  <tr>
    <th>Nazev třídy</th>
  </tr>';

    foreach ($data as $row) {

        echo '   
   <tr > 
   <td ><a href="?page=show-class&action=open&id_trida=' . $row["id_trida"] . '">' . $row["nazev"] . '</a></td >
  </tr >';
    }
    echo '</table>';
}


if($_SESSION["role"] == 'reditel') { ?>
<a href="?page=add_class">Přidat třídu</a>
<?php

echo '<table width="400px" border="1">';

echo '  
  <tr>
    <th>Nazev</th>
  </tr>';

foreach ($data as $row) {

    echo '   
   <tr > 
   <td ><a href="?page=show-class&action=open&id_trida='.$row["id_trida"].'">'.$row["nazev"].'</a></td >
   <td>
        <a href="?page=delete_class&action=delete&id_trida=' . $row["id_trida"] . '">Smazat</a></td> 
  </tr >';

}

echo '</table>';
}
?></main>
