<?php
class site
{
    //Login de entrada

    //verificação de entrada
    function login($nome, $senha)
    {
        require("./conectar.php");
        $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'");
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $cript = $array[2];
                $sen = base64_decode($cript);
                if ($senha == $sen) {
                    date_default_timezone_set('America/Sao_Paulo');
                    $_SESSION['data'] = date('d/m/Y H:i');
                    $_SESSION['nome'] = $array[1];
                    $_SESSION['perfil'] = $array[3];
                    echo $_SESSION['perfil'];
                    if ($_SESSION['perfil'] <> 10) {
                        $_SESSION['nivel'] = "Padrão";
                    } else {
                        $_SESSION['nivel'] = "Administrador";
                    }
                    $jaVisitou = @$_SESSION["jaVisitou"];
                    $linha = file("contador.txt");

                    if ($jaVisitou) {
                        $visitas = $linha[0];
                    } else {
                        $visitas = $linha[0];
                        $visitas += 1;
                        $cf = fopen("contador.txt", "w");
                        fputs($cf, "$visitas");
                        fclose($cf);
                        $_SESSION["jaVisitou"] = true;
                    }
                    header('Location: main.php');
                } else {
                    echo "<script>alert('Acesso negado tente novamente senha incorreta!')</script>";
                }
            }
            return $query;
        } else {
            echo "<script>alert('Acesso negado tente novamente nome incorreto!')</script>";
        }
    }
    //verificação se esta logado
    function validar()
    {
        if ($_SESSION['perfil'] == 0) {
            header('Location: index.php');
        }
    }

    //Cadastro de usuarios
    function usuario_add_alt($nome, $senha, $perfil, $email)
    {
        $error = "";
        require("./conectar.php");
        $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'");
        if (mysqli_num_rows($query)) {
            echo "<script>alert('o usuário ja existe!')</script>";
        } else {
            $cript = base64_encode($senha);
            $query = mysqli_query($conn, "INSERT INTO `usuarios`(`nome`, `senha`, `perfil`, `email`) VALUES ('$nome','$cript','$perfil','$email')") or die(mysqli_error($error));
            echo "<script>alert('o usuário criado com sucesso!')</script>";
        }
    }
    function usuario_del()
    {
    }
    function localizar_usuario($nome)
    {
        $error = "";
        require("./conectar.php");
        $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'");
        if (mysqli_num_rows($query)) {
            $estilos[0] = "background-color: #e3f2fd;font-size:18px;color:black;font-style:bold;font-family:Arial;
      text-align: center; width:auto;";
            echo "<table style=\"width: auto\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
      <td style=\"$estilos[0]\">Usuário</td>
      <td style=\"$estilos[0]\">Perfil</td>
      <td style=\"$estilos[0]\">E-mail</td>";
            while ($array = mysqli_fetch_row($query)) {

                $estilos[1] = "background-color: white;font-size:16px;color:black;
                font-style:bold;font-family: Times New Roman, Times, serif;
                text-align: center;width: 75%;";

                echo "<tr>
            
            <td style=\"$estilos[1]\">$array[1]</td>
            <td style=\"$estilos[1]\">$array[3]</td>
            <td style=\"$estilos[1]\">$array[4]</td>

           
             </tr>";

                $_SESSION["nome_l"] = $array[1];
                $_SESSION["perfil_l"] = $array[3];
                $_SESSION['email_l'] = $array[4];
            }
        } else {
            echo "<script>alert('Niguém encontrado com esse nome!')</script>";
        }
    }


    //Cadastro de clientes
    function cliente_add_alt()
    {
    }
    function cliente_del()
    {
    }
    function localizar_clientes()
    {
    }


    //Cadastro de funcionario
    function funcionario_add_alt()
    {
    }
    function funcionario_del()
    {
    }
    function localizar_funcionarios()
    {
    }

    //Cadastro de forndecedor
    function forndecedor_add_alt()
    {
    }
    function forndecedor_del()
    {
    }
    function localizar_forndecedores()
    {
    }

    //Cadastro de produto
    function produto_add_alt()
    {
    }
    function produto_del()
    {
    }
    function localizar_produtos()
    {
    }

    //vendas
    function vendas_add()
    {
    }
    function vendas_alt()
    {
    }
    function localizar_vendas()
    {
    }


    //relatorios excel / PDF
    function excel()
    {
    }
    function pdf()
    {
    }

    //contador de acesso
    function contador_ver()
    {
        $jaVisitou = @$_SESSION["jaVisitou"];
        $linha = file("contador.txt");

        if ($jaVisitou) {
            $visitas = $linha[0];
        } else {
            $visitas = $linha[0];
            $visitante = $visitas;
            $_SESSION["jaVisitou"] = true;
        }
        $result =  $visitas = number_format("$visitante", 0, "", ".");
        echo "<h6>Você é o visitante número: {$result}</6>";
    }
}
