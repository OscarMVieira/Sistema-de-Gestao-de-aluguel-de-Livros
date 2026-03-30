<?php include '../templates/header.php'; ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Histórico: João</title>
    <link rel="stylesheet" href="../../public/css/paginaHistorico.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="layoutPrincipal">
        <main class="areaConteudo">
            <h1 class="tituloEsquerda">Histórico: João</h1>

            <div class="caixaCard containerTabela">
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

            <div class="alinhamentoVoltar">
                <a href="../cliente/paginaCatalogo.php" class="botaoBranco">Voltar</a>
            </div>
        </main>
    </div>
</body>
</html>
<?php include '../templates/footer.php'; ?>