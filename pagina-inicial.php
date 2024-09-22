<?php
session_start();
$usuario_nome = $_SESSION['nome_usuario'];
include("conexao.php");
//include 'login.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/scss/style.css">
    <title>Pagina Inical</title>
</head>
<body>
    <header class="cabecalho">
        <a href="index.html"><h1>Banco Gremio</h1></a>
        <div>
            <img src="assets/image/Login.png" alt="usuario-simbolo">
            <a href=""><?php print"<h1>$usuario_nome</h1>";?></a>
        </div>
    </header>
    <main>
        <article id="article-pagina-inicial">
            <h1>Bem-Vindo<?php print"<h1>$usuario_nome</h1>";?></h1>    
        </article>
    </main>
</body>
</html>