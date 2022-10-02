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
//carregando dados clientes cadastrados no mês atual
$query = mysqli_query($conn, "SELECT * FROM `clientes` WHERE 1");
if (mysqli_num_rows($query)) {
    while ($array = mysqli_fetch_row($query)) {
        $count = $count + 1;
    }
    $clientes = $count;
}

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
                        <p id="resultado"><?php echo $lucro; ?></p>
                        <p id="indice">Crescimento nos últimos 30 dias</p>
                    </div>
                    <div class="col-md-2  mx-auto bordaindice card3 centro borda">
                        <p id="titulob">Crescimento</p>
                        <p id="resultado"><?php echo $crescimento; ?></p>
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
                    var yValues = [15, 25, 38, 44, 55];
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
                <canvas id="myChart1" style="width:100%;max-width:700px"></canvas>
                <script>
                    
                    var xValues = ["Seg", "Ter", "Qua", "Qui", "sex"];
                    var yValues = [0, 49, 44, 24, 15];
                    var barColors = [
                        "#b91d47",
                        "#00aba9",
                        "#2b5797",
                        "#e8c3b9",
                        "#1e7145"
                    ];

                    new Chart("myChart1", {
                        type: "line",
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
                                text: "Faturamenta semanal"
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

    <aside>
    <div class="col">
            <div class="col-md-6 menu">
                <p class="centro">Crescimento anual</p>
                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                <script>
                    var xValues = ["2018", "2019", "2020", "2021", "2022"];
                    var yValues = [15, 25, 38, 44, 55];
                    var barColors = [
                        "rgba(255,0,0,1.0)",
                        "rgba(255,0,0,0.8)",
                        "rgba(255,0,0,0.6)",
                        "rgba(255,0,0,0.4)",
                        "rgba(255,0,0,0.2)"
                    ];

                    new Chart("myChart", {
                        type: "Donut",
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
                <canvas id="myChart1" style="width:100%;max-width:700px"></canvas>
                <script>
                    
                    var xValues = ["Seg", "Ter", "Qua", "Qui", "sex"];
                    var yValues = [0, 49, 44, 24, 15];
                    var barColors = [
                        "#b91d47",
                        "#00aba9",
                        "#2b5797",
                        "#e8c3b9",
                        "#1e7145"
                    ];

                    new Chart("myChart1", {
                        type: "line",
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
                                text: "Faturamenta semanal"
                            }
                        }
                    });
                </script>
            </div>
        </div>         

    </aside>
</body>

</html>