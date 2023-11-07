<?php
    include_once('conexao.php');
    $pdo = conectar();
    $cod = $_GET['cod'];

    $sqlc = "SELECT * FROM tb_usuarios WHERE cod_usuario = :cod";
    $stmc = $pdo->prepare($sqlc);
    $stmc->bindParam(':cod', $cod);
    $stmc->execute();

    if ($stmc->rowCount() > 0) 
        {
            $sqlex = "DELETE FROM tb_usuarios WHERE cod_usuario = :cod";
            $stmex = $pdo->prepare($sqlex);
            $stmex->bindParam(':cod', $cod);
            if ($stmex->execute()) 
                {
                    echo "Usuário excluído com sucesso!";
                } 
            else 
                {
                    echo "Erro ao excluir usuário!";
                }
        } 
    else 
        {
            echo "Usuário não encontrado!";
        }

    header('Location: listagemcliente.php');

?>