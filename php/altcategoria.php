<?php
session_start();
include_once('conexao.php');

$pdo = conectar();

$cod_categoria = $_GET['cod'];

$sql = "SELECT * FROM tb_categorias WHERE cod_categoria = :cod_categoria ";

$stmc = $pdo->prepare($sql);
$stmc->bindParam(':cod_categoria', $cod_categoria);
$stmc->execute();

$re = $stmc->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Alterar Categorias</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <h2>Alteração de Categorias</h2>
    <form method="POST">
        <div class="form-group">
            <label>Nome da categoria:</label>
            <input type="text" name="categoria_editada" value="<?php echo $re->nome_categoria; ?>">
        </div>
        <button type="submit" class="btn btn-success" name="btnAlterar">Alterar</button>
    </form>
</body>
</html>

<?php
if(isset($_POST['btnAlterar'])){
    $nome_categoria = $_POST['categoria_editada'];

    if(empty($nome_categoria)){
        echo "Necessário informar o campo obrigatório";
        exit();
    }

    $sqlup = "UPDATE tb_categorias SET nome_categoria = :nome_categoria WHERE cod_categoria = :cod_categoria";
    $stmup = $pdo->prepare($sqlup);

    $stmup->bindParam(':nome_categoria', $nome_categoria);
    $stmup->bindParam(':cod_categoria', $cod_categoria);

    if($stmup->execute()){
        echo "Alterado com sucesso";
        header("Location: listagemcategoria.php");
    } else {
        echo "Erro ao alterar";
    }
}
?>
