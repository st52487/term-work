<?php
$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = $conn->query("SELECT nazev FROM trida")->fetchAll();
echo '<table style="width:100%" border="1">';

echo '  
  <tr>
    <th>nazev</th>
    <th>Obrazek</th>
  </tr>';

foreach ($data as $row) {

    echo '   
   <tr > 
   <td >' . $row["nazev"] . '</td > 
   <td ><a href="?page=show-class&action=update&nazev='.$row["nazev"].'">sdadsadsa</a></td >
  </tr >';

}

echo '</table>';