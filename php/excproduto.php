<?php
include_once('conexao.php');
$pdo = conectar();
$cod = $_GET['cod'];

$sqlc = "SELECT * FROM tb_produtos WHERE cod_produto = :cod";
$stmc = $pdo->prepare($sqlc);
$stmc->bindParam(':cod', $cod);
$stmc->execute();

if ($stmc->rowCount() > 0) {
    $sqlex = "DELETE FROM tb_produtos WHERE cod_produto = :cod";
    $stmex = $pdo->prepare($sqlex);
    $stmex->bindParam(':cod', $cod);
    if ($stmex->execute()) {
        echo "Categoria excluída com sucesso!";
    } else {
        echo "Erro ao excluir produto!";
    }
} else {
    echo "Produto não encontrado!";
}
header('Location: listagemproduto.php');
?>