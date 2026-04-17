<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Digital - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/headerfooter.css">
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <span class="logo-text">Biblioteca Digital</span>
        </div>
        
        <div class="search-container">
            <a href="../admin/paginaCatalogo.php" class="home-nav-icon">
                <i class="fa-solid fa-house"></i>
            </a>
            
            <form action="../admin/paginaCatalogo.php" method="GET" class="search-bar">
                <input type="text" id="inputPesquisa" name="pesquisa" placeholder="Pesquisar livros..." autocomplete="off">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                <div id="boxSugestoes"></div>
            </form>
        </div>

        <div class="user-controls">
            <a href="../auth/paginaPerfil.php" class="user-profile-link">
                <div class="user-avatar">
                    <i class="fa-solid fa-circle-user"></i>
                </div>
                <span class="username">Administrador</span>
            </a>

            <a href="../cliente/paginaCarrinho.php" class="cart-link">
                <div class="cart-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="badge">0</span>
                </div>
            </a>

            <a href="../auth/paginaLogin.php" class="logout-btn">Logout</a>
        </div>
    </header>

    <div class="main-container">
        <aside class="sidebar">
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="gestaoPedidos.php"><i class="fa-solid fa-file-invoice"></i> Gestão de Pedidos</a></li>
                    <li><a href="gerirClientes.php"><i class="fa-solid fa-users"></i> Gerir Clientes</a></li>
                    <li><a href="paginaInsercaoDeLivros.php"><i class="fa-solid fa-plus"></i> Criar Livro</a></li>
                </ul>
            </nav>
        </aside>
        
        <main class="content">

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
            if (!resposta.ok) throw new Error("Erro ao buscar dados");

            const livros = await resposta.json();

            if (livros && livros.length > 0) {
                box.innerHTML = '';
                livros.forEach(livro => {
                    const div = document.createElement('div');
                    div.className = 'sugestao-item';
                    div.textContent = livro.titulo; 
                    
                    div.onclick = () => {
                        window.location.href = `../admin/paginaConsultarLivro.php?id=${livro.id}`;
                    };
                    box.appendChild(div);
                });
                box.style.display = 'block';
            } else {
                box.style.display = 'none';
            }
        } catch (erro) {
            console.error("Erro na pesquisa:", erro);
            box.style.display = 'none';
        }
    });

    document.addEventListener('click', (e) => {
        if (e.target !== input) box.style.display = 'none';
    });
    </script>