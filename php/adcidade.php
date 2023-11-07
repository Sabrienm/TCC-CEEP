<?php
session_start();
include_once("conexao.php");

$pdo = conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Cidades</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<section>
    <form method="post" enctype="multipart/form-data">
        <h2>Cadastre o endereço:</h2>
        <label>Nome da cidade:</label>
        <input type="text" name="nome_cidade" class="form-control" placeholder="Digite a cidade" required>
        <label>Estado:</label>
        <input type="text" name="estado" class="form-control" placeholder="Digite o estado" required>
        <button type="submit" name="btnSalvar" class="btn btn-primary">Cadastrar cidade</button>
    </form>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['btnSalvar'])) {
    $nome_cidade = $_POST['nome_cidade'];
    $estado = $_POST['estado'];
    if (empty($nome_cidade) || empty($estado)) {
        echo "Necessário preencher os campos";
        exit();
    }

    $sql = "INSERT INTO tb_cidades (nome_cidade, estado) VALUES (:nome_cidade, :estado)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome_cidade', $nome_cidade);
    $stmt->bindParam(':estado', $estado);
    
    if ($stmt->execute()) {
        echo "Cidade inserida com sucesso!";
    } else {
        echo "Erro ao inserir cidade";
    }
}
?>
