<?php
session_start();
require_once '../basedados/basedados.h'; // Necessário para consultar o stock real

$id = $_GET['id'] ?? 0;
$acao = $_GET['acao'] ?? '';

if (!isset($_SESSION['carrinho'])) { $_SESSION['carrinho'] = []; }

$status = "";
if ($acao == 'add' && $id > 0) {
    if (array_sum($_SESSION['carrinho']) < 3) {
        
        $stmt = $conn->prepare("SELECT Quantidade FROM livros WHERE ID_Livro = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $livro = $res->fetch_assoc();
        
        $stock_disponivel = $livro['Quantidade'] ?? 0;
        $qtd_no_carrinho = $_SESSION['carrinho'][$id] ?? 0;

        
        if (($qtd_no_carrinho + 1) <= $stock_disponivel) {
            $_SESSION['carrinho'][$id] = $qtd_no_carrinho + 1;
            $status = "adicionado";
        } else {
            $status = "sem_stock"; 
        }
        $stmt->close();
    } else {
        $status = "limite";
    }
} elseif ($acao == 'sub' && $id > 0) {
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]--;
        if ($_SESSION['carrinho'][$id] <= 0) { unset($_SESSION['carrinho'][$id]); }
    }

} elseif ($acao == 'sub' && $id > 0) {
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]--;
        if ($_SESSION['carrinho'][$id] <= 0) { unset($_SESSION['carrinho'][$id]); }
    }
}

$totalItens = 0;
if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $idLivro => $quantidade) {
        $totalItens += $quantidade;
    }
}
$_SESSION['total_itens_carrinho'] = $totalItens; 


$referer = $_SERVER['HTTP_REFERER'] ?? 'paginaCatalogo.php';
$referer = preg_replace('/[?&]status=[^&]*/', '', $referer);
$separador = (strpos($referer, '?') !== false) ? '&' : '?';

if ($status) {
    header("Location: " . $referer . $separador . "status=" . $status);
} else {
    header("Location: " . $referer);
}
exit();
?>

$referer = $_SERVER['HTTP_REFERER'] ?? 'paginaCatalogo.php';
$referer = preg_replace('/[?&]status=[^&]*/', '', $referer);
$separador = (strpos($referer, '?') !== false) ? '&' : '?';

if ($status) {
    header("Location: " . $referer . $separador . "status=" . $status);
} else {
    header("Location: " . $referer);
}
exit();
?>