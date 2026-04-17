<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$home_url = "../auth/paginaLogin.php"; 
if (isset($_SESSION['tipoContaId'])) {
    if ($_SESSION['tipoContaId'] == 1) {
        $home_url = "../admin/paginaCatalogo.php"; 
    } else {
        $home_url = "../cliente/paginaCatalogo.php"; 
    }
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Digital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/headerSemSidebar.css">
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <span class="logo-text">Biblioteca Digital</span>
        </div>
        
        <div class="search-container">
            <a href="<?php echo $home_url; ?>" class="home-nav-icon">
                <i class="fa-solid fa-house"></i>
            </a>
            
            <form action="<?php echo $home_url; ?>" method="GET" class="search-bar">
                <input type="text" id="inputPesquisa" name="pesquisa" placeholder="Pesquisar livros..." autocomplete="off">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                <div id="boxSugestoes" class="sugestoes-popup"></div>
            </form>
        </div>

        <div class="user-controls">
            <div class="user-avatar">
                <i class="fa-solid fa-circle-user"></i>
            </div>
            <span class="username"><?php echo $_SESSION['username'] ?? 'Convidado'; ?></span>

            <a href="../cliente/paginaCarrinho.php" class="cart-link">
                <div class="cart-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="badge">0</span>
                </div>
            </a> 
            <a href="../auth/paginaLogin.php" class="logout-btn">Logout</a>
        </div>
    </header>

    <script>
const input = document.getElementById('inputPesquisa');
const box = document.getElementById('boxSugestoes');

input.addEventListener('input', async () => {
    const busca = input.value;

    if (busca.length < 2) {
        box.style.display = 'none';
        return;
    }

    try {
        const resposta = await fetch(`../basedados/sugestoes.php?q=${busca}`);
        if (!resposta.ok) throw new Error("Erro de comunicação");

        const livros = await resposta.json();

        if (livros && livros.length > 0) {
            box.innerHTML = '';
            livros.forEach(livro => {
                const div = document.createElement('div');
                div.className = 'sugestao-item';
                div.textContent = livro.titulo; 
                
                
                div.onclick = () => {
                    window.location.href = `../cliente/paginaConsultarLivro.php?id=${livro.id}`;
                };
                box.appendChild(div);
            });
            box.style.display = 'block';
        } else {
            box.style.display = 'none';
        }
    } catch (erro) {
        console.error("Erro:", erro);
    }
});

document.addEventListener('click', (e) => {
    if (e.target !== input) box.style.display = 'none';
});
</script>

    <div class="main-container">
        <main class="content-full">