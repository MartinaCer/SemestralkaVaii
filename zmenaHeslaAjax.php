<?php
require_once "pripojenie.php";
$stare = $_POST["stare"];
$nove = $_POST["nove"];
$noveKontrola = $_POST["noveKontrola"];
$selectPouzivatel = "select heslo from pouzivatel where ID ='" . $_SESSION["id"] . "'";
$riadok = mysqli_fetch_assoc(mysqli_query($mysqli, $selectPouzivatel));
if (password_verify($stare, $riadok["heslo"])) {
    if ($nove == $noveKontrola) {
        $hashNoveHeslo = password_hash($nove, PASSWORD_DEFAULT);
        $updateHeslo = "update pouzivatel set heslo='" . $hashNoveHeslo . "' where ID ='" . $_SESSION["id"] . "'";
        mysqli_query($mysqli, $updateHeslo);
        echo "<h2>Heslo bolo zmenené!</h2>";
    }
} else {
    echo "<h2>Chyba!</h2>";
}