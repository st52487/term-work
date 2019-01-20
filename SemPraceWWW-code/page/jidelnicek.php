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
        try {
            if (move_uploaded_file($_FILES['jsonFile']['tmp_name'], $uploadfile)) {
                $data = file_get_contents($uploadfile); // put the contents of the file into a variable
                $obj = json_decode($data); // decode the JSON feed

                foreach ($obj as $obj) {
                    $stmt = $conn->prepare("INSERT INTO jidelnicek(polivka, hlavni_jidlo, svacina, id_trida, den) VALUES 
(:polivka, :hlavni_jidlo,:svacina,:id_trida,:den)");
                    $stmt->bindParam(':polivka', $obj->polivka);
                    $stmt->bindParam(':hlavni_jidlo', $obj->hlavniJidlo);
                    $stmt->bindParam(':svacina', $obj->svacina);
                    $stmt->bindParam(':id_trida', $obj->idTrida);
                    $stmt->bindParam(':den', $obj->den);
                    $stmt->execute();
                }
            }
        }catch(Exception $e) {
            echo 'Chyba: ' .$e->getMessage();
        }
        echo "Import proveden!";
    }
}


if($_SESSION["role"] == 'reditel') {?>
<form method="post" enctype="multipart/form-data" class="simple-form" >JHSon file
    <input type="file" name="jsonFile">
    <br>
    <input type="submit" value="Import" name="buttonImport">
</form></main>
<?php } ?>


scaddddddddddJIDELCNICIDFIWf
d
s
fsd
f
e
