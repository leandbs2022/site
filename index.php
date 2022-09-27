<?php
session_start();
session_unset();
session_destroy();

session_start();
//conexão a classes
require('./class/class.site.php');
//conexão DB
require('./conectar.php');
$db = new site;

//variaveis globais
$_SESSION["nome"] = "";
$_SESSION["perfil"] = 0;
$_SESSION['data'] = "";
$_SESSION['nivel'] = "";
//Variaveis
$nome = "";
$senha = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css">
    <script src="js/script.js"></script>
    <link rel="icon" type="image/x-icon" href="/img/favico.ico">
    <title>Login</title>
</head>

<body>
    <header class=container>
        <p id="#topo"></p>
        <div class="row borda">
            <div class="col-md-3">
            <p class="direita">
        <h6> Projeto PHP Curso Senai</h6>
        </p>
            </div>
            <div class="col-md-5">
            <h1>Acesso Restrito</h1>
            </div>
            <div class="col-md-4">
            <p class="direita">
        <h6> Aluno: Leandro Barbosa de Souza</h6>
        </p>
            </div>
        </div>
    </header>
    <section class=container>
        <div class="mt-5">
            <div class="row">
                <div class="wrapper fadeInDown">
                    <div id="formContent">
                        <div class="fadeIn first">
                            <img class="imagem_icon" src="img/entrada.png" id="icon" alt="User Icon" />
                        </div>
                        <form method="post" action="">
                            <label for="Login">Usuário:</label>
                            <input type="text" name="login" id="login" />
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" />
                            <input type="submit" class="fadeIn fourth" id="entrar" name="entrar" value="Entrar" onclick="alerta()">

                            <?php
                            if (isset($_POST['entrar'])) {

                                require("./conectar.php");

                                $senha = $_POST['login'];
                                $nome = $_POST['password'];

                                if (empty($senha) || empty($nome)) {
                                    echo "<script>alert('Não e possível logar falta informações!')</script>";
                                } else {
                                    $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE 1");
                                    if (mysqli_num_rows($query)) {
                                        $resposta = $db->login($senha, $nome);
                                    } else {
                                        $nome = "Administrador";
                                        $senha = "123admin";
                                        $cript = base64_encode($senha);
                                        $perfil = 10;
                                        $_SESSION["nome"] = "$nome";
                                        $_SESSION["perfil"] = 10;
                                        $query = mysqli_query($conn, "INSERT INTO `usuarios`(`nome`, `senha`, `perfil`) VALUES ('$nome','$cript','$perfil')");
                                        echo "<script>alert('Esse e seu primeiro acesso. O usuario administrador foi criando a e senha 123admin. Apos o acesso favor mudar a senha para sua seguranca')</script>";
                                    }
                                }
                            }
                            ?>
                            <div id="formFooter">
                                <a class="underlineHover" href="recuperar.php">Esqueceu a senha?</a>
                            </div>

                    </div>
                </div>

            </div>
        </div>
        </form>

    </section>
<footer id="rodape"><p class="container"><?php $resposta = $db->contador_ver(); ?></p></footer>
</body>
</html>