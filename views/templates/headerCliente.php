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
            <div class="search-bar">
                <input type="text" placeholder="Pesquisar livros...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>

        <div class="user-controls">
            <a href="../auth/paginaPerfil.php" class="user-profile-link">
                <div class="user-avatar">
                    <i class="fa-solid fa-circle-user"></i>
                </div>
                <span class="username">Ana Costa</span>
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