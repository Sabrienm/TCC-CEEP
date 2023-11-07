<?php
    session_start();
    include_once('conexao.php');

    $pdo = conectar();
    $cod_produto = $_GET['cod'];
    $sql = "SELECT * FROM tb_produtos WHERE cod_produto = :cod_produto ";

    $stmc = $pdo->prepare($sql);
    $stmc->bindParam(':cod_produto', $cod_produto);
    $stmc->execute();
    $re = $stmc->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Alterar Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
    <h2>Alteração de Produtos</h2>  
    <form method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome_editado" value="<?php echo isset($re) ? $re->nome_produto : ''; ?>">
        </div>
        <div class="form-group">
            <label>Preço:</label>
            <input type="text" name="preco_editado" value="<?php echo isset($re) ? $re->preco : ''; ?>">
        </div>
        <div class="form-group">
            <label>Estoque:</label>
            <input type="text" name="estoque_editado" value="<?php echo isset($re) ? $re->estoque : ''; ?>">
        </div>
        <div class="form-group">
            <label>Descrição:</label>
            <input type="text" name="descricao_editado" value="<?php echo isset($re) ? $re->descricao : ''; ?>">
        </div>
        <div class="form-group">
            <label>Tamanho:</label>
            <input type="text" name="tamanho_editado" value="<?php echo isset($re) ? $re->tamanho : ''; ?>">
        </div>
        <div class="form-group">
            <label>Cor:</label>
            <input type="text" name="cor_editado" value="<?php echo isset($re) ? $re->cor : ''; ?>">
        </div>
        <div class="form-group">
            <label>Ativo:</label>
            <input type="text" name="ativo_editado" value="<?php echo isset($re) ? $re->ativo : ''; ?>">
        </div>
        <div class="form-group">
        <label>Escolha a categoria:</label>
        <select name="fk_cod_categoria" required class="form-control">
            <option value="" disabled selected>Selecione a categoria</option>
            <?php
            $sql_categoria = "SELECT cod_categoria, nome_categoria FROM tb_categorias";
            $stmt_categoria = $pdo->prepare($sql_categoria);
            $stmt_categoria->execute();

            while ($row = $stmt_categoria->fetch(PDO::FETCH_ASSOC)) 
                {
                    echo "<option value='" . $row['cod_categoria'] . "'" . ($re->fk_cod_categoria == $row['cod_categoria'] ? ' selected' : '') . ">" . $row['nome_categoria'] . "</option>";
                }
            ?>
        </select>
        </div>
        <button type="submit" class="btn btn-success" name="btnAlterar">Alterar</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <?php
    if(isset($_POST['btnAlterar']))
        {
            $nome_produto = $_POST['nome_editado'];
            $preco = $_POST['preco_editado'];
            $estoque = $_POST['estoque_editado'];
            $descricao = $_POST['descricao_editado'];
            $tamanho = $_POST['tamanho_editado'];
            $cor = $_POST['cor_editado'];
            $ativo = $_POST['ativo_editado'];
            $fk_cod_categoria = $_POST['fk_cod_categoria'];

        if(empty($nome_produto) || empty($preco) || empty($estoque) || empty($descricao) || empty($tamanho) || empty($cor) || empty($ativo) || empty($fk_cod_categoria))
        {
            echo "Necessário informar todos os campos obrigatórios";
            exit();
        }

        $sqlup = "UPDATE tb_produtos SET nome_produto = :nome_produto, preco = :preco, estoque = :estoque, descricao = :descricao, tamanho = :tamanho, cor = :cor, ativo = :ativo, fk_cod_categoria = :fk_cod_categoria WHERE cod_produto = :cod_produto";
        $stmup = $pdo->prepare($sqlup);

        $stmup->bindParam(':nome_produto', $nome_produto);
        $stmup->bindParam(':preco', $preco);
        $stmup->bindParam(':estoque', $estoque);
        $stmup->bindParam(':descricao', $descricao);
        $stmup->bindParam(':tamanho', $tamanho);
        $stmup->bindParam(':cor', $cor);
        $stmup->bindParam(':ativo', $ativo);
        $stmup->bindParam(':fk_cod_categoria', $fk_cod_categoria);
        $stmup->bindParam(':cod_produto', $cod_produto);

        if($stmup->execute())
        {
            echo "Alterado com sucesso";
            header("Location: listagemproduto.php");
        } 
        else 
        {
            echo "Erro ao alterar";
        }
    }
    ?>
</body>
</html>
