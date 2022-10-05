<?php
session_start();
require("./class/class.site.php");
require("./conectar.php");
$db = new site;
?>
<!DOCTYPE html>
<html lang="pt=br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <input type="submit" id="cimp" name="timp" value="gerar pdf">
    <link rel="stylesheet" href="css/impressao.css">
</head>
<body>
    <header>
        <?php
        if (isset($_POST[('timp')])) {
            header("Location:impressao_impr2.php");
        }
        ?>
        <p class="container"> <img id="logo" src="img/logo.png"></p>
    </header><br>
    <form method="POST">
        <div >
            <?php
            $resposta = $db->clientes_excel();
            ?>
        </div>
    </form>
</body>

</html>