<?php
require_once '../basedados/basedados.h';

// Captura e sanitização (SCRUM-98)
$nome      = htmlspecialchars($_POST['nome']); 
$email     = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$pass      = $_POST['password'];
$documento = preg_replace('/[^0-9]/', '', $_POST['documento']); 
$tipo      = 2; // Alterado para 2 (Cliente) conforme a tua lógica anterior

// Validação de força de password (mantida)
if (!preg_match('/[A-Z]/', $pass) || !preg_match('/[0-9]/', $pass)) {
    die("<h2>Erro: A password é demasiado fraca.</h2><a href='paginaRegisto.php'>Voltar</a>");
}

$password_hashed = password_hash($pass, PASSWORD_BCRYPT);

// SCRUM-97: Inserção protegida
$stmt = $conn->prepare("INSERT INTO users (username, email, password, documento, tipoContaId) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $nome, $email, $password_hashed, $documento, $tipo);

if ($stmt->execute()) {
    echo "<h2>Registo concluído com sucesso!</h2>";
    header("Refresh: 2; url=paginaLogin.php");
} else {
    // Erro genérico para não dar pistas a atacantes
    echo "Erro ao processar o registo. Por favor, tente novamente.";
}

$stmt->close();
$conn->close();
?>