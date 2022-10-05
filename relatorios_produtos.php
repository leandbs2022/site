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
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
-->
    <link rel="icon" type="image/x-icon" href="/img/favico.ico">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/pages.css">
    <script src="js/script.js"></script>
    <title>relatorios</title>
</head>
<body>
    <header>
            <div class="centro">
            <h1 class="titulo centro borda fontebranca">Produtos</h1>
            </div>
    </header>

    <section>
<DIV class="container">
<?php 
$resposta = $db->produtos();
?>
</DIV>

    </section>
</body>

</html>