<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrátor</title>
    <link href="../styly.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
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
<script>
    $(document).ready(function () {
        const pridajProduktModal = document.getElementById("pridajProduktModal");
        const vymazProduktModal = document.getElementById("vymazProduktModal");
        const upravProduktModal = document.getElementById("upravProduktModal");
        document.getElementById("pridajProdukt").onclick = function () {
            pridajProduktModal.style.display = "block";
        }
        document.getElementsByClassName("modalZavri")[0].onclick = function () {
            pridajProduktModal.style.display = "none";
        }
        window.onclick = function (event) {
            if (event.target == pridajProduktModal) {
                pridajProduktModal.style.display = "none";
            }
            if (event.target == vymazProduktModal) {
                vymazProduktModal.style.display = "none";
            }
            if (event.target == upravProduktModal) {
                upravProduktModal.style.display = "none";
            }
        }
        document.getElementById("tabulka").style.visibility = "hidden";
        $("#pouzivatelia").click(function () {
            $("#tabulka thead").empty();
            $("#tabulka tbody").empty();
            $.ajax({
                url: 'administratorAjax.php',
                type: "GET",
                data: {
                    operacia: 1
                },
                dataType: 'json',
                success: function (data) {
                    var len = data.length;
                    for (var i = 0; i < len; i++) {
                        var riadok = "<tr>" +
                            "<td>" + data[i].meno + "</td>" +
                            "<td>" + data[i].mail + "</td>" +
                            "<td>" + data[i].telefon + "</td>" +
                            "<td>" + data[i].registracia + "</td>" +
                            "<td>" + data[i].admin + "</td>" +
                            "</tr>";
                        $("#tabulka tbody").append(riadok);
                    }
                }
            });
            document.getElementById("tabulka").style.visibility = "visible";
            var hlavicka = "<tr>" +
                "<th> Používateľ </th>" +
                "<th> E-mail </th>" +
                "<th> Telefónne číslo </th>" +
                "<th> Dátum registrácie </th>" +
                "<th> Je administrátor </th>" +
                "</tr>";
            $("#tabulka thead").append(hlavicka);
        });
        $("#objednavky").click(function () {
            $("#tabulka thead").empty();
            $("#tabulka tbody").empty();
            $.ajax({
                url: 'administratorAjax.php',
                type: "GET",
                data: {
                    operacia: 2
                },
                dataType: 'json',
                success: function (data) {
                    var len = data.length;
                    for (var i = 0; i < len; i++) {
                        var riadok = "<tr>" +
                            "<td>" + data[i].meno + "</td>" +
                            "<td>" + data[i].datum + "</td>" +
                            "<td>" + data[i].pocet + "</td>" +
                            "<td>" + data[i].suma + "</td>" +
                            "</tr>";
                        $("#tabulka tbody").append(riadok);
                    }
                }
            });
            document.getElementById("tabulka").style.visibility = "visible";
            var hlavicka = "<tr>" +
                "<th> Používateľ </th>" +
                "<th> Dátum nákupu </th>" +
                "<th> Počet položiek </th>" +
                "<th> Celková suma </th>" +
                "</tr>";
            $("#tabulka thead").append(hlavicka);
        });
        $("#produkty").click(function () {
            $("#tabulka thead").empty();
            $("#tabulka tbody").empty();
            $.ajax({
                url: 'administratorAjax.php',
                type: "GET",
                data: {
                    operacia: 3
                },
                dataType: 'json',
                success: function (data) {
                    var len = data.length;
                    for (var i = 0; i < len; i++) {
                        var riadok = "<tr id=" + data[i].id + ">" +
                            "<td>" + data[i].meno + "</td>" +
                            "<td>" + data[i].obrazok + "</td>" +
                            "<td>" + data[i].cena + "</td>" +
                            "<td>" + data[i].pocet + "</td>" +
                            "<td>" + data[i].akcia + "</td>" +
                            "</tr>";
                        $("#tabulka tbody").append(riadok);
                    }
                }
            });
            document.getElementById("tabulka").style.visibility = "visible";
            var hlavicka = "<tr>" +
                "<th> Názov produktu </th>" +
                "<th> Súbor s obrázkom </th>" +
                "<th> Cena produktu </th>" +
                "<th> Počet predaných kusov </th>" +
                "<th></th>" +
                "</tr>";
            $("#tabulka thead").append(hlavicka);
        });
    });
    function vymazProdukt() {
        idProduktu = event.target.parentNode.parentNode.id;
        hiddenPole = "<input type='hidden' name='idProduktuVymaz' value=" + idProduktu + "/>";
        $('#vymazFormModal').append(hiddenPole);
        document.getElementById("vymazProduktModal").style.display = "block";
    }
    function upravProdukt() {
        document.getElementById("upravFormModal").innerHTML = "";
        idProduktu = event.target.parentNode.parentNode.id;
        nazovProduktu = "TestNazov";
        hiddenPole = "<input type='hidden' name='idProduktuUprav' value=" + idProduktu + "/>";
        labelNazov = "<label for='nazov'>Názov produktu</label><br>";
        nazovPole = "<input type='text' name='nazov' id='nazov' value='" + nazovProduktu + "'required><br><br>";
        labelObrazok = "<label for='obrazok'>Súbor s obrázkom produktu (nemusí byť zadaný)</label><br>";
        obrazokPole = "<input type='text' name='obrazok' id='obrazok' value=" + nazovProduktu + "><br><br>";
        labelCena = "<label for='cena'>Cena produktu</label><br>";
        cenaPole = "<input type='number' name='cena' min='1' id='cena' value='" + idProduktu + "'required><br><br>";
        submitTlacidlo = "<input type='submit' value='Áno, chcem upraviť produkt!' name='anoUprav' id='anoUprav' class='button'>";
        $('#upravFormModal').append(hiddenPole, labelNazov, nazovPole, labelObrazok, obrazokPole, labelCena, cenaPole, submitTlacidlo);
        document.getElementById("upravProduktModal").style.display = "block";
    }
</script>
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