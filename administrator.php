<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrátor</title>
    <link href="styly.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
<div class="divHlavicka">
    <?php
    include "menu.php";
    if (!isset($_SESSION["meno"])) {
        header("Location: prihlasenie.php");
    }
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
    <tr>
        <th id="h1"></th>
        <th id="h2"></th>
        <th id="h3"></th>
        <th id="h4">Akcia</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        document.getElementById("tabulka").style.visibility = "hidden";
        $("#pouzivatelia").click(function () {
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
                        var meno = data[i].meno;
                        var datum = data[i].registracia;
                        var admin = data[i].admin;
                        var tr_str = "<tr>" +
                            "<td>" + meno + "</td>" +
                            "<td>" + datum + "</td>" +
                            "<td>" + admin + "</td>" +
                            "</tr>";
                        $("#tabulka tbody").append(tr_str);
                    }
                }
            });
            document.getElementById("tabulka").style.visibility = "visible";
            $("#h1").html("Používateľ");
            $("#h2").html("Dátum registrácie");
            $("#h3").html("Je administrátor");
        });
        $("#objednavky").click(function () {
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
                        var meno = data[i].meno;
                        var datum = data[i].datum;
                        var suma = data[i].suma;
                        var tr_str = "<tr>" +
                            "<td>" + meno + "</td>" +
                            "<td>" + datum + "</td>" +
                            "<td>" + suma + "</td>" +
                            "</tr>";
                        $("#tabulka tbody").append(tr_str);
                    }
                }
            });
            document.getElementById("tabulka").style.visibility = "visible";
            $("#h1").html("Používateľ");
            $("#h2").html("Dátum nákupu");
            $("#h3").html("Celková suma");
        });
        $("#produkty").click(function () {
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
                        var meno = data[i].meno;
                        var obrazok = data[i].obrazok;
                        var cena = data[i].cena;
                        var tr_str = "<tr>" +
                            "<td>" + meno + "</td>" +
                            "<td>" + obrazok + "</td>" +
                            "<td>" + cena + "</td>" +
                            "</tr>";
                        $("#tabulka tbody").append(tr_str);
                    }
                }
            });
            document.getElementById("tabulka").style.visibility = "visible";
            $("#h1").html("Názov produktu");
            $("#h2").html("Obrázok");
            $("#h3").html("Cena");
        });
    });
</script>
</body>
</html>