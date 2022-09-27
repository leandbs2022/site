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
    <title>cadastro de Usuários</title>
</head>

<body>
    <header class="container">
        <div class="mt-md-1">
            <div class="row">
                <h1 class="alert alert-primary titulo centro borda" style="background-color: #e3f2fd;">Usuários</h1>
            </div>
        </div>
    </header>

<div class="mt-md-1">
        <div id="usuarios" class="row">
            <form method="post" id="fcontato" action="" oninput="cal_total();">
                <hgroup>
                    <h1 class="centro">Formulário de Usuários</h1>
                </hgroup>
                <fieldset id="usuario flex_fiel">
                    <legend>Identificação do Usuário</legend>
                    <p><label for="cnome">Nome:</label><input type="text" name="tnome " id="cnome" size="20" maxlength="20" placeholder="nome"></p>
                    <p>Senha:<input type="text" name="tsenha" id="csenha" size="8" maxlength="8" placeholder="senha">  Confirme:<input type="text" name="tconfimr" id="tconfirme" size="8" maxlength="8" placeholder="confirme" </p>
                    <p>E-mail:<input type="email" name="tmail" id="cmail" size="20" maxlength="40" placeholder="e-mail"></p>
                    <fieldset id="sexo">
                        <legend>sexo</legend>
                        <input type="radio" name="tgenero" id="cmasc" checked><label for="cmasc">Masculino</label> <br>
                        <input type="radio" name="tgenero" id="cfem"><label for="cfem">Feminino</label>
                    </fieldset>
                    <p>Data de Nascimento:<input type="date" name="tnasc " id="cnasc"></p>
                    <fieldset id="nivel">
                        <legend>Perfil</legend>
                        <input type="radio" name="tperfil" id="cPadrão" checked><label for="cPadrão">Administrativo</label> <br>
                        <input type="radio" name="tperfil" id="cavan" checked><label for="cavan">Vendedor</label> <br>
                        <input type="radio" name="tperfil" id="cadmin"><label for="cadmin">Gerente do sistema</label>
                    </fieldset>
                    <fieldset>
                        <p><input type="submit" class="button" id="ccadastro" name="tcadastro" value="Novo"> | <input type="submit" class="button" id="calterar" name="talterar" value="Alterar"> | <input type="submit" class="button" id="cdel" name="tdel" value="Deletar"></p>
                    </fieldset>
                    <fieldset>
                        <p><input type="submit" class="button" id="clocaliza" name="tlocaliza" value="pesquisar"> &nbsp; <input type="text" size="23"  maxlength="30"  id="cloc" name="tloc"  placeholder="digite nome" >  </p>
                    </fieldset>
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>