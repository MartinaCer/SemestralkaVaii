<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Košík</title>
    <link href="styly.css" rel="stylesheet">
</head>
<body>
<div class="divHlavicka">
    <h1>Najlepší e-shop</h1>
    <p>Vo vašom nákupnom košíku máte nasledovné produkty. Môžete buď pokračovať v nákupe alebo objednávku uzavrieť.</p>
</div>
<?php
include "menu.php";
if (!isset($_SESSION["meno"])) {
    header("Location: prihlasenie.php");
};
?>
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
            <h2><?php echo $_SESSION["admin"]; ?> Celková cena: <?php echo $celkovo . " €"; ?>
                <h2>
                    <form method="post" action="objednavka.php">
                        <input type="submit" value="Objednaj" name="objednaj" class="button">
                    </form>
        </td>
        <td>
            <form method="get">
                <input type="submit" value="Vymaž košík" name="vymaz" class="button">
            </form>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
<?php
if (isset($_POST["zmenMnozstvo"])) {
    $noveMnozstvo = $_POST["mnozstvo"];
    $produktId = $_POST["produkt"];
    $_SESSION["kosik"][$produktId] = $noveMnozstvo;
    header("Refresh:0; url=kosik.php");
}
if (isset($_GET["vymaz"])) {
    $_SESSION["kosik"] = array();
    header("Refresh:0; url=kosik.php");
}