<?php
include("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Pagina para login Banco Inter">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/scss/style.css">
    <title>Login</title>
</head>
<body>
    <header class="cabecalho">
        <a href="index.html"><h1>Banco Gremio</h1></a>
    </header>
    <main>
        <article id="article-login">
            <h1>Fazer Login</h1>
            <form method="POST" action="?page=a">
                <label for="login-usuario">CPF</label>
                <input type="text" name="login-usuario" maxlength=11 required >
                <label for="senha-usuario">Senha</label>
                <input type="password" name="senha-usuario" required>
                <a href="criar-conta.php"><h2>Criar conta</h2></a>
                <div>
                    <input type="submit">
                </div>
            </form>
        </article>
        <?php
            if(@$_REQUEST["page"]=='a')
            {
                $result = false;

                $login_usuario = $_POST["login-usuario"];
                $senha_usuario = $_POST["senha-usuario"];

                $sql = "SELECT * FROM usuarios";

                $res = $conn->query($sql);

                $qtd = $res->num_rows;

                if($qtd > 0)
                    while($row = $res->fetch_object())
                        if($row->cpf == $login_usuario && $row->senha == $senha_usuario)
                        {
                            $result = true;
                            $login_usuario = $row->nome;
                        }
                

                if($result == true)
                {
                    session_start();
                    $_SESSION['nome_usuario'] = $login_usuario;
                    header("location:pagina-inicial.php");
                }
            }
        ?>
    </main>
</body>
</html>