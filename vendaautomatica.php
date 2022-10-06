<?php
session_start();
//conexão a classes
require('./class/class.site.php');
$db = new site;
$resposta = $db->validar();
$reg = 0;
$count = 0;
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
    <link rel="stylesheet" href="css/pages.css">
    <link rel="stylesheet" href="css/form.css">
    <script src="js/script.js"></script>
    <title>cadastro de Fornecedores</title>
</head>
<body style="background-color:#2E2E2E;">
    <section>
        <form method="post">
            <h1 class="titulo centro borda fontebranca">Vendas</h1>
            <fieldset id="venda">
                        <legend>Endereço do Cliente</legend>
            <p><label class="fontebranca" for="creg">Digite a qunatidade:</label><input type="number" class="" id="creg"  value = "0" min="0" max="999" size="4" name="treg" placeholder="digite"> | <input type="submit" class="button" id="ccadastro" name="tcadastro" value="Gerar auto"> | <input type="submit" class="button #legenda" id="clocaliza" name="tlocaliza" value="pesquisar"><img class="imgdireita" src="img/dedodireita.svg"><select id="cloc" name="tloc" class="bordaT"></p>
            </fieldset>
                    <?php
                    ///carregado o select
                    require("./conectar.php");
                    $query = mysqli_query($conn, "SELECT distinct data from vendas");
                    if (mysqli_num_rows($query)) {
                        while ($array1 = mysqli_fetch_row($query)) {
                            $datap = $array1[0];
                            echo "<option>{$datap}</option>";
                        }
                    }
                    ?>
                </select></p>
            <div class="border border-1">
                <?php
                //cadastro de venda automatico
                if (isset($_POST['tcadastro'])) {
                    $reg = $_POST['treg'];
                    for ($i=0; $i < $reg; $i++) { 
                        $count++;
                        $resposta = $db->vendas_automatica();
                       if($count == $reg){
                        echo "<script>alert('Registros criados com sucesso!!!')</script>";
                        $color = "#ffffff";
                        $query = mysqli_query($conn, "SELECT * FROM vendas WHERE 1")  or die(mysqli_error($conn));
                        if (mysqli_num_rows($query)) {
                            $estilos[0] = "background-color: #BDBDBD;font-size:12px;color:black;font-style:bold;font-family:Arial;
                        text-align: center; width: 4%;";
                
                        echo "<table style=\"width: Auto\" cellpadding=\"0\" cellspacing=\"0\" border=\"2\"><tbody><tr>
                        <td style=\"$estilos[0]\">ID_venda</td>
                          <td style=\"$estilos[0]\">ID_Cliente</td>
                          <td style=\"$estilos[0]\">ID_Produto</td>
                          <td style=\"$estilos[0]\">ID_Funcionário</td>
                          <td style=\"$estilos[0]\">Data</td>
                          <td style=\"$estilos[0]\">Valor</td>
                          <td style=\"$estilos[0]\">Unid.</td>
                          <td style=\"$estilos[0]\">Data Comprar</td>
                           </tr>";
                            while ($array = mysqli_fetch_row($query)) {
                                $estilos[1] = "background-color:{$color};font-size:12px;color:black;
                          font-style:bold;font-family: Times New Roman, Times, serif;
                          text-align: center; width: auto;";
                                echo "<tr>
                          <td style=\"$estilos[1]\">$array[0]</td>
                          <td style=\"$estilos[1]\">$array[1]</td>
                          <td style=\"$estilos[1]\">$array[2]</td>
                          <td style=\"$estilos[1]\">$array[3]</td>
                          <td style=\"$estilos[1]\">$array[4]</td>
                          <td style=\"$estilos[1]\">$array[5]</td>
                          <td style=\"$estilos[1]\">$array[6]</td>
                          <td style=\"$estilos[1]\">$array[7]</td>
                           </tr>";
                            }
                       } 
                    }  
                }
            }
                ///localizar vendaz por ano
                if (isset($_POST['tlocaliza'])) {
                    $nome = $_POST['tloc'];
                    if (empty($nome)) {
                    } else {
                        require("./conectar.php");
                        $query = mysqli_query($conn, "SELECT * FROM `vendas` WHERE data ='$nome' order by dt_compra asc") or die(mysqli_error($conn));;
                        if (mysqli_num_rows($query)) {


                            $estilos[0] = "background-color: #BDBDBD;font-size:12px;color:black;font-style:bold;font-family:Arial;
            text-align: center; width: 4%;";

                            echo "<table style=\"width: Auto\" cellpadding=\"0\" cellspacing=\"0\" border=\"2\"><tbody><tr>
            <td style=\"$estilos[0]\">ID_venda</td>
              <td style=\"$estilos[0]\">ID_Cliente</td>
              <td style=\"$estilos[0]\">ID_Produto</td>
              <td style=\"$estilos[0]\">ID_Funcionário</td>
              <td style=\"$estilos[0]\">Data</td>
              <td style=\"$estilos[0]\">Valor</td>
              <td style=\"$estilos[0]\">Unid.</td>
              <td style=\"$estilos[0]\">Compra</td>
               </tr>";
                            while ($array = mysqli_fetch_row($query)) {
                                $estilos[1] = "background-color:#ffffff;font-size:12px;color:black;
              font-style:bold;font-family: Times New Roman, Times, serif;
              text-align: center; width: auto;";
                                echo "<tr>
              <td style=\"$estilos[1]\">$array[0]</td>
              <td style=\"$estilos[1]\">$array[1]</td>
              <td style=\"$estilos[1]\">$array[2]</td>
              <td style=\"$estilos[1]\">$array[3]</td>
              <td style=\"$estilos[1]\">$array[4]</td>
              <td style=\"$estilos[1]\">$array[5]</td>
              <td style=\"$estilos[1]\">$array[6]</td>
              <td style=\"$estilos[1]\">$array[7]</td>
               </tr>";
                            }
                        }
                    }
                }
                ?>
            </div>
        </form>
    </section>
</body>

</html>