<?php

if (!empty($_POST) && !empty($_POST["loginMail"]) && !empty($_POST["loginPassword"])) {

    //connect to database
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //get user by email and password
    $stmt = $conn->prepare("select prijmeni, druhrole from ucitel join role USING (id_role)
join users USING (id_ucitel) WHERE prihlasovacijmeno= :email and heslo = :password");

    $stmt->bindParam(':email', $_POST["loginMail"]);
    $stmt->bindParam(':password', md5($_POST["loginPassword"]));
    $stmt->execute();
    $user = $stmt->fetch();
    if (!$user) {
        echo "user not found";
    } else {
        echo "you are logged in. Your ID is: " . $user["prijmeni"];
        $_SESSION["username"] = $user["prijmeni"];
        $_SESSION["role"] = $user["druhrole"];
        header("Location:" . BASE_URL);
    }

} else if (!empty($_POST)) {
    echo "Username and password are required";
}


?>


<form method="post">

    <input type="email" name="loginMail" placeholder="Insert your email">
    <input type="password" name="loginPassword" placeholder="Password">
    <input type="submit" value="Log in">

</form>