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
            <a href="index.php" class="home-nav-icon">
                <i class="fa-solid fa-house"></i>
            </a>
            <div class="search-bar">
                <input type="text" placeholder="Pesquisar livros...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>

        <div class="user-controls">
            <div class="user-avatar">
                <i class="fa-solid fa-circle-user"></i>
            </div>
            <span class="username">Ana Costa</span>
            <div class="cart-icon">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="badge">0</span>
            </div>
            <button class="logout-btn">Logout</button>
        </div>
    </header>

    <div class="main-container">
        <aside class="sidebar">
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="#"><i class="fa-solid fa-file-invoice"></i> Gestão de Pedidos</a></li>
                    <li><a href="#"><i class="fa-solid fa-users"></i> Gerir Clientes</a></li>
                    
                    <li class="sidebar-footer">
                        <a href="criarLivro.php" class="btn-create-book">
                            <i class="fa-solid fa-plus"></i> Criar Livro
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        <main class="content">