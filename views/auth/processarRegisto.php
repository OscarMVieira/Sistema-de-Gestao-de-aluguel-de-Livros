<?php
require_once '../basedados/basedados.h';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nome      = htmlspecialchars($_POST['nome']); 
    $email     = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass      = $_POST['password'] ?? '';
    $documento = preg_replace('/[^0-9]/', '', $_POST['documento']); 
    $tipo      = 3; 


    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $resultadoCheck = $checkEmail->get_result();

    if ($resultadoCheck->num_rows > 0) {
        
        header("Location: paginaRegisto.php?status=email_duplicado");
        exit();
    }
    $checkEmail->close();


    if (!preg_match('/[A-Z]/', $pass) || !preg_match('/[0-9]/', $pass)) {
        header("Location: paginaRegisto.php?status=erro_pass");
        exit();
    }

    $password_hashed = password_hash($pass, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, documento, tipoContaId) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $nome, $email, $password_hashed, $documento, $tipo);

    if ($stmt->execute()) {
        header("Location: paginaRegisto.php?status=sucesso");
    } else {
        header("Location: paginaRegisto.php?status=erro_db");
    }

    $stmt->close();
    $conn->close();
    exit();
} else {
    header("Location: paginaRegisto.php");
    exit();
}
?>