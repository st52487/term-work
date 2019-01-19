<main>
    <section id="hero">
        <div>
            <h1 style="font-family: 'Calibri Light'">Mateřská škola Sluníčko</h1>
        </div>
    </section>
<?php
$errorFeedbacks = array();
$successFeedback = "";

$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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


        $stmt = $conn->prepare("UPDATE users SET prihlasovacijmeno= :prihlJmeno, heslo= :heslo WHERE id_ucitel= :id");
        $stmt->bindParam(':id', $_GET["id_ucitel"]);
        $stmt->bindParam(':prihlJmeno', $_POST["prihlasovacijmeno"]);
        $stmt->bindParam(':heslo', md5($_POST["heslo"]));
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE ucitel SET jmeno= :jmeno, prijmeni= :prijmeni, id_role = :id_role, id_trida = :id_trida WHERE id_ucitel= :id");
        $stmt->bindParam(':id', $_GET["id_ucitel"]);
        $stmt->bindParam(':jmeno', $_POST["jmeno"]);
        $stmt->bindParam(':prijmeni', $_POST["prijmeni"]);
        $stmt->bindParam(':id_role', $_POST["select"]);
        $stmt->bindParam(':id_trida', $_POST["selectTrida"]);
        $stmt->execute();


        $successFeedback = "User was updated";
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

<?php
if (empty($errorFeedbacks)) { //load data origin data from database
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("select jmeno,prijmeni,druhrole,prihlasovacijmeno,nazev, t.id_trida,r.id_role from ucitel join trida t on ucitel.id_trida = t.id_trida
join role r on ucitel.id_role = r.id_role join users u on ucitel.id_ucitel = u.id_ucitel where u.id_ucitel = :id");
    $stmt->bindParam(':id', $_GET["id_ucitel"]);
    $stmt->execute();
    $user = $stmt->fetch();

    $jmeno = $user["jmeno"];
    $prijmeni = $user["prijmeni"];
    $druhRole = $user["druhrole"];
    $prihlasJmeno = $user["prihlasovacijmeno"];
    $nazev = $user["nazev"];
}
?>

<form method="post" class="simple-form">
    <input type="jmeno" name="jmeno" value="<?= $jmeno; ?>"/>
    <input type="prijmeni" name="prijmeni" value="<?= $prijmeni; ?>"/>
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
    <input type="prihlasovacijmeno" name="prihlasovacijmeno" value="<?= $prihlasJmeno; ?>"/>
    <input type="heslo" name="heslo" placeholder="heslo"/>
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
    <input type="submit" name="isSubmitted" value="yes">
</form></main>