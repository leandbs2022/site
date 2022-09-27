<?php
class site
{
    //Login de entrada - verificação de entrada
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

    function login_add_alt()
    {
        require("./conectar.php");

        $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'");
        if (mysqli_num_rows($query)) {
           
            return $query;
        } else {
            echo "<script>alert('Este usuário ja existe!!')</script>";
        }  
    }
    function login_del()
    {
    }
    //verificação se esta logado
    function validar()
    {
        if ($_SESSION['perfil'] == 0) {
            header('Location: index.php');
        }
    }

    //Cadastro de usuarios
    function usuario_add_alt()
    {
    }
    function usuario_del()
    {
    }
    function localizar_usuario()
    {
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
