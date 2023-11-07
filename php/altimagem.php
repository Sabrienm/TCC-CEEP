<?php
session_start();
include_once('conexao.php');

$pdo = conectar();
$cod_imagem = $_GET['cod_imagem'];
$sql = "SELECT * FROM tb_imagens WHERE cod_imagem = :cod_imagem ";

$stmc = $pdo->prepare($sql);
$stmc->bindParam(':cod_imagem', $cod_imagem);
$stmc->execute();
$re = $stmc->fetch(PDO::FETCH_OBJ);
?>
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
    <title>Alterar Imagens</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <h2>Alteração de Imagens</h2>
    <form method="POST">
        <div class="form-group">
            <label>Imagem:</label>
            <input type="file" name="imagem" value="<?php echo $re->imagem; ?>">
        </div>
        <div class="form-group">
        <label>Escolha o produto:</label>
        <select name="fk_cod_produto" required class="form-control">
            <option value="" disabled selected>Selecione o produto</option>
            <?php
            $sql_produto = "SELECT cod_produto, nome_produto FROM tb_produtos";
            $stmt_produto = $pdo->prepare($sql_produto);
            $stmt_produto->execute();

            while ($row = $stmt_produto->fetch(PDO::FETCH_ASSOC)) 
                {
                    echo "<option value='" . $row['cod_produto'] . "'" . ($re->fk_cod_produto == $row['cod_produto'] ? ' selected' : '') . ">" . $row['nome_produto'] . "</option>";
                }
            ?>
        </select>
        </div>
        <button type="submit" class="btn btn-success" name="btnAlterar">Alterar</button>
    </form>
</body>
</html>

<?php
if(isset($_POST['btnAlterar'])){
    $imagem = $_POST['imagem'];
    $fk_cod_produto = $_POST['fk_cod_produto'];

    $foto = $_FILES['foto']['name'];
    $caminhoFoto = 'C:\xampp\htdocs\projeto\img\\' . $foto;

    if(empty($imagem)){
        echo "Necessário informar o campo obrigatório";
        exit();
    }

    $sqlup = "UPDATE tb_imagens SET imagem = :imagem, fk_cod_produto = :fk_cod_produto WHERE cod_imagem = :cod_imagem";
    $stmup = $pdo->prepare($sqlup);

    $stmup->bindParam(':imagem', $imagem);  
    $stmup->bindParam(':cod_imagem', $cod_imagem);
    $stmup->bindParam(':fk_cod_produto', $fk_cod_produto);

    if($stmup->execute()){
        echo "Alterado com sucesso";
        header("Location: listagemimagem.php");
    } else {
        echo "Erro ao alterar";
    }
}
?>

