<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zmazanie účtu</title>
    <link href="styly.css" rel="stylesheet">
</head>
<body>
<div class="divHlavicka">
    <h1>Najlepší e-shop</h1>
    <p>To je škoda :(. Ak skutočne chcete zmazať svoj účet, potvrďte voľbu dole.</p>
</div>
<?php
include "menu.php";
if (!isset($_SESSION["meno"])) {
    header("Location: prihlasenie.php");
}
?>
<form class="formular" method="post">
    <input name="heslo" placeholder="Heslo" type="password"><br><br>
    <input class="button" name="zmaz" type="submit" value="Zmaž účet">
</form>
</body>
</html>
<?php if (isset($_POST["zmaz"])) {
    $heslo = $_POST["heslo"];
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