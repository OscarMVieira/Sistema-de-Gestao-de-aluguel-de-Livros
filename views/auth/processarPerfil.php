<?php
session_start();
require_once '../basedados/basedados.h';// Liga à BD

$email_atual = $_SESSION['email'];
$nome  = $_POST['nome'];
$doc   = $_POST['documento'];
$pass  = $_POST['password'];

// Lógica para a FOTO
$sql_foto = ""; 
if (isset($_FILES['nova_foto']) && $_FILES['nova_foto']['error'] == 0) {
    $extensao = pathinfo($_FILES['nova_foto']['name'], PATHINFO_EXTENSION);
    $nome_foto = time() . "." . $extensao; // Nome único para não repetir ficheiros
    $destino = "../../public/img/" . $nome_foto;

    if (move_uploaded_file($_FILES['nova_foto']['tmp_name'], $destino)) {
        $sql_foto = ", foto='$nome_foto'";
    }
}

// Lógica para a PASSWORD (só muda se não estiver vazia)
$sql_pass = "";
if (!empty($pass)) {
    $sql_pass = ", password='$pass'";
}


// Comando para atualizar a base de dados
$sql = "UPDATE users SET username='$nome', documento='$doc' $sql_foto $sql_pass 
        WHERE email='$email_atual'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['username'] = $nome; // Atualiza o nome que aparece no header
    header("Location: paginaPerfil.php?sucesso=1");
} else {
    echo "Erro ao atualizar: " . $conn->error;
}
?>