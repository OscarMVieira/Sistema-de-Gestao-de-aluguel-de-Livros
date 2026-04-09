<?php
session_start();
require_once '../basedados/basedados.h';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_login = $_POST['email']; 
    $pass_login  = $_POST['password']; 

    // Procura o utilizador pelo e-mail
    $sql = "SELECT * FROM users WHERE email = '$email_login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifica a password 
        if ($pass_login == $row['password']) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['tipo']     = $row['tipoContaId'];
            $_SESSION['email']     = $row['email'];


            // Redirecionamento automático conforme seja o utilizador ou o admin 
            if ($row['tipoContaId'] == 1) {
                header("Location: ../admin/paginaCatalogo.php"); 
            } else {
                header("Location: ../cliente/paginaCatalogo.php"); 
            }
            exit();
        }
    }
    // Se falhar (e-mail não existe ou pass errada), volta ao login com erro
    header("Location: paginaLogin.php?erro=1");
}
?>