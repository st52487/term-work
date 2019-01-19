<main>
    <section id="hero">
        <div>
            <h1 style="font-family: 'Calibri Light'">Mateřská škola Sluníčko</h1>
        </div>
    </section>

<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploaddir = './uploads/';
    $uploadfile = $uploaddir . basename($_FILES['jsonFile']['name']);
    $extension = array("json", "JSON");
    $UploadOk = true;

    $ext = pathinfo($_FILES["jsonFile"]["name"], PATHINFO_EXTENSION);
    if (in_array($ext, $extension) == false) {
        $UploadOk = false;
        echo "<p class='hlaska'>Neplatny soubor</p>";

    }

    if ($UploadOk == true) {
        if (move_uploaded_file($_FILES['jsonFile']['tmp_name'], $uploadfile)) {

            $jsondata = file_get_contents($uploadfile);
            $obj = json_decode($jsondata, true);
            echo "JE TO TAM!!!";
        }
    }
}

?>

<form method="post" enctype="multipart/form-data" class="simple-form" >JHSon file
    <input type="file" name="jsonFile">
    <br>
    <input type="submit" value="Import" name="buttonImport">
</form></main>
