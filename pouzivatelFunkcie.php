<?php
require_once "pripojenie.php";

function prihlas($meno, $heslo, $mysqli)
{
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
                header("Location: produkty.php");
            } else {
                echo "<h2>Zadali ste nesprávne heslo!</h2>";
            }
        } else {
            echo "<h2>Zadali ste nesprávne meno!</h2>";
        }
    }
}

function registruj($meno, $heslo, $hesloKontrola, $mail, $cislo, $mysqli)
{
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
                header("Location: prihlasenie.php");
            } else
                echo "<h2>Toto meno sa už používa!</h2>";
        } else
            echo "<h2>Heslá sa nezhodujú!</h2>";
    }
}

function zmazUcet($heslo, $mysqli)
{
    $selectPouzivatel = "select * from pouzivatel where ID ='" . $_SESSION["id"] . "'";
    $riadok = mysqli_fetch_assoc(mysqli_query($mysqli, $selectPouzivatel));
    if (password_verify($heslo, $riadok["heslo"])) {
        $id = $_SESSION["id"];
        $deleteHistoria = "delete from historia where IDpouzivatel='" . $id . "'";
        mysqli_query($mysqli, $deleteHistoria);
        $deletePouzivatel = "delete from pouzivatel where ID='" . $id . "'";
        mysqli_query($mysqli, $deletePouzivatel);
        header("Location: odhlasenie.php");
    } else {
        echo "<h2>Zadali ste nesprávne heslo!</h2>";
    }
}