<?php


if(count($_POST) > 0){

    include('conexao.php'); // estou fazendo a conexão a pagina php que contém a conexão ao banco de dados
    
   $erro = false;
   $nome = $_POST['nome'];
   $email = $_POST['email'];
   $telefone = $_POST['telefone'];
   $nascimento = $_POST['nascimento'];


    if ($erro) {
        echo "<p><b>$erro</b></p>";
    } else {
         // estou fazendo a conexão ao banco de dados e inserindo dados ao mesmo
        $data = date('Y-m-d');
        $sql_code = "INSERT INTO clientes (nome, email, telefone, nascimento, data)VALUES('$nome', '$email','$telefone','$nascimento', NOW())";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo){
        echo "<p><b>Cliente cadastrado com sucesso</b></p>";
        unset($_POST); // unset() limpa a variavel
        }
    }

      
}

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Cadastrar Cliente</title>
</head>
<body>

    <section class="container p-2">
        <nav class="nav">
        <a href="clientes_cadastrado.php" class="nav-link">Voltar para a lista</a>
        </nav>
    </section>
    
    <form class=" container shadow rounded-4 p-4 text-center" method = "POST" action="">

        <p>Digite seus dados:</p>
    
        <div class="form-foating">
            <label>Nome</label>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome'];?>" type="text" name="nome" class="form-control m-2" placeholder="Nome"><br>
            <!-- mesmo que o usuario errer os dados ficaram nos campos para serem corrijidos usando isso value=" <php if(isset($_POST['nome'])) echo $_POST['nome'];?>" -->
        </div>
            <button class="btn btn-primary mt-3" type="submit">Cadastrar</button>
</form>

</body>
</html>

