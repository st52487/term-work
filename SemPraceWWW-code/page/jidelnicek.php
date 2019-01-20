<main>
    <section id="hero">
        <div>
            <h1 style="font-family: 'Calibri Light'">Mateřská škola Sluníčko</h1>
        </div>
    </section>

<?php
$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

            //$jsondata = file_get_contents($uploadfile);
            //$data = file_get_contents($uploadfile); // put the contents of the file into a variable
            //$obj = json_decode($data);
          //  echo "JE TO TAM!!!";
            $data = file_get_contents($uploadfile); // put the contents of the file into a variable
            $obj = json_decode($data); // decode the JSON feed

            foreach ($obj as $obj) {
                echo $obj->polivka . '<br>';
                echo $obj->hlavniJidlo . '<br>';
                echo $obj->svacina . '<br>';
                echo $obj->idTrida . '<br>';
                echo $obj->den . '<br>';



                $stmt = $conn->prepare("INSERT INTO jidelnicek(polivka, hlavni_jidlo, svacina, id_trida, den) VALUES 
(:polivka, :hlavni_jidlo,:svacina,:id_trida,:den)");
                $stmt->bindParam(':polivka', $obj->polivka);
                $stmt->bindParam(':hlavni_jidlo', $obj->hlavniJidlo);
                $stmt->bindParam(':svacina', $obj->svacina);
                $stmt->bindParam(':id_trida', $obj->idTrida);
                $stmt->bindParam(':den', $obj->den);
                $stmt->execute();


             /*   $sql5 = "INSERT INTO `jidelnicek` (`polivka`, `hlavni_jidlo`, `svacina`, `id_trida`, `den`) VALUES (?,?,?,?,?);";
                if ($stmt = $db->prepare($sql5)) {
                    $stmt->bind_param("sssis", $character->polivka, $character->hlavniJidlo, $character->svacina, $character->idTrida,$character->den);
                    $stmt->execute();
                }
               /* echo $obj->hlavniJidlo . '<br>';
                echo $obj->svacina . '<br>';
                echo $obj->idTrida . '<br>';
                echo $obj->den . '<br>';
                echo $character->name . '<br>';*/
            }

           /* foreach ($obj as $obj) {
                echo $obj->polivka . '<br>';
                echo $obj->hlavniJidlo . '<br>';
                echo $obj->svacina . '<br>';
                echo $obj->idTrida . '<br>';
                echo $obj->den . '<br>';
                }
              /*  $sql5 = "INSERT INTO `jidelnicek` (`polivka`, `hlavni_jidlo`, `svacina`, `id_trida`, `den`) VALUES (?,?,?,?,?);";
                if ($stmt = $db->prepare($sql5)) {
                    $stmt->bind_param("sssis", $character->polivka, $character->hlavniJidlo, $character->svacina, $character->idTrida,$character->den);
                    $stmt->execute();
                }
          /*  foreach ($obj as $v) {


                $polivka = $v["polivka"];
                $hlavniJidlo = $v["hlavniJidlo"];
                $svacina = $v["svacina"];
                $idTrida = $v["idTrida"];
                $den = $v["den"];


                echo $polivka;
                echo $hlavniJidlo;
                echo $svacina;
                echo $idTrida;
                echo $den;
                /*$sql5 = "INSERT INTO `jidelnicek` (`polivka`, `hlavni_jidlo`, `svacina`, `id_trida`, `den`) VALUES (?,?,?,?,?);";
                if ($stmt = $db->prepare($sql5)) {
                    $stmt->bind_param("sssis", $polivka, $hlavniJidlo, $svacina, $idTrida, $den);
                    $stmt->execute();
                }*/


            }



        echo "hotovo@@!";
    }
}

?>

<form method="post" enctype="multipart/form-data" class="simple-form" >JHSon file
    <input type="file" name="jsonFile">
    <br>
    <input type="submit" value="Import" name="buttonImport">
</form></main>
