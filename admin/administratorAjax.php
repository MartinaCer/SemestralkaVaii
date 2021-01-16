<?php
require_once "../pripojenie.php";
$operacia = $_GET["operacia"];
$jsonPole = array();
switch ($operacia) {
    case 1:
        $select = "select * from pouzivatel";
        $vysledok = mysqli_query($mysqli, $select);
        while ($riadok = mysqli_fetch_assoc($vysledok)) {
            $jsonPole[] = array("meno" => $riadok["meno"], "mail" => $riadok["mail"], "telefon" => $riadok["telefon"],
                "registracia" => $riadok["registracia"], "admin" => $riadok["admin"] == 1 ? "áno" : "nie");
        }
        break;
    case 2:
        $select = "select * from historia join pouzivatel on(historia.IDpouzivatel = pouzivatel.ID)";
        $vysledok = mysqli_query($mysqli, $select);
        while ($riadok = mysqli_fetch_assoc($vysledok)) {
            $jsonPole[] = array("meno" => $riadok["meno"], "datum" => $riadok["datum"],
                "pocet" => $riadok["pocetPoloziek"], "suma" => $riadok["suma"] . " €");
        }
        break;
    case 3:
        $select = "select * from produkt";
        $vysledok = mysqli_query($mysqli, $select);
        while ($riadok = mysqli_fetch_assoc($vysledok)) {
            $updateProdukt = "<button class='button' onclick='upravProdukt()'>Uprav</button>";
            $vymazProdukt = "<button class='button' onclick='vymazProdukt()'>Vymaž</button>";
            $jsonPole[] = array("meno" => $riadok["meno"], "obrazok" => $riadok["obrazok"],
                "cena" => $riadok["cena"] . " €", "pocet" => $riadok["pocetPredanych"],
                "akcia" => $updateProdukt." ".$vymazProdukt, "id"=> $riadok["ID"]);
        }
        break;
}
echo json_encode($jsonPole);