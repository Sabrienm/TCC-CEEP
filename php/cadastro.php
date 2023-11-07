<?php
session_start();
include_once('conexao.php');
$pdo = conectar();

function removeSpecialChars($str) {
    $cleanedStr = preg_replace('/[^0-9]/', '', $str);
    return $cleanedStr;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $senha =   md5($_POST['senha']);

        $query = "INSERT INTO tb_usuarios (nome_usuario, email_usuario, cpf_usuario, telefone_usuario, senha_usuario) VALUES ('$nome', '$email', '$cpf', '$telefone', '$senha')";
        $resultado = $pdo->query($query);

        if ($resultado) 
            {
                header("Location:login.php");
                exit();
            } 
        else 
            {
                echo "Erro ao cadastrar";
            }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sakura</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@100&family=Barlow:wght@200&family=Roboto:ital,wght@1,500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.3/jquery.inputmask.min.js"></script>
    </script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/mask.js"></script>
    <link rel="stylesheet" href="css/cssadms.css"></script>

</head>
    <style>

         body 
            {
                margin: 0;
                padding: 0;
                font-family: 'Barlow', sans-serif;
                display: flex;
                flex-direction: column;
                height: 100%;
            }
  
        .boas-vindas 
            {
                background: rgb(255,71,71);
                background: linear-gradient(0deg, rgba(255,71,71,1) 0%, rgba(255,116,87,1) 31%, rgba(255,219,112,1) 96%);
                padding: 40px;
                text-align: center;
                padding-top:20%;
                color: #fff;
                height: 707px;
                width: 40%;
            }
  
        .form-section 
            {
                background-color: #ffffff;
                padding: 0px;
                margin-left: 60%;
                margin-top: -660px;
                outline: none;
                font-weight: bold;


            }
  
         .form-section h2 
            {
                margin-left: -15px;
                margin-bottom:20px;
                outline: none;
                font-weight: bold;

             }
  
        .form-group 
            {
                margin-bottom: 20px;
                outline: none;
                font-weight: bold;
            }
  
        label 
            {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
                outline: none;
                font-weight: bold;

            }
  
            input[type="text"],
            input[type="password"],
            input[type="email"] 
                {
                    width: 50%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    align-items: center;
                    outline: none;
                    font-weight: bold;

                }
  
         button 
                {
                    padding: 10px 20px;
                    background-color: #fed14a;
                    color: #000000;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    margin-left:90px;
                    font-weight: bold;
                }
  
        button:hover 
                {
                    background-color: #ff7457;
                }

        nav ul 
            {
                list-style: none;
                background-color: #ffffff;
                font-size: 20px;
                font-family: 'Barlow', sans-serif;
                display: flex;
                text-align:center;
                margin-left:-20px;
                font-weight: bold;
            }

        nav li 
            {
                cursor: pointer;
            }

        nav a 
            {
                color: #000000;
                text-decoration: none;
            }

        nav a:hover 
            {
                color: #000000;
            }
    </style>
</head>
<body>
    <div class="boas-vindas">
        <h1>BEM-VINDO A NOSSA LOJA!</h1>
        <h3>Cadastre-se e boas compras.</h3>
    </div>
    <div class="form-section">
        <h2>CADASTRO DE CLIENTE</h2>
        <form method="POST" action="cadastro.php">
        <div class="form-group">
                <label for="nome">NOME COMPLETO:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="telefone">TELEFONE:</label>
                <input type="text" id="cel_cli" name="cel_cli" required class="sp_celphones">
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf"  class="cpf"  required>
            </div>
            <div class="form-group">
                <label for="email">E-MAIL:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">SENHA:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="form-group">
            <nav>
                <ul>
                    <li><a href="login.php">Já tem uma conta? Faça login!</a></li>
                </ul>
            </nav>
                <button type="submit" name="cadastro">CADASTRAR</button>
            </div>
        </form>
    </div>

    <script>
        function removeSpecialChars(inputId) {
            var inputElement = document.getElementById(inputId);
            inputElement.value = inputElement.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
        }
    </script>

</body>

</html>
       
