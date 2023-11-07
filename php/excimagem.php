<?php
    include_once('conexao.php');
    $pdo = conectar();
    $cod_imagem = $_GET['cod_imagem'];

    $sqlc = "SELECT * FROM tb_imagens WHERE cod_imagem = :cod_imagem";
    $stmc = $pdo->prepare($sqlc);
    $stmc->bindParam(':cod_imagem', $cod_imagem);
    $stmc->execute();

    if ($stmc->rowCount() > 0) 
        {
            $sqlex = "DELETE FROM tb_imagens WHERE cod_imagem = :cod_imagem";
            $stmex = $pdo->prepare($sqlex);
            $stmex->bindParam(':cod_imagem', $cod_imagem);
            if ($stmex->execute()) 
                {
                    echo "Imagem excluída com sucesso!";
                } 
            else 
                {
                    echo "Erro ao excluir imagem!";
                }
        } 
    else 
        {
        echo "Imagem não encontrada!";
    }

header('Location: listagemimagem.php');

?>