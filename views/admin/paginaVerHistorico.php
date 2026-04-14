<?php include '../templates/header.php'; ?>

<link rel="stylesheet" href="../../public/css/paginaHistorico.css">

<section class="seccaoHistorico">
    <div class="containerHistorico">
        
        <h1 class="tituloHistorico">Histórico: João</h1>

        <div class="cartaoTabela">
            <table class="tabelaHistorico">
                <thead>
                    <tr>
                        <th>Livro</th>
                        <th>Data Requisição</th>
                        <th>Data entrega</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>O Alquimista</td>
                        <td>28/03/2026</td>
                        <td>11/04/2026</td>
                        <td>Entregue</td>
                    </tr>
                    <tr>
                        <td>Dom Quixote</td>
                        <td>28/03/2026</td>
                        <td>11/04/2026</td>
                        <td>Entregue</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="areaBotoes">
            <a href="../admin/gerirClientes.php" class="botaoVoltar">Voltar</a>
        </div>

    </div>
</section>

<?php include '../templates/footer.php'; ?>