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

// Iniciar uma transação para garantir que ambas as operações (inserir e atualizar) corram bem
$conn->begin_transaction();

try {
    foreach ($_SESSION['carrinho'] as $livro_id => $qtd) {
        
        $sql_req = "INSERT INTO requisicoes (user_id, livro_id, data_pedido, data_devolucao, estado) 
                    VALUES ('$user_id', '$livro_id', '$data_pedido', '$data_devolucao', 'Pendente')";
        $conn->query($sql_req);

        $sql_update_stock = "UPDATE livros SET Quantidade = Quantidade - $qtd WHERE ID_Livro = '$livro_id'";
        $conn->query($sql_update_stock);

        $sql_check_disponibilidade = "UPDATE livros SET Disponibilidade = 0 WHERE ID_Livro = '$livro_id' AND Quantidade <= 0";
        $conn->query($sql_check_disponibilidade);
    }

    // Se tudo correr bem, guarda as alterações
    $conn->commit();
    unset($_SESSION['carrinho']);

} catch (Exception $e) {
    // Se houver algum erro, cancela as alterações para não corromper os dados
    $conn->rollback();
    header("Location: paginaCarrinho.php?erro=processamento");
    exit();
}

// --- LÓGICA DE REDIRECIONAMENTO POR ID ---
if ($user_id == 1) {
    header("Location: ../admin/paginaCatalogo.php?msg=sucesso");
} else {
    header("Location: paginaCatalogo.php?msg=sucesso");
}
exit();
?>