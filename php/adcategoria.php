<?php
session_start();
include_once("conexao.php");

$pdo = conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Categoria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<section>
    <form method="post" enctype="multipart/form-data">
        <h2>Cadastre uma categoria:</h2>
        <label>Nome da categoria:</label>
        <input type="text" name="nome_categoria" class="form-control" placeholder="Digite a categoria" required>
        <button type="submit" name="btnSalvar" class="btn btn-primary">Cadastrar Categoria</button>
    </form>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</body>
</html>

<?php
if(isset($_POST['btnSalvar'])){
    $nome_categoria = $_POST['nome_categoria'];
    if(empty($nome_categoria)){
        echo "Necessário informar a categoria";
        exit();
    }

    $sql = "INSERT INTO tb_categorias (nome_categoria) VALUES (:nome_categoria)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome_categoria', $nome_categoria);
    if($stmt->execute()){
        echo "Categoria inserida com sucesso!";
    } else {
        echo "Erro ao inserir categoria";
    }
}
?>
