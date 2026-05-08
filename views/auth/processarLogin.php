<?php
session_start();
require_once '../basedados/basedados.h';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_login = $_POST['email']; 
    $pass_login  = $_POST['password']; 

    // Procura o utilizador pelo e-mail
    $sql = "SELECT * FROM users WHERE email = '$email_login'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Tenta validar a password com Bcrypt
        if (password_verify($pass_login, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['tipo']     = $row['tipoContaId'];
            $_SESSION['email']    = $row['email'];
            $_SESSION['user_id']  = $row['id']; 
            $_SESSION['tipoContaId'] = $row['tipoContaId'];

            if ($row['tipoContaId'] == 1) {
                header("Location: ../admin/paginaCatalogo.php"); 
            } else {
                header("Location: ../cliente/paginaCatalogo.php"); 
            }
            exit();
        }
    }
    //redireciona com erro genérico
    header("Location: paginaLogin.php?erro=1");
    exit();
}
?>