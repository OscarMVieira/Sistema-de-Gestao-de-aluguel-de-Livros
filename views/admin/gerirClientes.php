<?php 
include '../templates/header.php'; 
?>

<link rel="stylesheet" href="../../public/css/gerirClientes.css">

<div class="clientesPageContainer">
    <h1 class="pageMainTitle">Clientes no Sistema</h1>

    <div class="clientesCard">
        <div class="cardHeader">
            <h2>Clientes no Sistema</h2>
        </div>
        
        <div class="cardBody">
            <div class="clienteRow">
                <span class="clienteNome">Nome: Joana Silva</span>
                <div class="clienteActions">
                    <a href="paginaVerHistorico.php" class="actionBtn">Ver Histórico</a>
                    <a href="paginaDetalhesCliente.php" class="actionBtn">Ver Detalhes</a>
                </div>
            </div>

            <div class="clienteRow">
                <span class="clienteNome">Nome: João Gomes</span>
                <div class="clienteActions">
                    <a href="paginaVerHistorico.php" class="actionBtn">Ver Histórico</a>
                    <a href="paginaDetalhesCliente.php" class="actionBtn">Ver Detalhes</a>
                </div>
            </div>

            <div class="clienteRow">
                <span class="clienteNome">Nome: Andre Pinho</span>
                <div class="clienteActions">
                    <a href="paginaVerHistorico.php" class="actionBtn">Ver Histórico</a>
                    <a href="paginaDetalhesCliente.php" class="actionBtn">Ver Detalhes</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>