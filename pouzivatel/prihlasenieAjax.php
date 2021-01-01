<?php
require_once "../pripojenie.php";
$meno = $_POST["meno"];
$heslo = $_POST["heslo"];
if ($meno != "" && $heslo != "") {
    $selectMeno = "select count(*) as pocet from pouzivatel where meno='" . $meno . "'";
    $vysledok = mysqli_query($mysqli, $selectMeno);
    $riadok = mysqli_fetch_array($vysledok);
    $pocet = $riadok["pocet"];
    if ($pocet > 0) {
        $selectHeslo = "select * from pouzivatel where meno='" . $meno . "'";
        $vysledok1 = mysqli_query($mysqli, $selectHeslo);
        $riadok1 = mysqli_fetch_array($vysledok1);
        $hashHeslo = $riadok1["heslo"];
        if (password_verify($heslo, $hashHeslo)) {
            $_SESSION["meno"] = $meno;
            $_SESSION["id"] = $riadok1["ID"];
            $_SESSION["admin"] = $riadok1["admin"];
            //echo "<h2>Podarilo sa!</h2>";
            header("Location: ../produkty/produkty.php");
        } else {
            echo "<h2>Zadali ste nesprávne heslo!</h2>";
        }
    } else {
        echo "<h2>Zadali ste nesprávne meno!</h2>";
    }
}