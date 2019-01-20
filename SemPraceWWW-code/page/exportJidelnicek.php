<?php
include '../config.php';
$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * from jidelnicek";
    $pole = array();
    if ($data = $conn->query($sql)) {
        while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
            $pole[] = $row;
        }

        $pole1 = json_encode($pole, JSON_UNESCAPED_UNICODE);
    }

    $adresa = './uploads/historie.json';
    file_put_contents($adresa, $pole1);


    if (file_exists($adresa)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($adresa));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($adresa));
        ob_clean();
        flush();
        readfile($adresa);
        unlink($adresa);
        exit;

}