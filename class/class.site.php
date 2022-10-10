<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class site //classe - Funcões
{
    //////////////////////////////////////////////Login de entrada//////////////////////////////////////////////////

    //verificação de entrada
    function login($nome, $senha)
    {
        require("./conectar.php");
        $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'")  or die(mysqli_error($conn));;
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $cript = $array[2];
                $sen = base64_decode($cript);
                if ($senha == $sen) {
                    date_default_timezone_set('America/Sao_Paulo');
                    $_SESSION['data'] = date('d/m/Y H:i');
                    $_SESSION['nome'] = $array[1];
                    $_SESSION['perfil'] = $array[3];
                    $_SESSION['id_f'] = $array[0];
                    echo $_SESSION['perfil'];
                    if ($_SESSION['perfil'] <> 1) {
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

    /////////////////////////////////////////Cadastro de usuarios////////////////////////////////////////////////
    function usuario_add($nome, $senha, $perfil, $email)
    {
        require("./conectar.php");
        $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'");

        if (mysqli_num_rows($query)) {
            echo "<script>alert('O usuário ja existe!')</script>";
        } else {
            $cript = base64_encode($senha);
            $query = mysqli_query($conn, "INSERT INTO `usuarios`(`nome`, `senha`, `perfil`, `email`) VALUES ('$nome','$cript','$perfil','$email')")  or die(mysqli_error($conn));;
            echo "<script>alert('o usuário criado com sucesso!')</script>";
        }
    }

    //alterar usuarios
    function usuario_alt($nome, $senha, $perfil, $email)
    {
        if (empty($nome)) {
            echo "<script>alert('Faça uma busca do usuário a ser alterado depois click em alterar!')</script>";
        } else {

            require("./conectar.php");
            $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'")  or die(mysqli_error($conn));;
            if (mysqli_num_rows($query)) {
                while ($array = mysqli_fetch_row($query)) {
                    $id = $array[0];
                }
                $cript = base64_encode($senha);
                $query = mysqli_query($conn, "UPDATE `usuarios` SET `senha`='$cript',`perfil`='$perfil',`email`='$email' WHERE id='$id'")  or die(mysqli_error($conn));;
                echo "<script>alert('o usuário atualizado com sucesso!')</script>";
            } else {
                echo "<script>alert('o usuário não existe!')</script>";
            }
        }
    }
    //deleta usuarios
    function usuario_del($nome)
    {
        if (empty($nome)) {
            echo "<script>alert('Faça uma busca do usuário a ser deletado depois click em deletar!')</script>";
        } else {
            require("./conectar.php");
            $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'") or die(mysqli_error($conn));;
            if (mysqli_num_rows($query)) {
                while ($array = mysqli_fetch_row($query)) {
                    $id = $array[0];
                }
                $query = mysqli_query($conn, "DELETE FROM `usuarios` WHERE id='$id'");
                echo "<script>alert('o usuário deletado com sucesso!')</script>";
            } else {
                echo "<script>alert('Verificar se usuário que deseja deleta realmente existe!')</script>";
            }
        }
    }
    //localizar usuarios
    function localizar_usuario($nome)
    {

        require("./conectar.php");
        $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'")  or die(mysqli_error($conn));;
        if (mysqli_num_rows($query)) {
            /* $estilos[0] = "background-color: #e3f2fd;font-size:18px;color:black;font-style:bold;font-family:Arial;
      text-align: center; width:auto;";
            echo "<table style=\"width: auto\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
      <td style=\"$estilos[0]\">Usuário</td>
      <td style=\"$estilos[0]\">Perfil</td>
      <td style=\"$estilos[0]\">E-mail</td>";*/
            while ($array = mysqli_fetch_row($query)) {

                /* $estilos[1] = "background-color: white;font-size:16px;color:black;
                font-style:bold;font-family: Times New Roman, Times, serif;
                text-align: center;width: 75%;";

                echo "<tr>
            
            <td style=\"$estilos[1]\">$array[1]</td>
            <td style=\"$estilos[1]\">$array[3]</td>
            <td style=\"$estilos[1]\">$array[4]</td>

           
             </tr>";*/

                $_SESSION["nome_l"] = $array[1];
                $_SESSION["perfil_l"] = $array[3];
                $_SESSION['email_l'] = $array[4];
            }
        } else {
            echo "<script>alert('Niguém encontrado com esse nome!')</script>";
        }
    }

    ///////////////////////////////////////////////////Cadastro de clientes///////////////////////////////////////////////////
    function cliente_add($nome, $sobre, $tel, $cel, $email, $obs, $tgenero, $cep, $endereco, $casa, $complemento, $estado, $cidade, $dt_nasc, $dt_cad)
    {
        require("./conectar.php");
        $query = mysqli_query($conn, "SELECT * FROM `clientes` WHERE email='$email'");
        if (mysqli_num_rows($query)) {
            echo "<script>alert('Este cliente já existe!')</script>";
        } else {

            $nome =   ucwords($nome);
            $sobre =   ucwords($sobre);
            $obs =  ucwords($obs);
            $tgenero =  ucwords($tgenero);
            $endereco = strtoupper($endereco);
            $estado =  strtoupper($estado);
            $cidade =  ucwords($cidade);
            $complemento =  ucwords($complemento);

            $query = mysqli_query($conn, "INSERT INTO `clientes`(`nome`,`sobre`, `endereco`, `estado`, `cidade`, `cep`, `tel`, `cel`, `sexo`, `email`, `data_nasc`, `data`, `obs`,`lote`,`comple`) 
            VALUES ('$nome','$sobre','$endereco','$estado','$cidade','$cep','$tel','$cel','$tgenero','$email','$dt_nasc','$dt_cad','$obs','$casa','$complemento')") or die(mysqli_error($conn));
            echo "<script>alert('o usuário criado com sucesso!')</script>";
        }
    }
    function cliente_alt($nome, $sobre, $tel, $cel, $email, $obs, $tgenero, $cep, $endereco, $casa, $complemento, $estado, $cidade, $dt_nasc)
    {
        require("./conectar.php");
        $query = mysqli_query($conn, "SELECT * FROM `clientes` WHERE email='$email'");
        if (mysqli_num_rows($query)) {
            $id = 0;
            $nome =   ucwords($nome);
            $sobre =   ucwords($sobre);
            $obs =  ucwords($obs);
            $tgenero =  ucwords($tgenero);
            $endereco = strtoupper($endereco);
            $estado =  strtoupper($estado);
            $cidade =  ucwords($cidade);
            $complemento =  ucwords($complemento);

            $query = mysqli_query($conn, "SELECT * FROM `clientes` WHERE email='$email'");
            if (mysqli_num_rows($query)) {
                while ($array = mysqli_fetch_row($query)) {
                    $id = $array[0];
                }
                $query = mysqli_query($conn, "UPDATE `clientes` SET `nome`='$nome',`sobre`='$sobre',`endereco`='$endereco',`estado`='$estado',`cidade`='$cidade',`cep`='$cep',`tel`='$tel',`cel`='$cel',`sexo`='$tgenero',`email`='$email',`data_nasc`='$dt_nasc',
            `obs`='$obs',`lote`='$casa',`comple`='$complemento' WHERE id_clientes='$id'") or die(mysqli_error($conn));
                echo "<script>alert('o usuário alterado com sucesso!')</script>";
            }
        } else {

            echo "<script>alert('o usuário não encontrado!')</script>";
        }
    }

    function cliente_del($nome)
    {
        if (empty($nome)) {
            echo "<script>alert('Faça uma busca do cliente a ser deletado depois click em deletar!')</script>";
        } else {
            require("./conectar.php");

            $query = mysqli_query($conn, "SELECT * FROM `clientes` WHERE nome='$nome'");
            if (mysqli_num_rows($query)) {
                while ($array = mysqli_fetch_row($query)) {
                    $id = $array[0];
                }
                echo "teste";
                $query  = mysqli_query($conn, "DELETE FROM `clientes` WHERE id_clientes='$id'") or die(mysqli_error($conn));
                echo "<script>alert('o cliente deletado com sucesso!')</script>";
            } else {

                echo "<script>alert('Verificar se cliente que deseja deleta realmente existe!')</script>";
            }
        }
    }

    ///////////////////////////////////////////////////Cadastro de produtos///////////////////////////////////////////////////
    function produto_alt($produto, $marca, $modelo, $valor, $descr, $tipo, $dt_cad, $quant)
    {
        require("./conectar.php");
        $query = mysqli_query($conn, "SELECT * FROM `produtos` WHERE produto='$produto'")  or die(mysqli_error($conn));;
        if (mysqli_num_rows($query)) {
            $id = 0;
            $produto =   ucwords($produto);
            $marca =   ucwords($marca);
            $modelo =  ucwords($modelo);
            $tipo = strtoupper($tipo);
            $descr =  strtoupper($descr);
            $query = mysqli_query($conn, "SELECT * FROM `produtos` WHERE produto='$produto'")  or die(mysqli_error($conn));;
            if (mysqli_num_rows($query)) {
                while ($array = mysqli_fetch_row($query)) {
                    $id = $array[0];
                }
                $query = mysqli_query($conn, "UPDATE `produtos` SET `produto`='$produto',`valor`='$valor',`quant`='$quant',`dt_atualizada`='$dt_cad',
            `marca`='$marca',`modelo`='$modelo',`tipo`='$tipo',`descricao`='$descr' WHERE id_produtos='$id'") or die(mysqli_error($conn));
                echo "<script>alert('Produto alterado com sucesso!')</script>";
            }
        } else {
            echo "<script>alert('Produto não encontrado!')</script>";
        }
    }
    function produto_add($produto, $marca, $modelo, $valor, $descr, $tipo, $dt_cad, $quant)
    {
        require("./conectar.php");
        $query = mysqli_query($conn, "SELECT * FROM `produtos` WHERE produto='$produto'");
        if (mysqli_num_rows($query)) {
            echo "<script>alert('Este produto já existe!')</script>";
        } else {

            $produto =   ucwords($produto);
            $marca =   ucwords($marca);
            $modelo =  ucwords($modelo);
            $tipo = strtoupper($tipo);
            $descr =  strtoupper($descr);

            $query = mysqli_query($conn, "INSERT INTO `produtos`(`produto`, `valor`, `quant`, `dt_atualizada`, `marca`, `modelo`, `tipo`, `descricao`) 
            VALUES ('$produto','$valor','$quant','$dt_cad','$marca','$modelo','$tipo','$descr')") or die(mysqli_error($conn));
            echo "<script>alert('o produto criado com sucesso!')</script>";
        }
    }
    function produto_del()
    {
        echo "<script>alert('Produto não pode ser deletado só alterado!')</script>";
    }
    function localizar_produtos()
    {
    }

    //vendas
    function vendas_automatica()
    {
        require("./conectar.php");
        $id = 0;
        $id_f = $_SESSION['id_f'];
        $id_p = 0;
        $valor = 0;
        $anoatual = date('Y');
        $data = rand(2018,  $anoatual);
        $dia = rand(1, 30);
        $mes = rand(1, 12);
        $datac = $dia . '-' . $mes . '-' . $data; //SELECT * FROM `vendas` WHERE `dt_compra`>'01/01/2018' and `dt_compra`<'01/12/2022';
        $dt_venda = $datac;
        $unid = "0";
        $valida = 0;
        $contar = 0;

        $query = mysqli_query($conn, "SELECT * FROM clientes ORDER BY RAND() LIMIT 1") or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $id = $array[0];
            }
            $valida = 1;
        }

        $query = mysqli_query($conn, "SELECT * FROM produtos ORDER BY RAND() LIMIT 1") or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $id_p = $array[0];
                $valor  = $array[2];
            }
            $valida = 1;
        }
        if (empty($id_f)) {
            $valida = 0;
        }

        if ($valida == 1) {
            $query = mysqli_query($conn, "INSERT INTO `vendas`(`id_clientes`, `id_produtos`, `id_matricula`, `data`, `valor`, `unid`,`dt_compra`) VALUES ('$id','$id_p','$id_f','$data','$valor','$unid','$dt_venda')") or die(mysqli_error($conn)); 
        } else {
            $contar = $contar + 1;
            if($contar == 1){echo "<h6>Não existe informação para gerar vendas (Falta informação do Clientes, Produtos ou Funcionário)</6>";}
        }
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

    function gravacode($id, $data, $code)
    {
        require("./conectar.php");
        $query = mysqli_query($conn, "INSERT INTO `recuperar`(`id`, `code`, `dt`, `valido`) VALUES ('$id','$code','$data','1')") or die(mysqli_error($conn));
    }

    function EnviarMail($mensagem, $email)
    {
        require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require 'vendor/phpmailer/phpmailer/src/SMTP.php';
        require 'vendor/phpmailer/phpmailer/src/Exception.php';
        require 'vendor/autoload.php';
        $mail = new PHPMailer(true);
        try {

            // Configurações do servidor
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();        //Devine o uso de SMTP no envio
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true; //Habilita a autenticação SMTP
            $mail->Username   = 'leandro.b.souza@df.estudante.senai.br';
            $mail->Password   = '';
            // Criptografia do envio SSL também é aceito
            $mail->SMTPSecure = 'SSL';
            // Define o remetente
            $mail->setFrom('leandro.b.souza@df.estudante.senai.br');
            // Define o destinatário
            $mail->addAddress($email);
            // Conteúdo da mensagem
            $links = "http://localhost/site/recuperarsenha.php";
            $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
            $mail->Subject = 'recuperar conta';
            $mail->Body    = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body> <h1>Código de recuperação<h1>' . ' Code: ' . $mensagem . '   Link: ' . $links . '</body></html>';
            $mail->AltBody = 'Código: ' . $mensagem . 'Link: ' . $links;
            // Enviar
            $mail->send();
            echo "<script>alert('A mensagem foi enviada para {$email}.')</script>";
            //header("Location:index.php");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        echo "<script>alert('Código enviado para seu email')</script>";
        header("Location:index.php");
    }
    function alterar_senha($senha, $code, $confirme)
    {

        if ($senha <> $confirme) {
            echo "<script>alert('A Senha não confere!Favor digite novamente.')</script>";
        } else {
            $data = Date('d-m-Y');
            require("./conectar.php");
            $query = mysqli_query($conn, "SELECT * FROM `recuperar` WHERE code='$code' and dt='$data' and valido ='1'")  or die(mysqli_error($conn));;
            if (mysqli_num_rows($query)) {
                while ($array = mysqli_fetch_row($query)) {
                    $id = $array[0];
                }
                $cript = base64_encode($senha);
                $query = mysqli_query($conn, "UPDATE `usuarios` SET `senha`='$cript' WHERE id='$id'");
                $query = mysqli_query($conn, "UPDATE `recuperar` SET `valido`='0'");
                echo "<script>alert('Senha atualizada com sucesso!')</script>";
                header("Location:index.php");
            } else {
                echo "<script>alert('Código não existe ou já expirou!')</script>";
            }
        }
    }


    //////////////////////////////////Relatórios//////////////////////////////////////////////////////////
    function produtos()
    {
        require("./conectar.php");
        $color = "#ffffff";
        $query = mysqli_query($conn, "SELECT * FROM produtos WHERE 1")  or die(mysqli_error($conn));;
        if (mysqli_num_rows($query)) {
            $estilos[0] = "background-color: #BDBDBD;font-size:14px;color:black;font-style:bold;font-family:Arial;
            text-align: center; width: 15%;";

            echo "<table style=\"width:auto\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
              <td style=\"$estilos[0]\">ID</td>
              <td style=\"$estilos[0]\">PRODUTO</td>
              <td style=\"$estilos[0]\">VALOR</td>
              <td style=\"$estilos[0]\">QUANT</td>
              <td style=\"$estilos[0]\">ATUALIZAÇÃO</td>
              <td style=\"$estilos[0]\">MARCA</td>
              <td style=\"$estilos[0]\">MODELO</td>
              <td style=\"$estilos[0]\">TIPO</td>
               </tr>";

            while ($array = mysqli_fetch_row($query)) {
                $estilos[1] = "background-color:{$color};font-size:14px;color:black;
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
    function visiualzar_Clientes()
    {
        require("./conectar.php");
        $color = "#ffffff";
        $query = mysqli_query($conn, "SELECT * FROM clientes WHERE 1")  or die(mysqli_error($conn));;
        if (mysqli_num_rows($query)) {
            $estilos[0] = "background-color: #BDBDBD;font-size:12px;color:black;font-style:bold;font-family:Arial;
        text-align: center; width: 15%;";

            echo "<table style=\"width: Auto\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
          <td style=\"$estilos[0]\">ID</td>
          <td style=\"$estilos[0]\">NOME</td>
          <td style=\"$estilos[0]\">SOBRENOME</td>
          <td style=\"$estilos[0]\">ENDEREÇO</td>
          <td style=\"$estilos[0]\">LOTE</td>
          <td style=\"$estilos[0]\">ESTADO</td>
          <td style=\"$estilos[0]\">CIDADE</td>
          <td style=\"$estilos[0]\">CEP</td>
          <td style=\"$estilos[0]\">TEL</td>
          <td style=\"$estilos[0]\">CEL</td>
          <td style=\"$estilos[0]\">EMAIL</td>
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
          <td style=\"$estilos[1]\">$array[14]</td>
          <td style=\"$estilos[1]\">$array[4]</td>
          <td style=\"$estilos[1]\">$array[5]</td>
          <td style=\"$estilos[1]\">$array[6]</td>
          <td style=\"$estilos[1]\">$array[7]</td>
          <td style=\"$estilos[1]\">$array[8]</td>
          <td style=\"$estilos[1]\">$array[10]</td>
           </tr>";
            }
        }
    }
    function clientes_excel()
    {
        require("./conectar.php");
        $color = "";
        $cor = "";
        $nome = $_SESSION['impressão'];
        $pes = $_SESSION['op'];
        $count = 1;
        $number = 0;
        $n = 0;
        ////todos os usuários
        if ($pes == "Todos") {
            $query = mysqli_query($conn, "SELECT * FROM clientes WHERE 1")  or die(mysqli_error($conn));;
            if (mysqli_num_rows($query)) {
                $estilos[0] = "background-color: #BDBDBD;font-size:12px;color:black;font-style:bold;font-family:Arial;
            text-align: center; width: auto%;";

                echo "<table style=\"width: Auto\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
              <td style=\"$estilos[0]\">ID</td>
              <td style=\"$estilos[0]\">NOME</td>
              <td style=\"$estilos[0]\">SOBRENOME</td>
              <td style=\"$estilos[0]\">ENDEREÇO</td>
              <td style=\"$estilos[0]\">LOTE</td>
              <td style=\"$estilos[0]\">ESTADO</td>
              <td style=\"$estilos[0]\">CIDADE</td>
              <td style=\"$estilos[0]\">CEP</td>
              <td style=\"$estilos[0]\">TEL</td>
              <td style=\"$estilos[0]\">CEL</td>
              <td style=\"$estilos[0]\">EMAIL</td>
             
              
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
              <td style=\"$estilos[1]\">$array[14]</td>
              <td style=\"$estilos[1]\">$array[4]</td>
              <td style=\"$estilos[1]\">$array[5]</td>
              <td style=\"$estilos[1]\">$array[6]</td>
              <td style=\"$estilos[1]\">$array[7]</td>
              <td style=\"$estilos[1]\">$array[8]</td>
              <td style=\"$estilos[1]\">$array[10]</td>
               </tr>";
                }
            }
        }
        ///unico usuário
        if ($pes == "Individual") {
            $query = mysqli_query($conn, "SELECT * FROM clientes WHERE nome='$nome'")  or die(mysqli_error($conn));;
            if (mysqli_num_rows($query)) {
                $estilos[0] = "background-color: #BDBDBD;font-size:12px;color:black;font-style:bold;font-family:Arial;
            text-align: center; width: auto%;";

                echo "<table style=\"width: Auto\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
              <td style=\"$estilos[0]\">ID</td>
              <td style=\"$estilos[0]\">NOME</td>
              <td style=\"$estilos[0]\">SOBRENOME</td>
              <td style=\"$estilos[0]\">ENDEREÇO</td>
              <td style=\"$estilos[0]\">LOTE</td>
              <td style=\"$estilos[0]\">ESTADO</td>
              <td style=\"$estilos[0]\">CIDADE</td>
              <td style=\"$estilos[0]\">CEP</td>
              <td style=\"$estilos[0]\">TEL</td>
              <td style=\"$estilos[0]\">CEL</td>
              <td style=\"$estilos[0]\">EMAIL</td>
             
              
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
              <td style=\"$estilos[1]\">$array[14]</td>
              <td style=\"$estilos[1]\">$array[4]</td>
              <td style=\"$estilos[1]\">$array[5]</td>
              <td style=\"$estilos[1]\">$array[6]</td>
              <td style=\"$estilos[1]\">$array[7]</td>
              <td style=\"$estilos[1]\">$array[8]</td>
              <td style=\"$estilos[1]\">$array[10]</td>
               </tr>";
                }
            }
        }
    }
}
