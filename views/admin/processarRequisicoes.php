<?php
require_once 'basedados/basedados.h'; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $livro_id = $_POST['id_livro'];
    $user_id = $_SESSION['user_id'] ?? 3; // Default para cliente se não houver sessão
    $data_pedido = date('Y-m-d');
    $estado = "Pendente";

    $sql = "INSERT INTO requisicoes (user_id, livro_id, data_pedido, estado) 
            VALUES ('$user_id', '$livro_id', '$data_pedido', '$estado')";

    if (mysqli_query($conn, $sql)) {
        // --- REDIRECIONAMENTO POR ID ---
        if ($user_id == 1) {
            // Admin vai para a sua página de catálogo
            header("Location: views/admin/paginaCatalogo.php?msg=sucesso");
        } else {
            // Cliente vai para a sua página de pedidos
            header("Location: views/cliente/meusPedidos.php?msg=sucesso");
        }
    } else {
        echo "Erro ao processar requisição: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>