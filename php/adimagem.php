<?php
session_start();
include_once("conexao.php");

$pdo = conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Imagem</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<section>
    
    <form method="post" enctype="multipart/form-data">
        <h2>Selecione uma imagem:</h2>
        <label class="text_foto" for="foto">Escolha uma foto:</label>
        <input type="file" name="foto" accept="image/*">

        <label>Escolha o produto:</label>
        <select name="fk_cod_produto" required class="form-control">
            <option value="" disabled selected>Selecione o produto</option>
            <?php
            $sql_produto = "SELECT cod_produto, nome_produto FROM tb_produtos";
            $stmt_produto = $pdo->prepare($sql_produto);
            $stmt_produto->execute();

            while ($row = $stmt_produto->fetch(PDO::FETCH_ASSOC)) 
            {
                echo "<option value='" . $row['cod_produto'] . "'>" . $row['nome_produto'] . "</option>";
            }

            ?>
        </select>
        <button type="submit" name="btnSalvar" class="btn btn-primary">Cadastrar Imagem</button>
    </form>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</body>
</html>

<?php
if(isset($_POST['btnSalvar']))
    {
        $fk_cod_produto = $_POST['fk_cod_produto'];
        
        $foto = $_FILES['foto']['name'];
        $caminhoFoto = 'C:\xampp\htdocs\projeto\img\\' . $foto;

        if(move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoFoto))
        {
            $sql = "INSERT INTO tb_imagens (imagem, fk_cod_produto) VALUES (:imagem, :fk_cod_produto)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':imagem', $foto);
            $stmt->bindParam(':fk_cod_produto', $fk_cod_produto);
            
            if($stmt->execute())
            {
                echo "Imagem inserida com sucesso!";
            } 
            else 
            {
                echo "Erro ao inserir imagem";
            }
        } 
        else 
        {
            echo "Erro ao fazer o upload da imagem";
        }
    }
?>
