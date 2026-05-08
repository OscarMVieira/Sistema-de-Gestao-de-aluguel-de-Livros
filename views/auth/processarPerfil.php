<?php
session_start();
require_once '../basedados/basedados.h';

$email_atual = $_SESSION['email'];
$nome  = $_POST['nome'];
$doc   = $_POST['documento'];
$pass  = $_POST['password'];

$sql_foto = ""; 
if (isset($_FILES['nova_foto']) && $_FILES['nova_foto']['error'] == 0) {
    $extensao = strtolower(pathinfo($_FILES['nova_foto']['name'], PATHINFO_EXTENSION));
    $extensoes_permitidas = ['jpg', 'jpeg', 'png'];

    if (in_array($extensao, $extensoes_permitidas)) {
        $nome_foto = time() . "." . $extensao; 
        $destino = "../../public/img/" . $nome_foto;

        if (move_uploaded_file($_FILES['nova_foto']['tmp_name'], $destino)) {
            $sql_foto = ", foto='$nome_foto'";
        }
    } else {
        header("Location: paginaPerfil.php?erro=formato_invalido");
        exit();
    }
}


$sql_pass = "";
if (!empty($pass)) {
    // Encripta a nova password antes de guardar
    $password_hashed = password_hash($pass, PASSWORD_BCRYPT);
    $sql_pass = ", password='$password_hashed'";
}

$sql = "UPDATE users SET username='$nome', documento='$doc' $sql_foto $sql_pass 
        WHERE email='$email_atual'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['username'] = $nome; 
    header("Location: paginaPerfil.php?sucesso=1");
} else {
    echo "Erro: " . $conn->error;
}
$conn->close();
?>