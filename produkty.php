<?php
require_once "pripojenie.php";
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produkty</title>
        <link href="styly.css" rel="stylesheet">
    </head>
    <body>
    <div class="divHlavicka">
        <h1>Najlepší e-shop</h1>
        <p>Vyberte si produkt! Ak vás nejaký produkt z našej bohatej ponuky zaujal, neváhajte a kúpte si ho.</p>
    </div>
    <?php
    include "menu.php";
    ?>
    <section class="sectionProdukty">
        <?php
        for ($i = 1; $i <= 10; $i++) {
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
                        <form action="produkty.php" method="post" name="form">
                            <input type="hidden" name="id" value="<?php echo $riadok["ID"]; ?>">
                            <input class="cislo" type="number" name="mnozstvo" value="1" min="1"/>
                            <input class="button" name="vloz" type="submit" value="Vlož do košíka">
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </section>
    </body>
    </html>