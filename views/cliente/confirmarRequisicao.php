<?php
session_start();
require_once '../basedados/basedados.h'; //

// 1. Verifica se o ID existe na sessão
if (!isset($_SESSION['user_id']) || empty($_SESSION['carrinho'])) {
    header("Location: paginaCatalogo.php?erro=sem_sessao");
    exit();
}

$user_id = $_SESSION['user_id'];
$data_pedido = date('Y-m-d');
$data_devolucao = $_POST['data_devolucao']; // Recebe do form do carrinho

// 2. Grava cada livro na tabela 'requisicoes'
foreach ($_SESSION['carrinho'] as $livro_id => $qtd) {
    // Usamos os nomes exatos das tuas colunas
    $sql = "INSERT INTO requisicoes (user_id, livro_id, data_pedido, data_devolucao, estado) 
            VALUES ('$user_id', '$livro_id', '$data_pedido', '$data_devolucao', 'Pendente')";
    
    $conn->query($sql);
}

// 3. Limpa o carrinho e avisa o utilizador
unset($_SESSION['carrinho']);
header("Location: paginaCatalogo.php?msg=sucesso");
exit();
?>