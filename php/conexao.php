<?php

$hostname = "localhost";    
$username = "ezequias"; 
$password = "[SYLlmSDrngBRroi";  
$dbname   = "sistema_reservas";  

$conexao = mysqli_connect($hostname, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}
else{
    echo("");
}

?>