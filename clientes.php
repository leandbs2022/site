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
$cod = 0;
$sobre = "";
$op = '0';
//perfil de acesso
$permissao = $_SESSION["perfil"];
$_SESSION[('pdf')] = "";
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
    <title>cadastro de Clientes</title>
</head>
<header class="container">
        <div class="mt-md-1">
            <div class="row ajuste">
                <h1 class="alert alert-primary titulo centro borda fontebranca">Clientes</h1>
                <form method="post" id="fcontato" action="" oninput="cal_total()" onload="">
                    <hgroup>
                        <h1 class="centro fontebranca">Formulário de cliente</h1>
                        <?php

                        if (isset($_POST['timpressaoexcel'])) {
                            $op = $_POST[('tcliente')];
                            $nome =  $_POST['tnome'];
                            if ($op == "Individual" or $op == "Todos") {

                                if (empty($nome) and $op == "Individual") {
                                    echo "<script>alert('Faça uma busca do cliente a ser gerado relatorório!')</script>";
                                } else {

                                    $_SESSION['impressão'] = $_POST['tnome'];
                                    $_SESSION['op'] = $op;

                                    header("Location:impressao_impr.php");
                                }
                            }
                        }

                        if (isset($_POST['timpressaopdf'])) {
                            $op = $_POST[('tcliente')];
                            $nome =  $_POST['tnome'];

                            if ($op == "Individual" or $op == "Todos") {

                                if (empty($nome) and $op == "Individual") {
                                    echo "<script>alert('Faça uma busca do cliente a ser gerado relatorório!')</script>";
                                } else {

                                    $_SESSION['impressão'] = $_POST['tnome'];
                                    $_SESSION['op'] = $op;
                                    header("Location:impressao_impr2.php");
                                }
                            }
                        }
                        if (isset($_POST['tlocaliza'])) {

                            $nome = $_POST['tloc'];
                            if (empty($nome)) {
                            } else {

                                require("./conectar.php");
                                $query = mysqli_query($conn, "SELECT * FROM `clientes` WHERE nome ='$nome'");
                                if (mysqli_num_rows($query)) {

                                    while ($array = mysqli_fetch_row($query)) {
                                        $id = $array[0];
                                        $nome = $array[1];
                                        $sobre =  $array[2];
                                        $endereco = $array[3];
                                        $estado = $array[4];
                                        $cidade = $array[5];
                                        $cep = $array[6];
                                        $tel = $array[7];
                                        $cel = $array[8];
                                        $tgenero = $array[9];
                                        $email = $array[10];
                                        $dt_nasc = $array[11];
                                        $dt_cad = $array[12];
                                        $obs = $array[13];
                                        $casa = $array[14];
                                        $complemento = $array[15];
                                    }
                                } else {
                                    echo "<script>alert('Niguém encontrado com esse nome!')</script>";
                                }
                            }
                        }
                        ?>
                    </hgroup>
                    </header>
<body onload="botao()">
    
                    <section>
                    <fieldset id="cliente">
                        <legend id="legenda">Identificação do Cliente</legend>
                        <p class="fontebranca">ID:<?php echo $id; ?></p>
                        <p><label class="fontebranca" for="cnome">Nome:</label><input type="text" class="bordasimples espaco " value="<?php echo $nome; ?>" name="tnome" id="cnome" size="20" maxlength="40" placeholder="Nome"><span class="titulored"> Obrigatório</span></p>
                        <p><label class="fontebranca" for="cnome">Sobrenome:</label><input type="text" class="bordasimples espaco " value="<?php echo $sobre; ?>" name="tsobre" id="csobre" size="20" maxlength="40" placeholder="Sobrenome"><span class="titulored"> Obrigatório</span></p>
                        <p><label class="fontebranca" for="ctel">Tel:</label><input type="text" class="bordasimples" value="<?php echo $tel; ?>" name="ttel" id="ctel" size="11" maxlength="11" placeholder="Telefone"></p>
                        <p><label class="fontebranca" for="ccel"> Cel:</label><input type="text" class="bordasimples" value="<?php echo $cel; ?>" name="tcel" id="ccel" size="11" maxlength="11" placeholder="Celular"></p>
                        <p><label class="fontebranca" for="cemail">E-mail:</label>&nbsp;<input type="email" value="<?php echo $email; ?>" name="tmail" id="cmail" class="bordasimples" size="20" maxlength="40" placeholder="e-mail"><span class="titulored"> Obrigatório</span></p>
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
                        <p><label class="fontebranca" for="ccep">Cep:</label><input type="text" value="<?php echo $cep; ?>" class="bordasimples" name="tcep" id="ccep" size="12" maxlength="12" placeholder="cep"></i></p>
                        <p><label class="fontebranca" for="crua">Log.:</label><input type="text" value="<?php echo $endereco; ?>" class="bordasimples" name="trua" id="crua" size="40" maxlength="80" placeholder="endereço"><span class="titulored"> Obrigatório</span></p>
                        <p><label class="fontebranca" for="cnum">Nº:</label><input class="bordasimples" value="<?php echo $casa; ?>" type="number" name="tnum" id="cnum" mix="0" max="999" placeholder=""> <span class="titulored"> Obrigatório</span></p>
                        <p><label class="fontebranca" for="ccom">Complemento:</label><input class="bordasimples" type="text" value="<?php echo $complemento; ?>" name="tcom" id="ccom" placeholder=""><span class="titulored"> Obrigatório</span></p>
                        <p><label for="cest" class="fontebranca">Estado:</label>
                            <select class="bordasimples bordaT" name="test" id="cest">
                                <option><?php echo $estado; ?></option>
                                <option value="DF">DF</option>
                            </select>
                            <span class="titulored"> Obrigatório</span>
                        </p>
                        <p><label class="fontebranca" for="ccid">Cidade:</label>
                            <input type="text" class="bordasimples bordaT" name="tcid" id="ccid" maxlength="40" size="20" value="<?php echo $cidade; ?>" placeholder="cidade" list="cidade" />
                            <span class="titulored"> Obrigatório</span>
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
                            <input type="submit" class="button #legenda" id="clocaliza" name="tlocaliza" value="pesquisar">
                            <img class="imgdireita" src="img/dedodireita.svg"><select id="cloc" name="tloc" class="bordaT">
                                <?php

                                require("./conectar.php");
                                $query = mysqli_query($conn, "SELECT * from clientes where 1");
                                if (mysqli_num_rows($query)) {
                                    while ($array1 = mysqli_fetch_row($query)) {
                                        $cliente = $array1[1];
                                        echo "<option>{$cliente}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </p>
                    </fieldset>
                    <fieldset>
                        <legend>Impressão</legend>
                        <div class=" mt-md-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <select id="ccliente" name="tcliente" class="bordaT">
                                        <option>Todos</option>
                                        <option>Individual</option>
                                    </select>
                                </div><br>
                                <div class="col-md-3">
                                    <input type="submit" id="cimpressaoexcel" name="timpressaoexcel" class="button" value="Excel"> | <input type="submit" src="img/pdf.png" id="cimpressaopdf" name="timpressaopdf" class="button" value="PDF">
                                </div>
                            </div>
                        </div>
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
                        $sobre =  $_POST['tsobre'];
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


                        if (
                            empty($nome) || empty($email) || empty($endereco) || empty($casa) || empty($complemento) ||
                            empty($estado) || empty($cidade)
                        ) {
                            echo "<script>alert('Falta preencher algumas informações obrigatórias!')</script>";
                        } else {
                            $resposta = $db->cliente_add($nome, $sobre, $tel, $cel, $email, $obs, $tgenero, $cep, $endereco, $casa, $complemento, $estado, $cidade, $dt_nasc, $dt_cad);
                        }
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
                            $sobre =  $_POST['tsobre'];
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
                            if (
                                empty($nome) || empty($sobre) || empty($email) || empty($endereco) || empty($casa) || empty($complemento) ||
                                empty($estado) || empty($cidade)
                            ) {
                                echo "<script>alert('Falta preencher algumas informações que são obrigatórias!')</script>";
                            } else {
                                $resposta = $db->cliente_alt($nome, $sobre, $tel, $cel, $email, $obs, $tgenero, $cep, $endereco, $casa, $complemento, $estado, $cidade, $dt_nasc);
                            }
                        } else {
                            echo "<script>alert('Você não tem permissão para essa função.')</script>";
                        }
                    }
                    if (isset($_POST['tdel'])) {
                        $nome =  $_POST['tnome'];
                        if ($permissao == "1") {
                            $resposta = $db->cliente_del($nome);
                        } else {
                            echo "<script>alert('Você não tem permissão para deleta cliente.')</script>";
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
        </section>
        <section>
        <legend>Passe o mouse abaixo para ver todos os clientes</legend>
        <div id="pesq" class="bordaT centro ">
            <?php $resposta = $db->visiualzar_Clientes(); ?>
        </div>
        </section>

</body>

</html>