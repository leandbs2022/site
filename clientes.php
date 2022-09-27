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
            <div class="row">
                <h1 class="alert alert-primary titulo centro borda" style="background-color: #e3f2fd;">Clientes</h1>

                <form method="post" id="fcontato" action="" oninput="cal_total();">
                    <hgroup>
                        <h1 class="centro">Formulário de cliente</h1>
                    </hgroup>
                    <fieldset id="cliente">
                        <legend>Identificação do Cliente</legend>
                        <p><label for="cnome">Nome:</label><input type="text" name="tnome " id="cnome" size="20" maxlength="20" placeholder="nome completo"></p>
                        <p>Senha:<input type="text" name="tsenha" id="csenha" size="8" maxlength="8" placeholder="senha"></p>
                        <p>E-mail:<input type="email" name="tmail" id="cmail" size="20" maxlength="40" placeholder="e-mail"></p>
                        <fieldset id="sexo">
                            <legend>sexo</legend>
                            <input type="radio" name="tgenero" id="cmasc" checked><label for="cmasc">Masculino</label> <br>
                            <input type="radio" name="tgenero" id="cfem"><label for="cfem">Feminino</label>
                        </fieldset>
                        <p>Data de Nascimento:<input type="date" name="tnasc " id="cnasc"></p>
                    </fieldset>
                    <fieldset id="endereco">
                        <legend>Endereço do Cliente</legend>
                        <p><label for="crua">Logradouro:</label><input type="text" name="trua" id="crua" size="40" maxlength="80" placeholder="endereço"></p>
                        <p><label for="cnum">Número:</label><input type="number" name="tnum" id="cnum" mix="0" max="999" placeholder="">
                        </p>
                        <p><label for="cest">Estado:</label>
                            <select name="test" id="cest">
                                <optgroup label="Centro oeste">
                                    <option value="DF">Brasília</option>
                                    <option value="GO" disabled>Goías</option>
                                </optgroup>
                                <optgroup label="Sudeste">
                                    <option value="SP" disabled>São Paulo</option>
                                    <option value="RJ" disabled>Rio de Janeiro</option>
                                </optgroup>
                                <optgroup label="Sul">
                                    <option value="RS" disabled>Rio grande do Sul</option>
                                    <option value="PR" disabled>Parana</option>
                                </optgroup>
                            </select>
                        </p>
                        <p><label for="ccid">Cidade:</label>
                            <input type="text" name="tcid" id="ccid" maxlength="40" size="20" placeholder="cidade" list="cidade" />
                        </p>
                        <datalist id="cidade">
                            <option value="Brasilia"></option>
                            <option value="Ceilândia"></option>
                            <option value="Gama"></option>
                        </datalist>
                    </fieldset>
                    <fieldset>
                        <p><input type="submit" class="button" id="ccadastro" name="tcadastro" value="Novo"> | <input type="submit" class="button" id="calterar" name="talterar" value="Alterar"> | <input type="submit" class="button" id="cdel" name="tdel" value="Deletar"></p>
                    </fieldset>
                </form>
            </div>
        </div>
    </header>
</body>

</html>