<?php
session_start();
$id = $_GET['id'] ?? 0;
$acao = $_GET['acao'] ?? '';

if (!isset($_SESSION['carrinho'])) { $_SESSION['carrinho'] = []; }

if ($acao == 'add' && $id > 0) {
    // Verifica o limite total de 3 livros
    if (array_sum($_SESSION['carrinho']) < 3) {
        $_SESSION['carrinho'][$id] = (isset($_SESSION['carrinho'][$id])) ? $_SESSION['carrinho'][$id] + 1 : 1;
    }
} elseif ($acao == 'sub' && $id > 0) {
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]--;
        if ($_SESSION['carrinho'][$id] <= 0) { unset($_SESSION['carrinho'][$id]); }
    }
}
header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'paginaCarrinho.php'));
exit();