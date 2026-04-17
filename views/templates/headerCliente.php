<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Digital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/headerfooter.css">
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <span class="logo-text">Biblioteca Digital</span>
        </div>
        
        <div class="search-container">
            <a href="../cliente/paginaCatalogo.php" class="home-nav-icon">
                <i class="fa-solid fa-house"></i>
            </a>
            
            <form action="../cliente/paginaCatalogo.php" method="GET" class="search-bar">
                <input type="text" id="inputPesquisa" name="pesquisa" placeholder="Pesquisar livros..." autocomplete="off">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                <div id="boxSugestoes" class="sugestoes-popup"></div>
            </form>

            <script>
            const input = document.getElementById('inputPesquisa');
            const box = document.getElementById('boxSugestoes');

            input.addEventListener('input', async () => {
                const busca = input.value;

                // Só pesquisa se tiver pelo menos 2 letras
                if (busca.length < 2) {
                    box.style.display = 'none';
                    return;
                }

                try {
                    // Faz a chamada ao motor de busca
                    const resposta = await fetch(`../basedados/sugestoes.php?q=${busca}`);
                    
                    if (!resposta.ok) throw new Error("Erro ao buscar dados");

                    const livros = await resposta.json();

                    if (livros && livros.length > 0) {
                        box.innerHTML = '';
                        livros.forEach(livro => {
                            const div = document.createElement('div');
                            div.className = 'sugestao-item';
                            // O motor agora envia um objeto com 'titulo' e 'id'
                            div.textContent = livro.titulo; 
                            
                            // AO CLICAR: Vai direto para a página de detalhes usando o ID
                            div.onclick = () => {
                                window.location.href = `paginaConsultarLivro.php?id=${livro.id}`;
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

            // Fecha o popup se clicar fora dele
            document.addEventListener('click', (e) => {
                if (e.target !== input) box.style.display = 'none';
            });
            </script>
        </div>

        <div class="user-controls">
            <a href="../auth/paginaPerfil.php" class="user-profile-link">
                <div class="user-avatar">
                    <i class="fa-solid fa-circle-user"></i>
                </div>
                <span class="username"><?php echo $_SESSION['username'] ?? 'Ana Costa'; ?></span>
            </a>

            <a href="paginaCarrinho.php" class="cart-link">
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
            <nav>
                <ul>
                    <li><a href="../auth/paginaPerfil.php"><i class="fa-solid fa-user"></i> Perfil</a></li>
                    <li><a href="meusPedidos.php"><i class="fa-solid fa-box"></i> Meus pedidos</a></li>
                </ul>
            </nav>
        </aside>

        <main class="content">