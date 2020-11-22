<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkty</title>
    <link href="styly.css" rel="stylesheet">
</head>
<body>
<div class="divHlavicka">
    <?php
    include "menu.php";
    ?>
    <p>Vyberte si produkt! Ak vás nejaký produkt z našej bohatej ponuky zaujal, neváhajte a kúpte si ho.</p>
</div>
<section class="sectionProdukty">
    <?php
    $selectProdukty = "select * from produkt order by ID";
    $produkty = mysqli_query($mysqli, $selectProdukty);
    while ($riadok = $produkty->fetch_array()) {
        ?>
        <div class="produktObal">
            <div class="produktObrazok">
                <img alt="<?php echo $riadok["meno"]; ?>" src="obrazky/<?php echo $riadok["obrazok"]; ?>">
            </div>
            <div class="produktInfo">
                <h2><?php echo $riadok["meno"]; ?></h2>
                <h3><?php echo $riadok["cena"] . " €"; ?></h3>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $riadok["ID"]; ?>">
                    <input class="cislo" type="number" name="mnozstvo" value="1" min="1"/>
                    <input class="button" name="vloz" type="submit" value="Vlož do košíka">
                </form>
            </div>
        </div>
        <?php
    }
    ?>
</section>
</body>
</html>
<?php
if (isset($_POST["vloz"])) {
    vlozDoKosika((int)$_POST["id"], (int)$_POST["mnozstvo"], $mysqli);
}