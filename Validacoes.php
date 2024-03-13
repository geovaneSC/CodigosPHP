<?php

function formatar_telefone($telefone){ //formatação de telefone
    $ddd = substr($telefone,0,2);
    $parte1 = substr($telefone,2,5);
    $parte2 = substr($telefone,7);
    return "($ddd) $parte1-$parte2";
}

function limpar_texto($str){ // para limpar caracters não númerico
    return preg_replace("/[^0-9]/","", $str);
}

if(count($_POST) > 0){

    include('conexao.php'); // estou fazendo a conexão a pagina php que contém a conexão ao banco de dados
    
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
         // estou fazendo a conexão ao banco de dados e inserindo dados ao mesmo
        $data = date('Y-m-d');
        $sql_code = "INSERT INTO clientes (nome, email, telefone, nascimento, data)VALUES('$nome', '$email','$telefone','$nascimento', NOW())";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo){
        echo "<p><b>Cliente cadastrado com sucesso</b></p>";
        unset($_POST); // unset() limpa a variavel
        }
    }

      
}?>