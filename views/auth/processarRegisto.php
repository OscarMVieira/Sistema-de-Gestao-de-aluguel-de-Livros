<?php
// Liga-se à base de dados
require_once '../basedados/basedados.h';

// Recebe os dados do formulário paginaRegisto.php
$nome      = $_POST['nome']; 
$email     = $_POST['email'];
$pass      = $_POST['password'];
$documento = $_POST['documento'];
$tipo      = 3; // Valor 3 para o cliente 

// validacao da password
if (!preg_match('/[A-Z]/', $pass) || !preg_match('/[0-9]/', $pass)) {
    die("<h2>Erro: A password é demasiado fraca. Deve conter pelo menos uma letra maiúscula e um número.</h2><a href='paginaRegisto.php'>Voltar</a>");
}

// Proteção simples para o CC/NIF: Só deixa passar se forem números
if (!ctype_digit($documento)) {
    die("<h2>Erro: O campo CC/NIF só pode conter números.</h2><a href='paginaRegisto.php'>Voltar</a>");
}

// Insere os dados na tabela 'users'[cite: 8]
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