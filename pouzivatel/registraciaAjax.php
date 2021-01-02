<?php
require_once "../pripojenie.php";
$meno = $_POST["meno"];
$heslo = $_POST["heslo"];
$hesloKontrola = $_POST["hesloKontrola"];
$mail = $_POST["email"];
$cislo = $_POST["telefon"];
$hashHeslo = password_hash($heslo, PASSWORD_DEFAULT);
if ($meno != "" && $heslo != "") {
    if ($heslo == $hesloKontrola) {
        $query = "select count(*) as pocet from pouzivatel where meno='" . $meno . "'";
        $vysledok = mysqli_query($mysqli, $query);
        $riadok = mysqli_fetch_array($vysledok);
        $pocet = $riadok["pocet"];
        if ($pocet == 0) {
            $insert = "insert into pouzivatel(meno, heslo, mail, telefon) values ('$meno', '$hashHeslo', '$mail', '$cislo')";
            mysqli_query($mysqli, $insert);
            echo "";
        } else
            echo "<h2>Toto meno sa už používa!</h2>";
    } else
        echo "<h2>Heslá sa nezhodujú!</h2>";
}