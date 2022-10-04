<?php
session_start();
//conexão a classes
require('./class/class.site.php');
$db = new site;
$resposta = $db->validar();
//variaveis
$nome =  "";
$senha = "";
$perfil = "";
$email = "";
$perfil = "";
$deletar = false;
$permissao = $_SESSION["perfil"];
?>
<!DOCTYPE html>
<html lang="pt=br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>-->
    <link rel="icon" type="image/x-icon" href="/img/favico.ico">
    <link rel="stylesheet" href="css/pages.css">

    <link rel="stylesheet" type="text/css" href="css/form.css" />
    <script src="js/script.js"></script>
    <script src="js/funcoes.js"></script>
    <title>cadastro de Usuários</title>
</head>

<body onload="cal_total()">
    <?php
    if (isset($_POST['tlocaliza'])) {
        $nome = $_POST['tloc'];
        $resposta = $db->localizar_usuario($nome);
        $email = $_SESSION['email_l'];
        $nome =  $_SESSION["nome_l"];
    }

    ?>
    <header class="container">

        <div class="mt-md-1">
            <div class="row ajuste">
                <h1 class="alert alert-primary titulo centro borda fontebranca">Usuários</h1>
            </div>
        </div>
    </header>
    <form method="post" action="" id="cform" onload="limpar()">
        <div class="mt-md-1">
            <div id="usuarios" class="row">

                <hgroup>
                    <h1 class="centro fontebranca">Formulário de Usuários</h1>
                </hgroup>
                <fieldset id="cliente">
                    <legend>Identificação do Usuário</legend>
                    <p><label class='fontebranca'>Nome: </label><input type="text" class="bordasimples " name="tnome" id="cnome" value="<?php echo $nome; ?>" size="20" maxlength="20"></p>
                    <p><label class='fontebranca'>Senha:</label><input type="password" class="bordasimples" name="tsenha" id="csenha" value="" size="8" maxlength="8"><input type="password" class="bordasimples" name="tconfimr" id="tconfirme" size="8" maxlength="8" placeholder="Confirme"></p>
                    <p><label class='fontebranca'>E-mail:</label><input type="text" class="bordasimples" name="tmail" id="cmail" size="20" maxlength="40" value="<?php echo $email; ?>"></p>
                    <fieldset id="nivel" class="perfil bordasimples">
                        <legend>Perfil</legend>
                        <select class="bordaT" id="cper" name="tper">
                            <option value="1"> Administardor</option>
                            <option value="2"> Administrativo</option>
                            <option value="3"> Gerencia</option>
                            <option value="4"> Diretoria</option>
                        </select>
                    </fieldset>

                </fieldset>
                <fieldset>
                    <p><input type="submit" class="button" id="ccadastro" name="tcadastro" value="Novo"> | <input type="submit" class="button" id="calt" name="talt" value="Alterar"> | <input type="submit" class="button" id="cdel" name="tdel" value="Deletar"> | <input type="submit" class="button" id="clocaliza" name="tlocaliza" value="pesquisar">
                        <img class="imgdireita" src="img/dedodireita.svg"><select id="cloc" name="tloc" class="bordaT">
                            <?php
                            require("./conectar.php");
                            $query = mysqli_query($conn, "SELECT * from usuarios where 1");
                            if (mysqli_num_rows($query)) {
                                while ($array1 = mysqli_fetch_row($query)) {
                                    $direto = $array1[1];
                                    echo "<option>{$direto}</option>";
                                }
                            }

                            ?>
                        </select>
                    </p>
                </fieldset>
                <div>
                    <?php

                    if (isset($_POST['tcadastro'])) {

                        /*$escolha = @$_POST['tperfil']; // Usado @, já que vai ser testado em seguida.
                        if (empty($escolha)) $perfil = '0';
                        else if ($escolha == '1') $perfil = '1';
                        else if ($escolha == '2') $perfil = '2';
                        else if ($escolha == '3') $perfil = '10';*/
                        //dados campos
                        $perfil = $_POST['tper'];
                        $nome = $_POST['tnome'];
                        $senha = $_POST['tsenha'];
                        $confime = $_POST['tconfimr'];
                        $email = $_POST['tmail'];


                        if ($permissao == "1") {
                            if ($senha <> $confime) {
                                echo "<script>alert('A Senha não confere!Favor digite novamente.')</script>";
                            } else {

                                $resposta = $db->usuario_add($nome, $senha, $perfil, $email);
                            }
                        } else {
                            echo "<script>alert('Você não tem permissão de adicionar usuário.')</script>";
                        }
                    }

                    if (isset($_POST['talt'])) {

                        $perfil = $_POST['tper'];
                        $nome = $_POST['tnome'];
                        $senha = $_POST['tsenha'];
                        $confime = $_POST['tconfimr'];
                        $email = $_POST['tmail'];

                        if ($permissao === "1") {
                            if ($senha <> $confime) {
                                echo "<script>alert('A Senha não confere!Favor digite novamente.')</script>";
                            } else {
                                $resposta = $db->usuario_alt($nome, $senha, $perfil, $email);
                            }
                        } else {
                            echo "<script>alert('Você não tem permissão para essa função.')</script>";
                        }
                    }

                    if (isset($_POST['tdel'])) {
                        if ($permissao == 1) {
                            $nome = $_POST['tnome'];
                            $resposta = $db->usuario_del($nome);
                        } else {
                        echo "<script>alert('Você não tem permissão para essa função.')</script>";
                        }
                    }

                    ?>
                </div>

            </div>
        </div>
    </form>
</body>

</html>