<?php
session_start();
include_once('conexao.php');

$pdo = conectar();

$sql = "SELECT * FROM tb_produtos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT imagem FROM tb_imagens WHERE cod_imagem = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['pesquisa']) && !empty($_GET['pesquisa'])) {
        $pesquisa = $_GET['pesquisa'] . "%";
        $sql = "SELECT * FROM tb_produtos WHERE nome_produto LIKE :pesquisa";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':pesquisa', $pesquisa, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultado) > 0) {
            echo "<h3>Resultado da pesquisa</h3>";

            foreach ($resultado as $r) {
                echo "<p>" . $r['nome_produto'] . "</p>";
            }
        } else {
            echo "<h3>Nenhum resultado encontrado</h3>";
        }
    }
    if ($resultado && file_exists($resultado['imagem'])) 
      {
        $imagem = $resultado['imagem'];
      } 
    else 
      {
        $caminho_imagem = 'caminho_para_uma_imagem_padrao.jpg'; 
      }
}
?>

<!DOCTYPE html>
    <html lang="pt-BR">
    
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sakura</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@100&family=Barlow:wght@200&family=Roboto:ital,wght@1,500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/csshome.css">
</head>
<style>
  
body 
{
  font-family: 'Barlow', sans-serif;
  font-weight: bold;
  margin: 0;
  padding: 0;
}

header 
{
  background-color: #FFDB70;
  color: #fff;
  width: 100%;
  display: flex;
}

nav ul 
{
    list-style: none;
    font-size: 15px;
    font-family: 'Barlow', sans-serif;
    display: flex;
    margin-top:115px;
    margin-left:-670px;
}

nav li 
{
    margin-left: 30px;
    cursor: pointer;
}

nav a 
{
    color: #fa3c4c;
    text-decoration: none;
}

nav a:hover 
{
    color: #000000;
}

.slider-container 
{
  width: 405;
  max-width: 1100px;
  margin: 0 auto;
  overflow: hidden;
  position: relative;
  margin-top: 40px;
}

.slider 
{
  display: flex;
  transition: transform 0.7s ease-in-out;
}

.slide 
{
  flex: 0 0 100%;
  min-width: 100%;
  min-height:102%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.slide img 
{
  max-width: 100%;
  max-height: 102%;
  border-radius: 40px;
}
    
.slider-controls 
{
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  display: flex;
  width: 100%;
  justify-content: space-between;
}

.slider-controls button 
{
  background-color: #FFDB70;
  color: white;
  border: 0px;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  cursor: pointer;
  margin-top: -%;
  outline:none;
}

.slider-controls .prev 
{
  margin-left: 30px;
}

.slider-controls .next 
{
  margin-right: 30px;
}
.search-container 
{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
}

.search-box 
{
    border: 2px solid #ffffff;
    border-radius: 40px;
    height: 45px;
    font-size: 15px;
    padding-left: 20px;
    font-family: 'Barlow', sans-serif;
    width:600px;
    margin-left:70px;
    margin-top:-05px;
    outline: none;
}

.resultado 
{
    background-color: #FFDB70;
    color: #fff;
    border: none;
    margin-left: 10px;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .2s;
    margin-top:0px;
}

.conta-botao 
{
    background-color: #FFDB70;
    color: #fff;
    border: none;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .2s;
    margin-top:55px;
    margin-left:80px;
    outline: none;
}

.carrinho-botao 
{
    background-color: #FFDB70;
    color: #fff;
    border: none;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .2s;
    margin-left:130px;
    margin-top:-30px;
    outline: none;        
}

.icons
{
  margin-left:80px;
}

#logo 
{
    height: 125px;
    width: 200px;
    border-radius: 30px;
    padding: 0px;
    margin-top: 15px;
    margin-left:190px;
}

#frase1
{
  margin-left:551px;
  margin-top:-25px;
}

#frase2
{
  margin-left:-90px;
}

.col-sm
{
  margin-top:5%;
  align-content: center;
  margin-left: 9%;
}

.button-comprar {
  background-color: ##fa3c4c;
  color: #fff;
  border: none;
  font-size: 25px;
  cursor: pointer;
  border-radius: 20px; 
  margin-left: 25%;
  padding: 5px 18px;
  outline: none;
  font-weight: bold;

}

.product-container .row {
  margin-left: 5%;
}

.perfil{
  color:#fa3c4c;
  margin-left: 4%;
  margin-top:4%;
}
.logoff{
  color:#fa3c4c;
  margin-top: 5.5%;
  margin-left: -4.7%;
}

</style>

<body>
    <header>
        
    <img src="imagens/sakura logo.png" id="logo">
        <div class="search-container">
            <input type="text" class="search-box" name="pesquisa" placeholder="Buscar na Sakura...">
            <button class="resultado"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg></button></div>
            <div id="categorias">
            <nav>
                <ul>
                    <li><a href="#">MOLETONS</a></li>
                    <li><a href="#">QUADROS</a></li>
                    <li><a href="#">PINS</a></li>
                    <li><a href="#">CANECAS</a></li>
                    <li><a href="#">OUTROS</a></li>
                    <li><a href="#">CONTATO</a></li>
                </ul>
            </nav>
</div>
              <?php if (isset($_SESSION['cod_usuario'])) { ?>
                <a class ="perfil" href="perfil.php?id=<?php echo $_SESSION['cod_usuario']; ?>">MEU PERFIL</a>
                  <a class="logoff" href="#" onclick="confirmarSaida()">SAIR</a>
              <?php } else { ?>
                  <a href="login.php">Entre ou cadastre-se</a>
              <?php } ?>
              </svg>
    </header>
    <script>
      function confirmarSaida() {
        var confirmacao = confirm("Tem certeza de que deseja sair?");
        if (confirmacao) {
            window.location.href = "logoff.php";
        }
      }
        </script>
     </script>
    <body>
            <ol>
            <li><a href="listagemproduto.php">Produtos</a></li>
            <li><a href="listagemcategoria.php">Categorias</a></li>
            <li><a href="listagemcliente.php">Clientes</a></li>
            <li><a href="listagemimagem.php">Imagens</a></li>
            <li><a href="listagemcidade.php">Cidades</a></li>

            </ol>
</body>