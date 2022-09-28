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
    <link rel="icon" type="image/x-icon" href="/img/favico.ico">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <title>main</title>
</head>
<body>
    <header class="container">
        <div class="mt-md-1">
            <div class="row">
                <div class="col-md-6">
                <p class=""><?php echo "Login: {$_SESSION['data']} Usuário: {$_SESSION['nome']} Nível: {$_SESSION['nivel']}"; ?></p>
                    <!--<p class="esquerda"><a href="index.php"><input type="submit" class="button" value="Login"></a></p>-->
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
<div class="">
 <nav class="navbar navbar-light navbar-expand-lg borda" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img class="logo" src="./img/logo.svg"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="frame(pages = 0) ">DashBord</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Cadastros
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#" onclick="frame(pages = 1) ">Clientes</a></li>
            <li><a class="dropdown-item disabled" href="#" onclick="frame(pages = 2) " >Funcionarios</a></li>
          <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item disabled" href="#" onclick="frame(pages = 3) ">Produtos</a></li>
            <li><a class="dropdown-item disabled" href="#" onclick="frame(pages = 4) ">Fornecedores</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" onclick="frame(pages = 5) ">Usuários</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Gerador de vendas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="relatorios.php" target="_black">Relatórios</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2 " type="search" placeholder="Digite aqui" aria-label="Procurar">
        <button class="btn btn-outline-dark" type="submit">Procurar</button>
      </form>
    </div>
  </div>
</nav>
</div>
    </header>

    <div class="container">
      <iframe id="telas" src="dashbord.php" ></iframe>
    </div>
    <footer id="rodape">
        <p>Copyright 2022 - by Leandro Barbosa de Souza<br />
            <a href="https://leandbs2022.github.io/portfolio/" target="_blank">
                Portfolío</a> | <a href="https://github.com/leandbs2022" target="_blank">Github</a>
        </p>
</body>

</html>