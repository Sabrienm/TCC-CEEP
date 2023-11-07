<?php
session_start();
include_once('conexao.php');

$pdo = conectar();

if(isset($_POST["entre"])) {
    $email_usuario = $_POST['email_usuario'];
    $senha_usuario = $_POST['senha_usuario'];

    $senha_md5 = md5($senha_usuario);

    $sql = "SELECT * FROM tb_usuarios WHERE email_usuario = :email_usuario AND senha_usuario = :senha_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email_usuario', $email_usuario);
    $stmt->bindParam(':senha_usuario', $senha_md5);

    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
if ($usuario) {
    $_SESSION['cod_usuario'] = $usuario['cod_usuario'];
    $_SESSION['email_usuario'] = $usuario['email_usuario'];
}
    if ($usuario && $usuario['tipo_cadastro'] === 'A') {
        header("Location: indexadm.php");
        exit();
    } else if ($usuario) {
        header("Location: index.php");
        exit();
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/logincss.css">
    <style>
        
        body {
    margin: 0;
    padding: 0;
    font-family: 'Barlow', sans-serif;
    display: flex;
    flex-direction: column;
    height: 100%;
  }
  
  .boas-vindas {
    background: rgb(255,71,71);
    background: linear-gradient(0deg, rgba(255,71,71,1) 0%, rgba(255,116,87,1) 31%, rgba(255,219,112,1) 96%);
    padding: 40px;
    text-align: center;
    padding-top:20%;
    color: #fff;
    height: 707px;
    width: 40%;
    
  }
  
  .form-section {
    background-color: #ffffff;
    padding: 0px;
    margin-left: 60%;
    margin-top: -520px;
    outline: none;
    font-weight: bold;


  }
  
  .form-section h2 {
    margin-left:105px;
    font-weight: bold;
    outline: none;

  }
  
  .form-group {
    margin-bottom: 15px;
    outline: none;

  }
  
  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    outline: none;

  }
  
  input[type="text"],
  input[type="password"],
  input[type="email"] {
    width: 50%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    align-items: center;
    outline: none;

  }
  
  button {
    padding: 10px 20px;
    background-color: #fed14a;
    color: #000000;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left:110px;
    font-weight: bold;
  }
  
  button:hover {
    background-color: #ff7457;
  }

  nav ul {
    list-style: none;
    background-color: #ffffff;
    font-size: 20px;
    font-family: 'Barlow', sans-serif;
    display: flex;
    text-align:center;
    margin-left:-10px;
    margin-top:20px;
}

nav li {
    cursor: pointer;
}

nav a {
    color: #000000;
    text-decoration: none;
}

nav a:hover {
    color: #000000;
}

#senha{
    width:310px;
    height:45px;
    border-radius: 07px;
    border-color: #ccc;
    border-width:1px;
}

    </style>
</head>

<body>
    <div class="boas-vindas">
        <h1>BEM-VINDO A NOSSA LOJA!</h1>
        <h3>Cadastre-se e boas compras.</h3>
    </div>
    <div class="form-section">
        <h2>LOGIN</h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">E-MAIL:</label>
                <input type="email" id="email_usuario" name="email_usuario" required>
            </div>
            <div class="form-group">
                <label for="senha">SENHA:</label>
                <input type="password" id="senha_usuario" name="senha_usuario" required>
            </div>
            <div class="form-group">
                <nav>
                    <ul>
                        <li><a href="cadastro.php">Não tem conta? Faça já a sua!</a></li>
                    </ul>
                </nav>
                <button type="submit" name="entre" id="btnentrar">ENTRE</button>
            </div>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($usuario) && !$usuario) 
        {
            echo "<p>Credenciais inválidas. Por favor, verifique as informações.</p>";
        }
        ?>
    </div>
</body>

</html>
