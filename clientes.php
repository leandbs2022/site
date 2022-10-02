<?php
session_start();
//conexão a classes
require('./class/class.site.php');
$db = new site;
$resposta = $db->validar();
//variaveis
$nome =  "";
$tel = "";
$cel = "";
$email = "";
$obs = "";
$tgenero = "";
$endereco = "";
$cep = "";
$estado = "";
$cidade = "";
$dt_nasc = "";
$dt_cad = "";
$casa = "";
$complemento = "";
$id = 0;
//perfil de acesso
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
    <script language="javascript" src="js/funcoes.js"></script>
    <title>cadastro de Clientes</title>
</head>

<body>
    <header class="container">
        <div class="mt-md-1">
            <div class="row ajuste">
                <h1 class="alert alert-primary titulo centro borda fontebranca">Clientes</h1>
                <form method="post" id="fcontato" action="" oninput="cal_total();">
                    <hgroup>
                        <h1 class="centro fontebranca">Formulário de cliente</h1>
                        <?php
                        if (isset($_POST['tlocaliza'])) {
                            $nome = $_POST['tloc'];
                            require("./conectar.php");
                            $query = mysqli_query($conn, "SELECT * FROM `clientes` WHERE nome='$nome'");
                            if (mysqli_num_rows($query)) {

                                while ($array = mysqli_fetch_row($query)) {
                                    $id = $array[0];
                                    $nome = $array[1];
                                    $tel = $array[6];
                                    $cel = $array[7];
                                    $email = $array[9];
                                    $obs = $array[12];
                                    $tgenero = $array[8];
                                    $endereco = $array[2];
                                    $cep = $array[5];
                                    $estado = $array[3];
                                    $cidade = $array[4];
                                    $dt_nasc = $array[10];
                                    $dt_cad = $array[11];
                                    $casa = $array[13];
                                    $complemento = $array[14];
                                }
                            } else {
                                echo "<script>alert('Niguém encontrado com esse nome!')</script>";
                            }
                        }

                        ?>
                    </hgroup>

                    <fieldset id="cliente">
                        <legend id="legenda">Identificação do Cliente</legend>
                        <p class="fontebranca">ID:<?php echo $id; ?></p>
                        <p><label class="fontebranca" for="cnome">Nome:</label><input type="text" class="bordasimples espaco " value="<?php echo $nome; ?>" name="tnome" id="cnome" size="20" maxlength="40" placeholder="nome completo"></p>
                        <p><label class="fontebranca" for="ctel">Tel:</label><input type="text" class="bordasimples" value="<?php echo $tel; ?>" name="ttel" id="ctel" size="11" maxlength="11" placeholder="Telefone"></p>
                        <p><label class="fontebranca" for="ccel"> Cel:</label><input type="text" class="bordasimples" value="<?php echo $cel; ?>" name="tcel" id="ccel" size="11" maxlength="11" placeholder="Celular"></p>
                        <p><label class="fontebranca" for="cemail">E-mail:</label>&nbsp;<input type="email" value="<?php echo $email; ?>" name="tmail" id="cmail" class="bordasimples" size="20" maxlength="40" placeholder="e-mail"></p>
                        <p><label class="fontebranca" for="cobs">OBS:</label><input type="text" class="bordasimples" value="<?php echo $obs; ?>" name="tobs" id="cobs" size="80" maxlength="80"></p>
                        <fieldset id="sexo" class="bordasimples">
                            <legend>Dados pessoais</legend>
                            <p><label class="fontebranca" for="tgenero">Sexo:</label>
                                <select class="bordasimples bordaT" name="tgenero" id="cgenero">
                                    <option value="0"><?php echo $tgenero; ?></option>
                                    <option value="1">Masculino</option>
                                    <option value="2">Feminino</option>
                                </select>
                            </p>
                            <p><label class="fontebranca" for="cnasc">Data de Nascimento:</label><input type="date" value="<?php echo $dt_nasc; ?>" class="bordasimples" name="tnasc" id="cnasc"></p>
                        </fieldset>

                    </fieldset>
                    <fieldset id="endereco">
                        <legend>Endereço do Cliente</legend>
                        <p><label class="fontebranca" for="ccep">Cep:</label><input type="text" value="<?php echo $cep; ?>" class="bordasimples" name="tcep" id="ccep" size="12" maxlength="12" placeholder="cep"></p>
                        <p><label class="fontebranca" for="crua">Log.:</label><input type="text" value="<?php echo $endereco; ?>" class="bordasimples" name="trua" id="crua" size="40" maxlength="80" placeholder="endereço"></p>
                        <p><label class="fontebranca" for="cnum">Nº:</label><input class="bordasimples" value="<?php echo $casa; ?>" type="number" name="tnum" id="cnum" mix="0" max="999" placeholder="">
                        <p><label class="fontebranca" for="ccom">Complemento:</label><input class="bordasimples" type="text" value="<?php echo $complemento; ?>" name="tcom" id="ccom" placeholder="">
                        </p>
                        <p><label for="cest" class="fontebranca">Estado:</label>
                            <select class="bordasimples bordaT" name="test" id="cest">
                                <option><?php echo $estado; ?></option>
                                <option value="DF">DF</option>
                            </select>
                        </p>
                        <p><label class="fontebranca" for="ccid">Cidade:</label>
                            <input type="text" class="bordasimples bordaT" name="tcid" id="ccid" maxlength="40" size="20" value="<?php echo $cidade; ?>" placeholder="cidade" list="cidade" />
                        </p>
                        <datalist id="cidade">
                            <option value="Brasilia"></option>
                            <option value="Ceilândia"></option>
                            <option value="Gama"></option>
                            <option value="Samambaia"></option>
                            <option value="Guara"></option>
                            <option value="Santa Maria"></option>
                            <option value="Riacho Fundo"></option>
                            <option value="Recanto das Emas"></option>
                            <option value="Riacho Fundo II"></option>
                        </datalist>
                    </fieldset>
                    <fieldset>
                        <p><input type="submit" class="button" id="ccadastro" name="tcadastro" value="Novo"> |
                            <input type="submit" class="button" id="calterar" name="talterar" value="Alterar"> |
                            <input type="submit" class="button" id="cdel" name="tdel" value="Deletar">|
                            <input type="submit" class="button #legenda" id="clocaliza" name="tlocaliza" value="pesquisar" >
                            <img class="imgdireita" src="img/dedodireita.svg"><select id="cloc" name="tloc" class="bordaT">
                                <?php
                                require("./conectar.php");
                                $query = mysqli_query($conn, "SELECT * from clientes where 1");
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

                    <?php

                    if (isset($_POST['tcadastro'])) {
                        $tgenero = $_POST['tgenero'];
                        switch ($tgenero) {
                            case '1':
                                $tgenero = 'Masculino';
                                break;
                            case '2':
                                $tgenero = 'feminino';
                                break;
                            default:

                                break;
                        }
                        $nome =  $_POST['tnome'];
                        $tel = $_POST['ttel'];
                        $cel = $_POST['tcel'];
                        $email = $_POST['tmail'];
                        $obs = $_POST['tobs'];
                        $cep = $_POST['tcep'];
                        $endereco = $_POST['trua'];
                        $casa = $_POST['tnum'];
                        $complemento = $_POST['tcom'];
                        $estado = $_POST['test'];
                        $cidade = $_POST['tcid'];
                        $dt_nasc = $_POST['tnasc'];
                        $dt_cad = date('d-m-Y');
                        $resposta = $db->cliente_add($nome, $tel, $cel, $email, $obs, $tgenero, $cep, $endereco, $casa, $complemento, $estado, $cidade, $dt_nasc, $dt_cad);
                    }

                    if (isset($_POST['talterar'])) {
                        if ($permissao == "1") {
                            $tgenero = $_POST['tgenero'];
                            switch ($tgenero) {
                                case '1':
                                    $tgenero = 'Masculino';
                                    break;
                                case '2':
                                    $tgenero = 'feminino';
                                    break;
                                default:

                                    break;
                            }
                            $nome =  $_POST['tnome'];
                            $tel = $_POST['ttel'];
                            $cel = $_POST['tcel'];
                            $email = $_POST['tmail'];
                            $obs = $_POST['tobs'];
                            $cep = $_POST['tcep'];
                            $endereco = $_POST['trua'];
                            $casa = $_POST['tnum'];
                            $complemento = $_POST['tcom'];
                            $estado = $_POST['test'];
                            $cidade = $_POST['tcid'];
                            $dt_nasc = $_POST['tnasc'];
                            $dt_cad = date('d-m-Y');
                            $resposta = $db->cliente_alt($nome, $tel, $cel, $email, $obs, $tgenero, $cep, $endereco, $casa, $complemento, $estado, $cidade, $dt_nasc, $dt_cad);
                        } else {
                            echo "<script>alert('Você não tem permissão para essa função.')</script>";
                        }
                    }
                    if (isset($_POST['tdel'])) {
                        if ($permissao == "1") {
                            echo "<script>let result = confirm('Deseja relamente deleta? Não será possivel recuperar os dados.')</script>";
                            $deletar = "<script>document.write(result)</script>";
                            $nome = $_POST['tnome'];
                            if ($permissao == "1") {
                                $resposta = $db->cliente_del($nome, $deletar);
                            } else {
                                echo "<script>alert('Você não tem permissão para deleta cliente.')</script>";
                            }
                        } else {
                            echo "<script>alert('Você não tem permissão para essa função.')</script>";
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </header>
</body>

</html>