<?php 
session_start();
require("./class/class.site.php");
require("./conectar.php");
$site= new site;
 header("Content-type: application/vnd.ms-powerpoint");
 header("Content-type: application/force-download");
 header("Content-Disposition: attachment; filename=dados.ppt");
 header("Pragma: no-cache");
 $nome="";
 $op="";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>  
    <meta charset="utf-8">
    <title>Clientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Impressão com PDV">
    <meta name="author" content="Leandro Barbosa">
</head>
<script type="text/javascript">
        window.print();
    </script>
<body>
    <div class="container">
        <?php 
		$responsavel=$site->clientes_excel();
		?>
    </div>
</body>
</html>