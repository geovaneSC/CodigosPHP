<?php
    include('conexao.php');
    $sql_clientes = "SELECT * FROM clientes";
    $query_clientes = $mysqli->query($sql_clientes) or die ($mysqli->error);
    $num_clientes = $query_clientes->num_rows; // para verificar quantos clientes existem 

?>