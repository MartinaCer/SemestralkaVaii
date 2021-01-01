<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Košík</title>
    <link href="../styly.css" rel="stylesheet">
</head>
<body>
<div class="divHlavicka">
    <?php
    include "../menu.php";
    ?>
    <p>Vo vašom nákupnom košíku máte nasledovné produkty. Môžete buď pokračovať v nákupe alebo objednávku uzavrieť.</p>
</div>
<table>
    <thead>
    <tr>
        <th>Produkt</th>
        <th>Cena</th>
        <th>Množstvo</th>
        <th>Celkovo</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $celkovo = 0;
    if (isset($_SESSION["kosik"])) {
        while ($produkt = current($_SESSION["kosik"])) {
            $kluc = key($_SESSION["kosik"]);
            $selectprodukt = "select * from produkt where ID='" . $kluc . "'";
            $riadok = mysqli_fetch_assoc(mysqli_query($mysqli, $selectprodukt));
            ?>
            <tr>
                <td>
                    <?php echo $riadok["meno"]; ?>
                </td>
                <td><?php echo $riadok["cena"] . " €"; ?> </td>
                <td>
                    <form method="post">
                        <input type="number" class="cislo" value="<?php echo $_SESSION["kosik"][$kluc] ?>" min="1"
                               name="mnozstvo" required>
                        <input type="hidden" value="<?php echo $kluc ?>" name="produkt">
                        <input type="submit" class="button" value="Zmeň" name="zmenMnozstvo">
                    </form>
                </td>
                <td><?php
                    $celkovoprodukt = $riadok["cena"] * $_SESSION["kosik"][$kluc];
                    $celkovo += $celkovoprodukt;
                    echo $celkovoprodukt . " €";
                    ?> </td>
            </tr>
            <?php
            next($_SESSION["kosik"]);
        }
    }
    ?>
    <tr>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="3">
            <h2>Celková cena: <?php echo $celkovo . " €"; ?></h2>
            <button id="objednaj" class="button">Objednaj</button>
        </td>
        <td>
            <form method="get">
                <input type="submit" value="Vymaž košík" name="vymaz" class="button">
            </form>
        </td>
    </tr>
    </tbody>
</table>
<div id="objednajModal" class="divModal">
    <div class="modalText">
        <span class="modalZavri">&times;</span>
        <h1>Skutočne chcete kúpiť tovar v hodnote: </h1>
        <h1><?php echo $celkovo . " €" . "?"; ?></h1>
        <form method="post">
            <input type="submit" value="Áno, chcem objednať" name="modalObjednaj" class="button">
        </form>
    </div>
</div>
<div id="prazdnyModal" class="divModal">
    <div class="modalText">
        <span class="modalZavri">&times;</span>
        <h1>Váš košík je prázdny!</h1>
    </div>
</div>
<script>
    var suma = <?php echo $celkovo?>;
    var modal = suma > 0 ? document.getElementById("objednajModal") : document.getElementById("prazdnyModal");
    document.getElementById("objednaj").onclick = function () {
        modal.style.display = "block";
    }
    document.getElementsByClassName("modalZavri")[0].onclick = function () {
        modal.style.display = "none";
    }
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>
</html>
<?php
if (isset($_POST["zmenMnozstvo"])) {
    $produktId = $_POST["produkt"];
    $noveMnozstvo = $_POST["mnozstvo"];
    $_SESSION["kosik"][$produktId] = $noveMnozstvo;
    header("Refresh:0; url=kosik.php");
}
if (isset($_GET["vymaz"])) {
    $_SESSION["kosik"] = array();
    header("Refresh:0; url=kosik.php");
}
if (isset($_POST["modalObjednaj"])) {
    $id = $_SESSION["id"];
    $pocetPoloziek = 0;
    foreach ($_SESSION["kosik"] as $k => $v) {
        $pocetPoloziek += $v;
        $updateProdukt = "update produkt set pocetPredanych = pocetPredanych + '$v' where ID = '$k'";
        mysqli_query($mysqli, $updateProdukt);
    }
    $insert = "insert into historia(IDpouzivatel, pocetPoloziek, suma) values('$id', '$pocetPoloziek', '$celkovo')";
    mysqli_query($mysqli, $insert);
    $_SESSION["kosik"] = array();
    $celkovo = 0;
    header("Refresh:0; url=../produkty/produkty.php");
}