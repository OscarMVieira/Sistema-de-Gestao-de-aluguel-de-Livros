<?php
// Liga-se à base de dados
require_once '../basedados/basedados.h';

// Recebe os dados do formulário paginaRegisto.php
$nome      = $_POST['nome']; 
$email     = $_POST['email'];
$pass      = $_POST['password'];
$documento = $_POST['documento'];
$tipo      = 3; // Valor 3 para o cliente 

// Insere os dados na tabela 'users' que criei
$sql = "INSERT INTO users (username, email, password, documento, tipoContaId) 
        VALUES ('$nome', '$email', '$pass', '$documento', '$tipo')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>Registo concluído com sucesso!</h2>";
    // Redireciona para o login após 2 segundos
    header("Refresh: 2; url=paginaLogin.php");
} else {
    echo "Erro ao registar: " . $conn->error;
}

$conn->close();
?>