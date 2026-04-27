<?php
session_start();
$id = $_GET['id'] ?? 0;
$acao = $_GET['acao'] ?? '';

if (!isset($_SESSION['carrinho'])) { $_SESSION['carrinho'] = []; }

$status = "";
if ($acao == 'add' && $id > 0) {
    // Verifica o limite total de 3 livros
    if (array_sum($_SESSION['carrinho']) < 3) {
        $_SESSION['carrinho'][$id] = (isset($_SESSION['carrinho'][$id])) ? $_SESSION['carrinho'][$id] + 1 : 1;
        $status = "adicionado";
    } else {
        $status = "limite";
    }
} elseif ($acao == 'sub' && $id > 0) {
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]--;
        if ($_SESSION['carrinho'][$id] <= 0) { unset($_SESSION['carrinho'][$id]); }
    }
}

// Redireciona de volta para a página anterior (Catálogo) com o status
$referer = $_SERVER['HTTP_REFERER'] ?? 'paginaCatalogo.php';

// Limpa status antigos da URL para não repetir o alerta
$referer = preg_replace('/[?&]status=[^&]*/', '', $referer);
$separador = (strpos($referer, '?') !== false) ? '&' : '?';

if ($status) {
    header("Location: " . $referer . $separador . "status=" . $status);
} else {
    header("Location: " . $referer);
}
exit();
?>