<?php
    include("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/scss/style.css">
    <title>Criar Conta</title>
</head>
<header class="cabecalho">
        <a href="index.html"><h1>Banco Gremio</h1></a>
        <div>
            <img src="assets/image/Login.png" alt="usuario-simbolo">
            <a href="login.html"><h1>Fazer Login</h1></a>
        </div>
    </header>
<body>
    <main>
        <article id="article-criar">
            <h1>Criar Conta</h1>
            <form action="?page=a" method="POST">
                <label for="">Nome Completo</label>
                <input type="text" name="nome-cadastro" required>
                <label for="">CPF</label>
                <input type="text" id="cpf-form" name="CPF-cadastro" maxlength="14" required>
                <label for="">Senha</label>
                <input type="password" name="senha-cadastro" required>
                <label for="">Email</label>
                <input type="email" name="email-cadastro" required>
                <label for="">Data Nascimento</label>
                <input type="date" name="data-nasc-cadastro" required>
                <input type="submit">
            </form>
        <?php
            if(@$_REQUEST["page"]=='a')
            {
                $result = true;

                $cpf_usuario = $_POST["CPF-cadastro"];

                $sql = "SELECT * FROM usuarios";

                $res = $conn->query($sql);

                $qtd = $res->num_rows;

                if($qtd > 0)
                    while($row = $res->fetch_object())
                        if($row->cpf == $cpf_usuario)
                            $result = false;
                
                $cpf_usuario2 = 2;

                if($result == true)
                {
                    $cpf_veri = 0;

                    for($i=0;$i<9;$i++)
                    {   
                        $cpf_veri += substr($cpf_usuario,$i,1) * (10-$i);
                    }
                    
                    $cpf_veri = $cpf_veri % 11;
                    
                    $cpf_veri = 11 - $cpf_veri;
                    
                    if($cpf_veri >= 10)
                        $cpf_veri = 0;
                    
                    if($cpf_veri == substr($cpf_usuario,9,1))
                    {
                        $cpf_veri = 0;
                    
                        for($i=0;$i<10;$i++)
                        {
                            $cpf_veri += substr($cpf_usuario,$i,1) * (11-$i);
                        }
                    
                        $cpf_veri = $cpf_veri % 11;
                    
                        $cpf_veri = 11 - $cpf_veri;
                        
                        if($cpf_veri >= 10)
                        $cpf_veri = 0;
                    
                        if($cpf_veri == substr($cpf_usuario,10,1))
                        {
                            $nome_usuario = $_POST["nome-cadastro"];
                            $senha_usuario = $_POST["senha-cadastro"];
                            $email_usuario = $_POST["email-cadastro"];
                            $date_usuario = $_POST["data-nasc-cadastro"];


                            $sql = "INSERT INTO usuarios (nome, cpf, senha, email, datanasc) 
                            VALUES ('{$nome_usuario}','{$cpf_usuario}','{$senha_usuario}','{$email_usuario}','{$date_usuario}')";

                            $res = $conn->query($sql);
                     
                            header("location:index.html");
                        }
                        else
                        print"<script>alert('Esse CPF é invalido');</script>";
                    }
                else
                    print"<script>alert('Esse CPF já esta cadastrado');</script>";
                }
            }
        ?>
        </article>
    </main>
    <script>
        var cpf = document.getElementById("cpf-form");

        cpf.addEventListener("input", () => {

        var limpar = cpf.value.replace(/\D/g, "").substring(0,14);

        var numerosArray = limpar.split("");

        var numeroFormatado = "";


        if(numerosArray.length > 3){
            numeroFormatado += ` ${numerosArray.slice(0,3).join("")}.`;
        }

        if(numerosArray.length > 6){
            numeroFormatado += ` ${numerosArray.slice(2,7).join("")}`;
        }

        if(numerosArray.length > 9){
            numeroFormatado += `-${numerosArray.slice(11,14).join("")}`;
        }

        cpf.value = numeroFormatado; 

        });
    </script>
</body>
</html>