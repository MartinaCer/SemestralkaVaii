<?php
require_once "pripojenie.php";

function vlozDoKosika($id, $mnozstvo, $mysqli)
{
    $selectProdukt = "select * from produkt where ID = '" . $id . "'";
    $vysledok = mysqli_fetch_assoc(mysqli_query($mysqli, $selectProdukt));
    if (!isset($_SESSION["kosik"])) {
        $predmetyVkosiku = array($id => $mnozstvo);
        $_SESSION["kosik"] = $predmetyVkosiku;
    } else {
        if (array_key_exists($id, $_SESSION["kosik"]))
            $_SESSION["kosik"][$id] += $mnozstvo;
        else
            $_SESSION["kosik"][$id] = $mnozstvo;
    }
    exit;
}

function zmenMnozstvoVKosiku($produktId, $noveMnozstvo)
{
    $_SESSION["kosik"][$produktId] = $noveMnozstvo;
    header("Refresh:0; url=kosik.php");
}

function vymazKosik()
{
    $_SESSION["kosik"] = array();
    header("Refresh:0; url=kosik.php");
}

function objednaj($celkovaSuma, $mysqli)
{
    $id = $_SESSION["id"];
    $pocetPoloziek = 0;
    foreach ($_SESSION["kosik"] as $k => $v) {
        $pocetPoloziek += $v;
        $updateProdukt = "update produkt set pocetPredanych = pocetPredanych + '$v' where ID = '$k'";
        mysqli_query($mysqli, $updateProdukt);
    }
    $insert = "insert into historia(IDpouzivatel, pocetPoloziek, suma) values('$id', '$pocetPoloziek', '$celkovaSuma')";
    mysqli_query($mysqli, $insert);
    $_SESSION["kosik"] = array();
}