<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Biblioteca - EX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="../../public/css/style.css">

    <?php if (isset($page_css)): ?>
        <link rel="stylesheet" href="../../public/css/<?php echo $page_css; ?>.css">
    <?php endif; ?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
    <div class="container-fluid">
<a class="navbar-brand d-flex align-items-center" href="../../public/index.php">
    <span class="brand-text">Biblioteca Digital</span>
</a>
        <form class="d-none d-md-flex mx-auto">
            <input class="form-control search-bar" type="search" placeholder="Pesquisar livros, autores...">
        </form>

        <div class="d-flex align-items-center text-white">
            <div class="me-3 position-relative">
                <i class="bi bi-cart3 fs-4"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
            </div>
            <div class="text-end me-2 d-none d-sm-block">
                <small class="d-block opacity-75">Bem-vindo,</small>
                <span class="fw-bold">Utilizador Exemplo</span>
            </div>
            <i class="bi bi-person-circle fs-2"></i>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="position-sticky">
                <a href="#" class="nav-link-custom active"><i class="bi bi-grid-fill"></i> Início</a>
                <a href="#" class="nav-link-custom"><i class="bi bi-journal-check"></i> Pedidos</a>
                <a href="#" class="nav-link-custom"><i class="bi bi-people"></i> Clientes</a>
                <a href="#" class="nav-link-custom"><i class="bi bi-book"></i> Catálogo</a>
                <hr>
                <a href="#" class="nav-link-custom text-danger"><i class="bi bi-box-arrow-right"></i> Sair</a>
            </div>
        </nav>
        
        <main class="col-md-10 ms-sm-auto px-md-4 py-4">