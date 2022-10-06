<?php
session_start();
//conexão a classes
require('./class/class.site.php');
require("./conectar.php");
$db = new site;
$resposta = $db->validar();
$clientes = 0;
$pedidos = 0;
$lucro = 0;
$crescimento = 0;
$count = 0;


$a = 0;
$b = 0;
$c = 0;
$d = 0;
$e = 0;


$seg = "";
$ter = "";
$qua = "";
$qui = "";
$sex = "";
$sab = "";
$dom = "";

?>
<!DOCTYPE html>
<html lang="pt=br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


    <link rel="icon" type="image/x-icon" href="/img/favico.ico">
    <link rel="stylesheet" href="css/dashbord.css">
    <script src="js/script.js"></script>
    <title>main</title>
</head>

<body>
    <?php

    //carregando dados 

    $datac = date('d-m-Y');
    $datav = '01-' . date('m-Y');

    $sql = "SELECT * FROM `clientes` WHERE `data`>= '$datav' and `data`<='$datac';";
    $result = mysqli_query($conn, $sql);
    $clientes  = mysqli_num_rows($result);

    $dataf = date('m-d-Y');
    $datai = '01-' . date('m-Y');
    $query = mysqli_query($conn, "SELECT * FROM `vendas` WHERE `dt_compra`>='$datai' and `dt_compra`<='$dataf';");
 
    if (mysqli_num_rows($query)) {
        while ($array = mysqli_fetch_row($query)) {
            $lucro = $lucro + $array[5];
            $semana = $array[7];
            $diasemana_numero = date('w', strtotime($semana));
            switch ($diasemana_numero) {
                case '2':
                    $seg++;
                    break;
                case '3':
                    $ter++;
                    break;
                case '4':
                    $qua++;
                    break;
                case '5':
                    $qui++;
                    break;
                case '6':
                    $sex++;
                    break;
                case '7':
                    $sab++;
                    break;
                case '0':
                    $dom++;
                    break;
                default:
                    break;
            }
        }
    }
    $sql = "SELECT * FROM `vendas` WHERE `dt_compra`>='$datai' and `dt_compra`<='$dataf';";
    $query = mysqli_query($conn, $sql);
    $pedidos = mysqli_num_rows($query);


    $sql = "SELECT * FROM `vendas` WHERE `data`='2018';";
    $query = mysqli_query($conn, $sql);
    $a = mysqli_num_rows($query);

    $sql = "SELECT * FROM `vendas` WHERE `data`='2019';";
    $query = mysqli_query($conn, $sql);
    $b = mysqli_num_rows($query);

    $sql = "SELECT * FROM `vendas` WHERE `data`='2020';";
    $query = mysqli_query($conn, $sql);
    $c = mysqli_num_rows($query);

    $sql = "SELECT * FROM `vendas` WHERE `data`='2021';";
    $query = mysqli_query($conn, $sql);
    $d = mysqli_num_rows($query);

    $sql = "SELECT * FROM `vendas` WHERE `data`='2022';";
    $query = mysqli_query($conn, $sql);
    $e = mysqli_num_rows($query);

    $sql = "SELECT * FROM `vendas` WHERE `dt_compra`>='$datai' and `dt_compra`<='$dataf';";
    $query = mysqli_query($conn, $sql);
    $e = mysqli_num_rows($query);
    
    $crescimento = $pedidos - 50 / 100 . '%';


    ?>

    <header class="container-fluid">
        <div class="mt-md-1">
            <div class="row">
                <h1 class="alert alert-dark titulo centro borda" style="color:#cccccc; background-color:#292727;">DashBord</h1>
                <input type="submit" class="btn btn-dark" style="background-color:#292727" value="Alterar tela" onclick="toggleFullScreen()">
            </div>
        </div>
    </header>
    <section>
        <div class="container">
            <div class="mt-md-2">
                <div class="row">
                    <div class="col-md-2 mx-auto bordaindice card centro borda">
                        <p id="titulob">Clientes</p>
                        <p id="resultado"><?php echo $clientes; ?></p>
                        <p id="indice">Crescimento nos últimos 30 diase</p>
                    </div>
                    <div class="col-md-2 mx-auto bordaindice card1 centro borda">
                        <p id="titulob">Pedidos</p>
                        <p id="resultado"><?php echo $pedidos; ?></p>
                        <p id="indice">Crescimento nos últimos 30 dias</p>
                    </div>
                    <div class="col-md-2 mx-auto bordaindice card2 centro borda">
                        <p id="titulob">Lucro</p>
                        <p id="resultado"><?php echo " R$ " . $lucro; ?></p>
                        <p id="indice">Crescimento nos últimos 30 dias</p>
                    </div>
                    <div class="col-md-2  mx-auto bordaindice card3 centro borda">
                        <p id="titulob">Crescimento</p>
                        <p id="resultado"><?php echo $crescimento; ?></p>
                        <p>Estimativa de 100 vendas</p>
                        <p id="indice">Crescimento nos ultimos 30 dias</p>
                        
                    </div>
                </div>
            </div>
        </div><br>
        <div class="container">
            <div class="row">
                <div class="col-md-6 menu">
                    <p class="centro">Crescimento anual</p>
                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

                    <script>
                        var xValues = ["2018", "2019", "2020", "2021", "2022"];
                        var yValues = [<?= $a ?>, <?= $b ?>, <?= $c ?>, <?= $d ?>, <?= $e ?>];
                        var barColors = [
                            "rgba(255,0,0,1.0)",
                            "rgba(255,0,0,0.8)",
                            "rgba(255,0,0,0.6)",
                            "rgba(255,0,0,0.4)",
                            "rgba(255,0,0,0.2)"
                        ];

                        new Chart("myChart", {
                            type: "bar",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                            },
                            options: {
                                legend: {
                                    display: false
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }],
                                }
                            }
                        });
                    </script>

                </div>
                <div class="col-md-6">
                    <canvas id="graficosemanal" style="width:100%;max-width:700px"></canvas>
                    <script>
                        var xValues = ["Seg", "Ter", "Qua", "Qui", "sex", "sab", "dom"];
                        var yValues = [<?= $seg ?>, <?= $ter ?>, <?= $qua ?>, <?= $qui ?>, <?= $sex ?>, <?= $sab ?>, <?= $dom ?>];
                        var barColors = [
                            "#b91d47",
                            "#00aba9",
                            "#2b5797",
                            "#e8c3b9",
                            "#1e7145",
                            "#CC2EFA",
                            "#FFFF00"
                        ];
                        new Chart("graficosemanal", {
                            type: "doughnut",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: "Faturamento semanal"
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        </div>
        </div>
        <div>
    </section>


</body>

</html>