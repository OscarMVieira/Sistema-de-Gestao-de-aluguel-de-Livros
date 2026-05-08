<?php
// Liga-se à base de dados
require_once '../basedados/basedados.h';

// Recebe os dados do formulário
$nome      = $_POST['nome']; 
$email     = $_POST['email'];
$pass      = $_POST['password'];
$documento = $_POST['documento'];
$tipo      = 3; 

// Validação da password 
if (!preg_match('/[A-Z]/', $pass) || !preg_match('/[0-9]/', $pass)) {
    die("<h2>Erro: A password é demasiado fraca.</h2><a href='paginaRegisto.php'>Voltar</a>");
}

// Proteção para o CC/NIF
if (!ctype_digit($documento)) {
    die("<h2>Erro: O campo CC/NIF só pode conter números.</h2><a href='paginaRegisto.php'>Voltar</a>");
}


// Cria um hash seguro usando Bcrypt
$password_hashed = password_hash($pass, PASSWORD_BCRYPT);

// Insere os dados na tabela users (usando a password encriptada)
$sql = "INSERT INTO users (username, email, password, documento, tipoContaId) 
        VALUES ('$nome', '$email', '$password_hashed', '$documento', '$tipo')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>Registo concluído com sucesso!</h2>";
    header("Refresh: 2; url=paginaLogin.php");
} else {
    echo "Erro ao registar: " . $conn->error;
}

$conn->close();
?>