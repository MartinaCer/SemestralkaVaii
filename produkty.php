<?php
require_once "pripojenie.php";
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produkty</title>
        <link href="styly.css" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
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

    <script>
        $(document).ready(function () {
            $('form').submit(function (event) {
                var data = {
                    'id': $('input[name=id]').val(),
                    'mnozstvo': $('input[name=mnozstvo]').val(),
                    'pridaj': "pridaj"
                };
                $.ajax({
                    type: 'POST',
                    url: 'produkty.php',
                    data: data,
                    dataType: 'json',
                    encode: true
                }).done(function (data) {
                    console.log(data);
                });
                event.preventDefault();
            });
        });
    </script>

<?php
if (isset($_POST['pridaj'])) {
    $chyby = array();
    $data = array();
    if (empty($_POST['id']))
        $chyby['id'] = 'Musí byť zadané id produktu.';
    if (empty($_POST['mnozstvo']))
        $chyby['mnozstvo'] = 'Musí byť zadané množstvo.';
    if (!empty($chyby)) {
        $data['success'] = false;
        $data['chyby'] = $chyby;
    } else {
        $id = (int)$_POST["id"];
        $mnozstvo = (int)$_POST["mnozstvo"];
        $selectProdukt = "select * from produkt where ID = '" . $id . "'";
        $vysledok = mysqli_fetch_assoc(mysqli_query($mysqli, $selectProdukt));
        if (!isset($_SESSION["kosik"])) {
            $predmetyVkosiku = array($id => $mnozstvo);
            $_SESSION["kosik"] = $predmetyVkosiku;
        }
        if (array_key_exists($id, $_SESSION["kosik"]))
            $_SESSION["kosik"][$id] += $mnozstvo;
        else
            $_SESSION["kosik"][$id] = $mnozstvo;
        $pridanyPredmet = "Produkt bol vložený do košíka!";
        echo "<script type='text/javascript'>alert('$pridanyPredmet');</script>";
        $data['success'] = true;
        $data['odpoved'] = 'Produkt bol vložený do košíka!';
    }
    echo json_encode($data);
}