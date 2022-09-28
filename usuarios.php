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

<body>
    <?php
    if (isset($_POST['tlocaliza'])) {
        $nome = $_POST['tloc'];
        $resposta = $db->localizar_usuario($nome);
        $email = $_SESSION['email_l'];
        $nome =  $_SESSION["nome_l"];
    }
    if (isset($_POST['tcadastro'])) {
        $escolha = @$_POST['tperfil']; // Usado @, já que vai ser testado em seguida.
        if (empty($escolha)) $perfil = '0';
        else if ($escolha == '1') $perfil = '1';
        else if ($escolha == '2') $perfil = '2';
        else if ($escolha == '3') $perfil = '10';
        //dados campos
        $nome = $_POST['tnome'];
        $senha = $_POST['tsenha'];
        $confime = $_POST['tconfimr'];
        $email = $_POST['tmail'];
        $permissao = $_SESSION["perfil"];
        if ($permissao == 10) {
            if ($senha <> $confime) {
                echo "<script>alert('A Senha não confere!Favor digite novamente.')</script>";
            } else {
                $resposta = $db->usuario_add_alt($nome, $senha, $perfil, $email);
            }
        } else {
            echo "<script>alert('Você não tem permissão de adicionar usuário.')</script>";
        }
    }


    ?>
    <header class="container">
        <div class="mt-md-1">
            <div class="row ajuste">
                <h1 class="alert alert-primary titulo centro borda" style="background-color: #e3f2fd;">Usuários</h1>
            </div>
        </div>
    </header>
    <div class="mt-md-1">
        <div id="usuarios" class="row">
            <form method="post" id="fcontato" action="" id="cform" oninput="cal_total();">
                <hgroup>
                    <h1 class="centro">Formulário de Usuários</h1>
                </hgroup>
                <fieldset id="usuario flex_fiel">
                    <legend>Identificação do Usuário</legend>
                    <p>Nome: <input type="text" name="tnome" id="cnome" value="<?php echo $nome; ?>" size="20" maxlength="20" placeholder="nome"></p>
                    <p>Senha:<input type="password" name="tsenha" id="csenha" value="" size="8" maxlength="8" placeholder="senha"> Confirme:<input type="password" name="tconfimr" id="tconfirme" size="8" maxlength="8" placeholder="confirme"></p>
                    <p>E-mail:<input type="text" name="tmail" id="cmail" size="20" maxlength="40" placeholder="e-mail"> <label><?php echo "Email atual: {$email}"; ?></label></p>
                    <fieldset id="nivel">
                        <legend>Perfil</legend>
                        <input type="radio" name="tperfil" id="cPadrao" value="1" checked><label for="cPadrão">Administrativo</label> <br>
                        <input type="radio" name="tperfil" id="cavan" value="2"><label for="cavan">Vendedor</label> <br>
                        <input type="radio" name="tperfil" id="cadmin" value="3"><label for="cadmin">Gerente do sistema</label>
                    </fieldset>
                    <fieldset>
                        <p><input type="submit" class="button" id="ccadastro" name="tcadastro" value="Novo"> | <input type="submit" class="button" id="calterar" name="talterar" value="Alterar"> | <input type="submit" class="button" id="cdel" name="tdel" value="Deletar"></p>
                    </fieldset>

                    <fieldset>
                        <p><input type="submit" class="button" id="clocaliza" name="tlocaliza" value="pesquisar"><input type="text" size="23" maxlength="30" id="cloc" name="tloc" placeholder="digite nome"> </p>
                    </fieldset>
                </fieldset>

            </form>
        </div>
    </div>
</body>

</html>