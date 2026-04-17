<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['tipoContaId'])) {
    if ($_SESSION['tipoContaId'] == 1) {
        // Se for Admin 
        $home_url = "../admin/paginaCatalogo.php"; 
    } else {
        // Se for Cliente 
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
            <div class="search-bar">
                <input type="text" placeholder="Pesquisar livros...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
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

    <div class="main-container">
        <main class="content-full">

