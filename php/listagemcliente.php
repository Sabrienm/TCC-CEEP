<?php
include_once('conexao.php');

$pdo = conectar();

$sql = "SELECT * FROM tb_usuarios";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Listagem de Usuários</title>
    <link rel="stylesheet" href="css/bootstrap.mim.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
</head>
<body>
    <h2><center>Listagem de Usuários</center></h2>
    <table class="table table-striped table-light">
        <tr>
            <th>COD</th>
            <th>Nome Completo</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>CPF</th>
            <th>Senha</th>
            <th>Tipo Cadastro</th>
            <th>Ativo</th>
        </tr>
        <?php foreach($resultado as $r){?>
            <tr>
                <td><?php echo $r['cod_usuario'];?></td>
                <td><?php echo $r['nome_usuario']?></td>
                <td><?php echo $r['email_usuario']?></td>
                <td><?php echo $r['telefone_usuario']?></td>
                <td><?php echo $r['cpf_usuario']?></td>
                <td><?php echo $r['senha_usuario']?></td>
                <td><?php echo $r['tipo_cadastro']?></td>
                <td><?php echo $r['ativo']?></td>
                <td>
                    <a href="altcliente.php?cod=<?php echo $r['cod_usuario'] ?>" class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
</svg></a>
                    -
                    <a href= "exccliente.php?cod=<?php echo $r['cod_usuario']?>" class="btn btn-danger" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>