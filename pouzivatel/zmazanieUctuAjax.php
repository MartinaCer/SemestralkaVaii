<?php
require_once "../pripojenie.php";
$selectPouzivatel = "select * from pouzivatel where ID ='" . $_SESSION["id"] . "'";
$riadok = mysqli_fetch_assoc(mysqli_query($mysqli, $selectPouzivatel));
if (password_verify($_POST["heslo"], $riadok["heslo"])) {
    $id = $_SESSION["id"];
    $deleteHistoria = "delete from historia where IDpouzivatel='" . $id . "'";
    mysqli_query($mysqli, $deleteHistoria);
    $deletePouzivatel = "delete from pouzivatel where ID='" . $id . "'";
    mysqli_query($mysqli, $deletePouzivatel);
    echo "";
} else {
    echo "<h2>Zadali ste nesprávne heslo!</h2>";
}