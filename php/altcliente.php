<?php
session_start();
include_once('conexao.php');

$pdo = conectar();
$cod_usuario = $_GET['cod'];
$sql = "SELECT * FROM tb_usuarios WHERE cod_usuario = :cod_usuario ";

$stmc = $pdo->prepare($sql);
$stmc->bindParam(':cod_usuario', $cod_usuario);
$stmc->execute();
$re = $stmc->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Alterar Usuários</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
    <h2>Alteração de Usuários</h2>  
    <form method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome_editado" value="<?php echo isset($re) ? $re->nome_usuario : ''; ?>">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="text" name="email_editado" value="<?php echo isset($re) ? $re->email_usuario : ''; ?>">
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone_editado" value="<?php echo isset($re) ? $re->telefone_usuario : ''; ?>">
        </div>
        <div class="form-group">
            <label>CPF:</label>
            <input type="text" name="cpf_editado" value="<?php echo isset($re) ? $re->cpf_usuario : ''; ?>">
        </div>
        <div class="form-group">
            <label>Senha:</label>
            <input type="text" name="senha_editado" value="<?php echo isset($re) ? $re->senha_usuario : ''; ?>">
        </div>
        <div class="form-group">
            <label>Tipo cadastro:</label>
            <input type="text" name="tipo_editado" value="<?php echo isset($re) ? $re->tipo_cadastro : ''; ?>">
        </div>
        <div class="form-group">
            <label>Ativo:</label>
            <input type="text" name="ativo_editado" value="<?php echo isset($re) ? $re->ativo : ''; ?>">
        </div>
        <button type="submit" class="btn btn-success" name="btnAlterar">Alterar</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <?php
    if(isset($_POST['btnAlterar'])){
        $nome_usuario = $_POST['nome_editado'];
        $email_usuario = $_POST['email_editado'];
        $telefone_usuario = $_POST['telefone_editado'];
        $cpf_usuario = $_POST['cpf_editado'];
        $senha_usuario = $_POST['senha_editado'];
        $tipo_cadastro = $_POST['tipo_editado'];
        $ativo = $_POST['ativo_editado'];

        if(empty($nome_usuario) || empty($email_usuario) || empty($telefone_usuario) || empty($cpf_usuario) || empty($senha_usuario) || empty($tipo_cadastro) || empty($ativo)){
            echo "Necessário informar todos os campos obrigatórios";
            exit();
        }

        $sqlup = "UPDATE tb_usuarios SET nome_usuario = :nome_usuario, email_usuario = :email_usuario, telefone_usuario = :telefone_usuario, cpf_usuario = :cpf_usuario, senha_usuario = :senha_usuario, tipo_cadastro = :tipo_cadastro, ativo = :ativo WHERE cod_usuario = :cod_usuario";
        $stmup = $pdo->prepare($sqlup);

        $stmup->bindParam(':nome_usuario', $nome_usuario);
        $stmup->bindParam(':email_usuario', $email_usuario);
        $stmup->bindParam(':telefone_usuario', $telefone_usuario);
        $stmup->bindParam(':cpf_usuario', $cpf_usuario);
        $stmup->bindParam(':senha_usuario', $senha_usuario);
        $stmup->bindParam(':tipo_cadastro', $tipo_cadastro);
        $stmup->bindParam(':ativo', $ativo);
        $stmup->bindParam(':cod_usuario', $cod_usuario);

        if($stmup->execute()){
            echo "Alterado com sucesso";
            header("Location: listagemcliente.php");
        } else {
            echo "Erro ao alterar";
        }
    }
    ?>
</body>
</html>
