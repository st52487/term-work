<main>
    <section id="hero">
        <div>
            <h1 style="font-family: 'Calibri Light'">Mateřská škola Sluníčko</h1>
        </div>
    </section>
<?php
$errorFeedbacks = array();
$successFeedback = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST["prihlasovacijmeno"])) {
        $feedbackMessage = "username is required";
        array_push($errorFeedbacks, $feedbackMessage);
    }

    if (empty($_POST["heslo"])) {
        $feedbackMessage = "password is required";
        array_push($errorFeedbacks, $feedbackMessage);
    }

    if (empty($errorFeedbacks)) {
        //success
        $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO ucitel (jmeno, prijmeni, id_role,id_trida,telefon) 
    VALUES (:jmeno, :prijmeni, :id_role, :id_trida,:telefon)");
        $stmt->bindParam(':jmeno', $_POST["jmeno"]);
        $stmt->bindParam(':prijmeni', $_POST["prijmeni"]);
        $stmt->bindParam(':id_role', $_POST["select"]);
        $stmt->bindParam(':id_trida', $_POST["selectTrida"]);
        $stmt->bindParam(':telefon', $_POST["telefon"]);
        $stmt->execute();

        $stmt = $conn->prepare("SELECT id_ucitel FROM ucitel WHERE jmeno = :jmeno AND prijmeni = :prijmeni");
        $stmt->bindParam(':jmeno', $_POST["jmeno"]);
        $stmt->bindParam(':prijmeni', $_POST["prijmeni"]);
        $stmt->execute();

        $user = $stmt->fetch();

        $stmt = $conn->prepare("INSERT INTO users(prihlasovacijmeno, heslo, id_ucitel) VALUES 
(:prihlasovacijmeno,:heslo,:id)");
        $stmt->bindParam(':prihlasovacijmeno', $_POST["prihlasovacijmeno"]);
        $stmt->bindParam(':heslo', md5($_POST["heslo"]));
        $stmt->bindParam(':id', $user["id_ucitel"]);
        $stmt->execute();




        $successFeedback = "Uživatel přidán!";
    }
}

?>

<?php
if (!empty($errorFeedbacks)) {
    echo "Form contains following errors:<br>";
    foreach ($errorFeedbacks as $errorFeedback) {
        echo $errorFeedback . "<br>";
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($successFeedback)) {
    echo $successFeedback;
}
?>

<form method="post" class="simple-form" >
    <input type="jmeno" name="jmeno" placeholder="Your name"/>
    <input type="prijmeni" name="prijmeni" placeholder="Your prijmeni">

    <?php
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id_role, druhrole FROM role";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) { ?>
        <select name="select" id="select">

        <?php foreach ($results as $row) { ?>
                <option value="<?php echo $row['id_role']; ?>"><?php echo $row['druhrole']; ?></option>
            <?php } ?>
        </select>
    <?php } ?>

    <input type="prihlasovacijmeno" name="prihlasovacijmeno" placeholder="Prihlasovaci jmeno">
    <input type="heslo" name="heslo" placeholder="Heslo">

    <?php
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id_trida,nazev FROM trida";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) { ?>
        <select name="selectTrida" id="selectTrida">

            <?php foreach ($results as $row) { ?>
                <option value="<?php echo $row['id_trida']; ?>"><?php echo $row['nazev']; ?></option>
            <?php } ?>
        </select>
    <?php } ?>
    <input type="telefon" name="telefon" placeholder="Telefon">
    <input type="submit" name="isSubmitted" value="Přidat">
</form>
</main>