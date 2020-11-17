<?php
require_once "pripojenie.php";
$operacia = $_GET["operacia"];
$jsonPole = array();
switch ($operacia) {
    case 1:
        $select = "select * from pouzivatel";
        $vysledok = mysqli_query($mysqli, $select);
        while ($riadok = mysqli_fetch_assoc($vysledok)) {
            $meno = $riadok["meno"];
            $datum = $riadok["registracia"];
            $jeAdmin = $riadok["admin"] == 1 ? "áno" : "nie";
            $jsonPole[] = array("meno" => $meno, "registracia" => $datum, "admin" => $jeAdmin);
        }
        break;
    case 2:
        $select = "select * from historia join pouzivatel on(historia.IDpouzivatel = pouzivatel.ID)";
        $vysledok = mysqli_query($mysqli, $select);
        while ($riadok = mysqli_fetch_assoc($vysledok)) {
            $meno = $riadok["meno"];
            $datum = $riadok["datum"];
            $suma = $riadok["suma"] . " €";
            $jsonPole[] = array("meno" => $meno, "datum" => $datum, "suma" => $suma);
        }
        break;
    case 3:
        $select = "select * from produkt";
        $vysledok = mysqli_query($mysqli, $select);
        while ($riadok = mysqli_fetch_assoc($vysledok)) {
            $meno = $riadok["meno"];
            $obrazok = $riadok["obrazok"];
            $cena = $riadok["cena"];
            $jsonPole[] = array("meno" => $meno, "obrazok" => $obrazok, "cena" => $cena);
        }
        break;
}
echo json_encode($jsonPole);