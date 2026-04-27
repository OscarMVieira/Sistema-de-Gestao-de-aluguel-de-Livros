<?php
session_start();
require_once '../basedados/basedados.h'; // Liga à BD

$email_atual = $_SESSION['email'];
$nome  = $_POST['nome'];
$doc   = $_POST['documento'];
$pass  = $_POST['password'];

// Lógica para a FOTO
$sql_foto = ""; 
if (isset($_FILES['nova_foto']) && $_FILES['nova_foto']['error'] == 0) {
    $extensao = pathinfo($_FILES['nova_foto']['name'], PATHINFO_EXTENSION);
    $nome_foto = time() . "." . $extensao; 
    $destino = "../../public/img/" . $nome_foto;

    if (move_uploaded_file($_FILES['nova_foto']['tmp_name'], $destino)) {
        $sql_foto = ", foto='$nome_foto'";
    }
}

// Lógica para a PASSWORD
$sql_pass = "";
if (!empty($pass)) {
    $sql_pass = ", password='$pass'";
}

// Comando para atualizar a base de dados
$sql = "UPDATE users SET username='$nome', documento='$doc' $sql_foto $sql_pass 
        WHERE email='$email_atual'";

if ($conn->query($sql) === TRUE) {
    // PROTEÇÃO: Verifica se alguma linha foi realmente alterada na BD
    if ($conn->affected_rows > 0) {
        $_SESSION['username'] = $nome; // Atualiza o nome no header
        header("Location: paginaPerfil.php?sucesso=1"); // Envia sinal de sucesso
    } else {
        // Se clicaram no botão mas não mudaram nada, volta sem mostrar a mensagem
        header("Location: paginaPerfil.php");
    }
} else {
    echo "Erro ao atualizar: " . $conn->error;
}

$conn->close();
?>