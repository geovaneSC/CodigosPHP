<?php
include('conexao.php'); // estou fazendo a conexão a pagina php que contém a conexão ao banco de dados
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

function limpar_texto($str){ // para limpar caracters não númerico
    return preg_replace("/[^0-9]/","", $str);
}

if(count($_POST) > 0){

    
    
   $erro = false;
   $nome = $_POST['nome'];
   $email = $_POST['email'];
   $telefone = $_POST['telefone'];
   $nascimento = $_POST['nascimento'];

   if(empty($nome)){ //empty está verificando se o campo nome é vazio
        $erro  = "preencha o nome";
   }
   if(empty($_POST['email'])|| !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ // verificando se o email é valido
        $erro = "<p>Preencha o campo email</p>";
    } 
    if(!empty($nascimento)){ // verificando se a variavel nascimento é vazio
        $pedacoes = explode('/', $nascimento);// verifica de foi digitado corretamente a data
            if(count($pedacoes) == 3){
                //o metódo a array_reverse inverte a ordem do array
                //o metódo explode quebra a varivael em pedações
                $nascimento = implode('-', array_reverse($pedacoes));
            }else{
                $erro = "A data de nascimento deve seguir o padrão dia/mes/ano.";
            } 
    }

    if(!empty($telefone)){
        $telefone =  limpar_texto($telefone);
        if(strlen($telefone) != 11 ){
            $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888 ";
        }
    }
    if ($erro) {
        echo "<p><b>$erro</b></p>";
    } else {
         // estou fazendo a conexão ao banco de dados e a atualização dados ao mesmo tempo
        $data = date('Y-m-d');
        $sql_code = "UPDATE clientes
        SET nome = '$nome',
        email = '$email',
        telefone = '$telefone',
        nascimento = '$nascimento'
        WHERE id = '$id'";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo){
        echo "<p><b>Cliente atualizado com sucesso</b></p>";
        unset($_POST); // unset() limpa a variavel
        }
    }

}


$sql_cliente = "SELECT * FROM clientes WHERE id = '$id'";
$query_cliente = $mysqli->query($sql_cliente) or die ($mysqli->error);
$cliente = $query_cliente->fetch_assoc(); 
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Editar Cliente</title>
</head>
<body>

    <section class="container p-2">
        <nav class="nav">
        <a href="clientes_cadastrado.php" class="nav-link">Voltar para a lista</a>
        </nav>
    </section>
    
    <form class=" container shadow rounded-4 p-4 text-center" method = "POST" action="">

        <p>Editar dados:</p>
    
        <div class="form-foating">
            <label>Nome</label>
            <input value="<?php echo $cliente['nome'];?>" type="text" name="nome" class="form-control m-2" placeholder="Nome"><br>
            <!-- mesmo que o usuario errer os dados ficaram nos campos para serem corrijidos usando isso value=" <php if(isset($_POST['nome'])) echo $_POST['nome'];?>" -->
        </div>
            <button class="btn btn-primary mt-3" type="submit">Cadastrar</button>
</form>

</body>
</html>

