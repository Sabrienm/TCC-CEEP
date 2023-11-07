<?php
include_once('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pesquisa = $_POST["pesquisa"];

    $pdo = conectar();

    $sql = "SELECT * FROM tb_produtos WHERE nome_produto LIKE :termo";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":termo", "%" . $pesquisa . "%");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultados da Pesquisa</title>
</head>
<body>
    <h2>Resultados da Pesquisa</h2>
    
    <div class="product-list">
        <div class="product-row">
            <?php
            if (!empty($produtos)) {
                foreach ($produtos as $produto) {
                    ?>
                    <div class="product">
                        <img src="<?php echo $produto['nome_produto']; ?>" alt="<?php echo $produto['nome_produto']; ?>">
                        <h3><?php echo $produto['preco']; ?></h3>
                        <a href="#">
                            <button id="acesso">COMPRAR</button>
                        </a>
                    </div>
                    <?php
                }
            } else {
                echo "Nenhum resultado encontrado.";
            }
            ?>
        </div>
    </div>
</body>
</html>
