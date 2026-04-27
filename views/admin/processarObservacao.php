<?php
require_once '../basedados/basedados.h';

if (isset($_GET['id']) && isset($_GET['obs'])) {
    $id = $_GET['id'];
    $obs = $_GET['obs'];

    $obs = mysqli_real_escape_string($conn, $obs);

    $query = "UPDATE requisicoes SET observacao = '$obs' WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        // Redireciona de volta para a gestão de pedidos
        header("Location: gestaoPedidos.php?sucesso=obs");
    } else {
        echo "Erro ao atualizar observação: " . mysqli_error($conn);
    }
}
?>