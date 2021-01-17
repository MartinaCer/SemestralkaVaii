<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrátor</title>
    <link href="../styly.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="administratorScript.js"></script>
</head>
<body>
<div class="divHlavicka">
    <?php
    include "../menu.php";
    ?>
    <p>Administrácia</p>
</div>
<ul class="adminMenu">
    <li class="adminMenuStranka"><a class="adminMenuFont" id="pouzivatelia">Všetci používatelia</a></li>
    <li class="adminMenuStranka"><a class="adminMenuFont" id="objednavky">Všetky objednávky</a></li>
    <li class="adminMenuStranka"><a class="adminMenuFont" id="produkty">Uprav produkty</a></li>
    <li class="adminMenuStranka"><a class="adminMenuFont" id="pridajProdukt">Pridaj produkt</a></li>
</ul>
<table id="tabulka">
    <thead>
    </thead>
    <tbody>
    </tbody>
</table>
<div id="pridajProduktModal" class="divModal">
    <div class="modalText">
        <span class="modalZavri">&times;</span>
        <h1>Pridaj nový produkt: </h1>
        <form method="post">
            <label for="nazov">Názov produktu</label><br>
            <input type="text" placeholder="Názov" name="nazov" id="nazov" required><br><br>
            <label for="nazov">Súbor s obrázkom produktu (nemusí byť zadaný)</label><br>
            <input type="text" placeholder="Obrázok" name="obrazok" id="obrazok"><br><br>
            <label for="nazov">Cena produktu</label><br>
            <input type="number" placeholder="Cena" name="cena" min="1" id="cena" required><br><br>
            <input type="submit" value="Pridaj produkt" name="pridaj" class="button">
        </form>
    </div>
</div>
<div id="vymazProduktModal" class="divModal">
    <div class="modalText">
        <span class="modalZavri">&times;</span>
        <h1>Chcete naozaj vymazať tento produkt?</h1>
        <form id="vymazFormModal" method="post">
            <input type="submit" value="Áno, chcem vymazať produkt!" name="anoVymaz" id="anoVymaz" class="button">
        </form>

    </div>
</div>
<div id="upravProduktModal" class="divModal">
    <div class="modalText">
        <span class="modalZavri">&times;</span>
        <h1>Zadajte nové informácie o produkte:</h1>
        <form id="upravFormModal" method="post"></form>
    </div>
</div>
</body>
</html>
<?php
if (isset($_POST["pridaj"])) {
    $nazov = $_POST["nazov"];
    $obrazok = $_POST["obrazok"];
    $cena = $_POST["cena"];
    $insert = "insert into produkt(meno, obrazok, cena) values('$nazov', '$obrazok', '$cena')";
    mysqli_query($mysqli, $insert);
}
if (isset($_POST["anoVymaz"])) {
    $id = $_POST["idProduktuVymaz"];
    $delete = "delete from produkt where ID='" . $id . "'";
    mysqli_query($mysqli, $delete);
}
if (isset($_POST["anoUprav"])) {
    $id = $_POST["idProduktuUprav"];
    $nazov = $_POST["nazov"];
    $obrazok = $_POST["obrazok"];
    $cena = $_POST["cena"];
    $update = "update produkt set meno='" . $nazov . "', obrazok='" . $obrazok . "', cena='" . $cena . "' where ID ='" . $id . "'";
    mysqli_query($mysqli, $update);
}