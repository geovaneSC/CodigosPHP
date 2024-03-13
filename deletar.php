<?php
if(isset($_POST['confirmar'])){
    include("conexao.php");
    $id = intval($_GET['id']);
    $sql_code = "DELETE FROM clientes WHERE id = '$id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    
    if($sql_query){ ?>
        <h1>Cliente deletado com sucesso!</h1>
        <p><a href="clientes_cadastrado.php">Clique aqui</a> para voltar para a lista de clientes.</p>
        <?php
        die();
    }    
}
?>