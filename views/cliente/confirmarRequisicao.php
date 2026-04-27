<?php
session_start();
require_once '../basedados/basedados.h'; 

if (!isset($_SESSION['user_id']) || empty($_SESSION['carrinho'])) {
    header("Location: paginaCatalogo.php?erro=sem_sessao");
    exit();
}

$user_id = $_SESSION['user_id'];
$data_pedido = date('Y-m-d');
$data_devolucao = $_POST['data_devolucao']; 

foreach ($_SESSION['carrinho'] as $livro_id => $qtd) {
    $sql = "INSERT INTO requisicoes (user_id, livro_id, data_pedido, data_devolucao, estado) 
            VALUES ('$user_id', '$livro_id', '$data_pedido', '$data_devolucao', 'Pendente')";
    $conn->query($sql);
}

unset($_SESSION['carrinho']);

// --- LÓGICA DE REDIRECIONAMENTO POR ID ---
if ($user_id == 1) {
    // Se for Admin (ID 1), volta para a pasta admin
    header("Location: ../admin/paginaCatalogo.php?msg=sucesso");
} else {
    // Se for Cliente (ID 3 ou outros), mantém-se na pasta cliente
    header("Location: paginaCatalogo.php?msg=sucesso");
}
exit();
?>