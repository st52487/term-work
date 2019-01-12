<?php
$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = $conn->query("SELECT id,email,username,created FROM users")->fetchAll();
echo '<table style="width:100%" border="1">';

echo '  
  <tr>
    <th>Id</th>
    <th>Email</th> 
    <th>username</th>
    <th>Created</th>
    <th>Actions</th>
  </tr>';

foreach ($data as $row) {

    echo '   
   <tr > 
   <td >' . $row["id"] . '</td >
    <td >' . $row["email"] . '</td >
    <td >' . $row["username"] . '</td > 
    <td >' . $row["created"] . '</td >
    <td>
        <a href="?page=user-update&action=update&id='.$row["id"].'">U</a>
        <a href="?page=delete-user&action=delete&id='.$row["id"].'">D</a>
        <a href="?page=user-add">A</a>
    </td>
  </tr >';

}

echo '</table>';