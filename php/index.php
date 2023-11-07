<?php

session_start();
include_once('conexao.php');

$pdo = conectar();

$sql = "SELECT I.imagem, P.nome_produto, P.preco 
        FROM tb_produtos AS P
        INNER JOIN tb_imagens AS I
        ON I.fk_cod_produto = P.cod_produto";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    margin-left:-620px;
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
  margin-top: -70%;
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
    margin-left:50px;
    margin-top:-05px;
    outline: none;
    font-weight: bold;
}

.resultado 
{
    background-color: #FFDB70;
    color: #fff;
    border: none;
    margin-left: 100%;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 50%;
    display: flex;
    transition: all .2s;
    margin-top:-5%;
}

.conta-botao 
{
    background-color: #FFDB70;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 50%;
    display: flex;
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

.frase1
{
  margin-left:60%;
  margin-top:4%;
}

.frase2
{
  margin-left:50%;
}

.col-sm
{
  margin-top:5%;
  align-content: center;
  margin-left: 9%;
}

.button-comprar {
  background-color: #ff5454;
  color: #fff;
  border: none;
  font-size: 20px;
  cursor: pointer;
  border-radius: 20px; 
  margin-left: 20%;
  padding: 5px 18px;
  outline: none;
  font-weight: bold;

}

.product-container .row {
  margin-left: 5%;
}

.imagens {
  margin-left: 8%;
  margin-top: 5%;
  border-radius: 5px;
}

.card-title{
  font-weight: bold;
  font-size:25px;
  align-items:center;
  justify-content: center;
}

.card-text{
  font-size:20px;
  margin-left:18%;
}

.card{
  margin-left:0%;
  width:300px;
  margin-top:20px;
  border-radius:10px;
  justify-content: space-between;
}

.frase4
{
  margin-left:40%;
  font-weight:bold;
  margin-top: 2%;
  color:#fa3c4c;
}

html, body {
  width: 100%;
}

.col-sm-4 {
        margin-bottom: 20px;
        margin-left:20px;
    }

.login{
  color:#fa3c4c;
  margin-left: 4%;
  margin-top:4%;
}
.cadastro{
  color:#fa3c4c;
  margin-top: 5.5%;
  margin-left: -4.7%;
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
          <form method="POST" action="busca.php">
            <input type="text" class="search-box" name="pesquisa" placeholder="Buscar na Sakura...">
            <button type="submit" class="resultado"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            </form>
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
                  <a class="login" href="login.php">ENTRAR</a>
                  <a class="cadastro" href="cadastro.php">CADASTRAR</a>
              <?php } ?>
              </svg>

            </div>
            </nav>
    </header>
   
    <body>
        <div class="slider-container">
          <div class="slider">
            <div class="slide"><img src="imagens/imagem 5.png" alt="Slide 1"></div>
            <div class="slide"><img src="imagens/imagem 5.png" alt="Slide 2"></div>
            <div class="slide"><img src="imagens/imagem .png" alt="Slide 3"></div>
          </div>
          <div class="slider-controls">
            <button class="prev" onclick="prevSlide()"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
              <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
            </svg></button>
            <button class="next" onclick="nextSlide()"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
              <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
            </svg></button>
          </div>


          <div class="product-container">

        <script>
          const slider = document.querySelector('.slider');
          let slideIndex = 0;
      
          function showSlide(index) 
            {
              slider.style.transform = `translateX(-${index * 100}%)`;
            }
      
          function prevSlide() 
            {
              slideIndex = (slideIndex - 1 + 3) % 3;
              showSlide(slideIndex);
            }
      
          function nextSlide() 
            {
              slideIndex = (slideIndex + 1) % 3;
              showSlide(slideIndex);
            }

            function confirmarSaida() {
        var confirmacao = confirm("Tem certeza de que deseja sair?");
        if (confirmacao) {
            window.location.href = "logoff.php";
        }
      }
        </script>


<div class="product-container">
    <h2 class="frase4">. . . PRODUTOS . . .</h2>
    <div class="row">
        <?php foreach ($produtos as $produto) : ?>
            <div class="col-sm-4" style="max-width: 300px; max-height: 500px;">
                <div class="card">
                    <img src="img/<?php echo $produto['imagem'];?>" alt="Imagem do Produto" width="250px" height="250px" class="imagens">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $produto['nome_produto']; ?></h5>
                        <p class="card-text">Preço: R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                        <button type="submit" class="button-comprar">COMPRAR</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
      </body>
