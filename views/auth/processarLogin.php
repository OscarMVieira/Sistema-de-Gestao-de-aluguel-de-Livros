<?php
session_start();
require_once '../basedados/basedados.h';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email_login = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass_login  = $_POST['password']; 

    
    $stmt = $conn->prepare("SELECT id, username, email, password, tipoContaId FROM users WHERE email = ?");
    $stmt->bind_param("s", $email_login); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($pass_login, $row['password'])) {
            $_SESSION['username'] = $row['username'];
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
    
    header("Location: paginaLogin.php?erro=1");
    exit();
}
?>