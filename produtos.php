<?php
session_start();
//conexão a classes
require('./class/class.site.php');
$db = new site;
$resposta = $db->validar();
//variaveis
$produto =  "";
$marca = "";
$modelo = "";
$valor = "";
$descr = "";
$tipo = "";
$dt_cad = "";
$quant = 0;
$id = 0;
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
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
-->
    <link rel="icon" type="image/x-icon" href="/img/favico.ico">
    <link rel="stylesheet" href="css/pages.css">
    <link rel="stylesheet" type="text/css" href="css/form.css" />
    <script src="js/script.js"></script>
    <title>cadastro de Produtos</title>
</head>

<body>
    <header class="container">
        <div class="mt-md-1">
            <div class="row">
                <h1 class="titulo centro borda fontebranca">Produtos</h1>
            </div>
        </div>
    </header>
    <section>
        <form method="POST">
            <?php
            //localizar registro
            if (isset($_POST['tlocaliza'])) {

                $produto = $_POST['tloc'];

                if (empty($produto)) {
                } else {
                    require("./conectar.php");
                    $query = mysqli_query($conn, "SELECT * FROM `produtos` WHERE produto ='$produto'")  or die(mysqli_error($conn));;
                    if (mysqli_num_rows($query)) {

                        while ($array = mysqli_fetch_row($query)) {
                            $id = $array[0];
                            $produto = $array[1];
                            $valor =  $array[2];
                            $quant = $array[3];
                            $dt_cad = $array[4];
                            $marca = $array[5];
                            $modelo = $array[6];
                            $tipo = $array[7];
                            $descr = $array[8];
                        }
                    } else {
                        echo "<script>alert('Niguém encontrado com esse nome!')</script>";
                    }
                }
            }
            ?>
            <fieldset id="produto">
                <legend id="legenda">Identificação do Produto</legend>
                <p class="fontebranca">ID:<?php echo $id; ?></p>
                <p><label class="fontebranca" for="cproduto">Produto:</label><input type="text" class="bordasimples espaco " value="<?php echo $produto; ?>" name="tproduto" id="cproduto" size="20" maxlength="40" placeholder="Produto"><span class="titulored"> Obrigatório</span></p>
                <p><label class="fontebranca" for="cmarca">Marca:</label><input type="text" class="bordasimples espaco " value="<?php echo $marca; ?>" name="tmarca" id="cmarca" size="20" maxlength="40" placeholder="Marca"><span class="titulored"> Obrigatório</span></p>
                <p><label class="fontebranca" for="cmodelo">Modelo:</label><input type="text" class="bordasimples" value="<?php echo $modelo; ?>" name="tmodelo" id="cmodelo" size="11" maxlength="15" placeholder="Modelo"><span class="titulored"> Obrigatório</span></p>
                <p><label class="fontebranca" for="cvalor"> Valor:</label><input type="text" class="bordasimples" value="<?php echo $valor; ?>" name="tvalor" id="cvalor" size="11" maxlength="15" placeholder="valor"><span class="titulored"> Obrigatório</span></p>
                <p><label class="fontebranca" for="cquant">Quantidade:</label><input type="number" value="<?php echo $quant; ?>" name="tquant" id="cquant" class="bordasimples" size="20" maxlength="40" placeholder="quantidade"><span class="titulored"> Obrigatório</span></p>
                <p><label class="fontebranca" for="ctipo">Tipo:</label>
                    <select id="ctipo" name="ttipo" class="bordaT">
                        <option><?php echo $tipo; ?></option>
                        <option>tv</option>
                        <option>Som</option>
                        <option>Eletrônicos</option>
                        <option>Smartphones</option>
                        <option>Iphones</option>
                        <option>Eletrodomésticos</option>
                    </select><span class="titulored"> Obrigatório</span>
                </p>
                <p><label class="fontebranca" for="cdescr">Descrição:</label><input type="text" class="bordasimples" value="<?php echo $descr; ?>" name="tdescr" id="cdecsr" size="80" maxlength="80" placeholder="Descrição:"></p>
                <fieldset id="sexo" class="bordasimples">
                    <legend></legend>
                    <p><input type="submit" class="button" id="ccadastro" name="tcadastro" value="Novo"> |
                        <input type="submit" class="button" id="calterar" name="talterar" value="Alterar"> |
                        <input type="submit" class="button" id="cdel" name="tdel" value="Deletar">|
                        <input type="submit" class="button #legenda" id="clocaliza" name="tlocaliza" value="pesquisar">
                        <img class="imgdireita" src="img/dedodireita.svg"><select id="cloc" name="tloc" class="bordaT">
                            <?php
                            require("./conectar.php");
                            $query = mysqli_query($conn, "SELECT * from produtos where 1");
                            if (mysqli_num_rows($query)) {
                                while ($array1 = mysqli_fetch_row($query)) {
                                    $produto = $array1[1];
                                    echo "<option>{$produto}</option>";
                                }
                            }
                            ?>
                        </select>
                    </p>
                </fieldset>
        </form>
    </section>
    <section>
        <div >
            <?php
            $resposta = $db->produtos();
            ?>
        </div>
    </section>
    <?php
    if (isset($_POST['tcadastro'])) {
        if ($permissao == "1") {
            $produto =  $_POST['tproduto'];
            $marca =  $_POST['tmarca'];
            $modelo = $_POST['tmodelo'];
            $valor = $_POST['tvalor'];
            $quant = $_POST['tquant'];
            $descr = $_POST['tdescr'];
            $tipo = $_POST['ttipo'];
            $dt_cad = date('d-m-Y');

            if (empty($produto) || empty($marca) || empty($modelo) || empty($valor) || empty($quant) || empty($tipo)) {
                echo "<script>alert('Falta preencher algumas informações obrigatórias ou faça uma busca para alterar!')</script>";
            } else {
                $resposta = $db->produto_add($produto, $marca, $modelo, $valor, $descr, $tipo, $dt_cad, $quant);
            }
        } else {
            echo "<script>alert('Você não tem permissão para essa função.')</script>";
        }
    }
    if (isset($_POST['talterar'])) {
        if ($permissao == "1") {
            $produto =  $_POST['tproduto'];
            $marca =  $_POST['tmarca'];
            $modelo = $_POST['tmodelo'];
            $valor = $_POST['tvalor'];
            $quant = $_POST['tquant'];
            $descr = $_POST['tdescr'];
            $tipo = $_POST['ttipo'];
            $dt_cad = date('d-m-Y');
            if (
                empty($produto) || empty($marca) || empty($modelo) || empty($valor) || empty($quant) ||
                empty($tipo)
            ) {
                echo "<script>alert('Falta preencher algumas informações obrigatórias ou faça uma busca para alterar!')</script>";
            } else {
                $resposta = $db->produto_alt($produto, $marca, $modelo, $valor, $descr, $tipo, $dt_cad, $quant);
            }
        } else {
            echo "<script>alert('Você não tem permissão para essa função.')</script>";
        }
    }
    if (isset($_POST['tdel'])) {
        $resposta = $db->produto_del();
    }
    ?>
</body>

</html>