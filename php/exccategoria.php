<?php
include_once('conexao.php');
$pdo = conectar();
$cod = $_GET['cod'];

// Verifique se existem produtos associados à categoria
$sql_check_products = "SELECT * FROM tb_produtos WHERE fk_cod_categoria = :cod";
$stmt_check_products = $pdo->prepare($sql_check_products);
$stmt_check_products->bindParam(':cod', $cod);
$stmt_check_products->execute();

if ($stmt_check_products->rowCount() > 0) {
    // Atualize ou lide com produtos associados à categoria
    // ...

    // Agora você pode prosseguir para excluir a categoria
}

$sql_delete_category = "DELETE FROM tb_categorias WHERE cod_categoria = :cod";
$stmt_delete_category = $pdo->prepare($sql_delete_category);
$stmt_delete_category->bindParam(':cod', $cod);

if ($stmt_delete_category->execute()) {
    echo "Categoria excluída com sucesso!";
} else {
    echo "Erro ao excluir categoria!";
}

header('Location: listagemcategoria.php');

?>