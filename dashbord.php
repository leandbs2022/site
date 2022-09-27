<?php
session_start();
//conexão a classes
require('./class/class.site.php');
$db = new site;
$resposta = $db->validar();
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
    <link rel="icon" type="image/x-icon" href="/img/favico.ico">
    <link rel="stylesheet" href="css/pages.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="js/script.js"></script>
    <title>main</title>
</head>

<body>
    <header class="container">
        <div class="mt-md-1">
            <div class="row">
                <h1 class="alert alert-primary titulo centro borda" style="background-color: #e3f2fd;">DashBord</h1>
            </div>
        </div>
    </header>
    <section>
        <div class="container">
            <div class="mt-md-2">
                <div id= "pesq" class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <input type="date" class="form-control" id="data1" aria-describedby="textdate">
                            <div id="textdate" class="form-text">Data início</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="mb-3">
                                                 <input type="date" class="form-control" id="data2" aria-describedby="textdate">
                            <div id="textdate" class="form-text">Data final</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="mb-3">
                            <input type="submit" class="btn btn-primary" id="data2"  value="Pesquisa">
                            <input type="submit"  class="btn btn-primary"  value="Tipo de tela" onclick="toggleFullScreen()">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-md-2">
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
                        <script>
                            var xValues = ["2018", "2019", "2020", "2020", "2021"];
                            var yValues = [55, 49, 44, 24, 15];
                            var barColors = [
                                "#b91d47",
                                "#00aba9",
                                "#2b5797",
                                "#e8c3b9",
                                "#1e7145"
                            ];

                            new Chart("myChart", {
                                type: "pie",
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
                                        text: "Controle de vendas anual"
                                    }
                                }
                            });
                        </script>
                    </div>
                    <div class="col-md-6">
                        <canvas id="myChart1" style="width:100%;max-width:700px"></canvas>
                        <script>
                            var xValues = ["2015", "2016", "2017", "2018", "2019"];
                            var yValues = [55, 49, 44, 24, 15];
                            var barColors = [
                                "#b91d47",
                                "#00aba9",
                                "#2b5797",
                                "#e8c3b9",
                                "#1e7145"
                            ];

                            new Chart("myChart1", {
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
                                        text: "Controle de produção"
                                    }
                                }
                            });
                        </script>

                    </div>
                </div>
            </div>

        </div>
        <div>
            <div class="mt-md-2">
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
                        <script>
                            var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
                            var yValues = [55, 49, 44, 24, 15];
                            var barColors = ["red", "green", "blue", "orange", "brown"];

                            new Chart("myChart2", {
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
                                    title: {
                                        display: true,
                                        text: "Estatística de confiabilidade"
                                    }
                                }
                            });
                        </script>


                    </div>
                    <div class="col-md-6">
                        <canvas id="myChart3" style="width:100%;max-width:600px"></canvas>

                        <script>
                            var xValues = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];

                            new Chart("myChart3", {
                                type: "line",
                                data: {
                                    labels: xValues,
                                    datasets: [{
                                        data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478],
                                        borderColor: "red",
                                        fill: false
                                    }, {
                                        data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 7000],
                                        borderColor: "green",
                                        fill: false
                                    }, {
                                        data: [300, 700, 2000, 5000, 6000, 4000, 2000, 1000, 200, 100],
                                        borderColor: "blue",
                                        fill: false
                                    }]
                                },
                                options: {
                                    legend: {
                                        display: false
                                    }
                                }
                            });
                        </script>

                    </div>
                </div>


            </div>

    </section>
</body>

</html>