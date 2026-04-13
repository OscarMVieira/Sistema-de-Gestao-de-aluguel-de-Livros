<?php
require_once 'basedados/basedados.h'; 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $livro_id = $_POST['id_livro'];
    
    // Puxamos o ID do utilizador que está logado na sessão
    $user_id = $_SESSION['user_id'] ?? 1; 
    
    $data_pedido = date('Y-m-d'); // Data atual automática
    $estado = "Pendente"; // estado default

    //Inserir os dados na tabela requisicoes
    $sql = "INSERT INTO requisicoes (user_id, livro_id, data_pedido, estado) 
        VALUES ('$user_id', '$livro_id', '$data_pedido', '$estado')";

    //Executar a query e verificar o sucesso
    if (mysqli_query($conn, $sql)) {
        echo "<h2>Pedido efetuado com sucesso!</h2>";
        // Redireciona para a página de pedidos do cliente após 2 segundos
        header("Refresh: 2; url=views/cliente/meusPedidos.php");
    } else {
        echo "Erro ao processar requisição: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>