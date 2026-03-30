<?php 
include '../templates/headerSemSidebar.php'; 
?>

<link rel="stylesheet" href="../../public/css/paginaDetalhesCliente.css">

<div class="detalhesWrapper">
    <h1 class="detalhesTitle">Detalhes: João</h1>

    <div class="detalhesCard">
        <h2 class="cardSubtitle">Informação Principal</h2>
        
        <div class="infoContainer">
            <div class="fieldRow">
                <div class="labelBox">Id do Cliente:</div>
                <input type="text" value="#1024" readonly>
            </div>

            <div class="fieldRow">
                <div class="labelBox">Nome Completo:</div>
                <input type="text" value="João Silva Augusto Ramos" readonly>
            </div>

            <div class="fieldRow">
                <div class="labelBox">Email:</div>
                <input type="text" value="joao@gmail.com" readonly>
            </div>

            <div class="fieldRow">
                <div class="labelBox">NIF:</div>
                <input type="text" value="12345678" readonly>
            </div>

            <div class="buttonContainer">
                <a href="gerirClientes.php" class="btnVoltar-link">
                    <button class="btnVoltar">Voltar</button>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>