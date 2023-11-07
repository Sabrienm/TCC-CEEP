<?php
session_start();
include_once("conexao.php");

$pdo = conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<section>
    <form method="post" enctype="multipart/form-data">
        <h2>Cadastre um produto:</h2>
        <label>Nome do produto:</label>
        <input type="text" name="nome_produto" class="form-control" placeholder="Digite o produto" required>
        <label>Preço do produto:</label>
        <input type="number" name="preco" class="form-control" placeholder="Digite o preço" required>
        <label>Estoque do produto:</label>
        <input type="number" name="estoque" class="form-control" placeholder="Digite o estoque" required>
        <label>Descrição do produto:</label>
        <input type="text" name="descricao" class="form-control" placeholder="Digite a descrição" required>
        <label>Tamanho do produto:</label>
        <input type="text" name="tamanho" class="form-control" placeholder="Digite o tamanho" required>
        <label>Cor do produto:</label>
        <input type="text" name="cor" class="form-control" placeholder="Digite a cor" required>
        <label>Escolha a categoria:</label>
        <select name="fk_cod_categoria" required class="form-control">
            <option value="" disabled selected>Selecione a categoria</option>
            <?php
            $sql_categoria = "SELECT cod_categoria, nome_categoria FROM tb_categorias";
            $stmt_categoria = $pdo->prepare($sql_categoria);
            $stmt_categoria->execute();

            while ($row = $stmt_categoria->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['cod_categoria'] . "'>" . $row['nome_categoria'] . "</option>";
            }
            ?>
        </select>
        <button type="submit" name="btnSalvar" class="btn btn-primary">Cadastrar Produto</button>
    </form>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_produto = $_POST['nome_produto'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    $descricao = $_POST['descricao'];
    $tamanho = $_POST['tamanho'];
    $cor = $_POST['cor'];
    $fk_cod_categoria = $_POST['fk_cod_categoria'];

    $query = "INSERT INTO tb_produtos (nome_produto, preco, estoque, descricao, tamanho, cor, fk_cod_categoria) 
          VALUES ('$nome_produto', '$preco', '$estoque', '$descricao', '$tamanho', '$cor', '$fk_cod_categoria')";
    $resultado = $pdo->query($query);

    if ($resultado) {
        header("Location:listagemproduto.php");
    } else {
        echo "Erro ao cadastrar";
    }
}
?>
