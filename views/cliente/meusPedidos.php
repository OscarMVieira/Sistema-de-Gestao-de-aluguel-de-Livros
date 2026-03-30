<?php include '../templates/headerCliente.php'; ?>

<link rel="stylesheet" href="../../public/css/meusPedidos.css">

<div class="pedidos-container">
    <h1 class="page-title">Meus Pedidos</h1>
    
    <div class="pedidos-card">
        <h2 class="section-title">Minhas Requisições</h2>
        
        <table class="pedidos-table">
            <thead>
                <tr>
                    <th>Pedido</th>
                    <th>Data Pedido</th>
                    <th>Livro(s)</th>
                    <th>Autores</th>
                    <th>Duração</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>23/07/2026</td>
                    <td>O Gato Que Salvava Livros, etc...</td>
                    <td>Sosuke Natsukawa</td>
                    <td>1 Dia</td>
                    <td><span class="status-badge terminada">Terminada</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>26/08/2026</td>
                    <td>Os Lusíadas</td>
                    <td>Luís de Camões</td>
                    <td>7 Dias</td>
                    <td><span class="status-badge levantado">Levantado</span></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>2/09/2026</td>
                    <td>O mundo dos Gatos</td>
                    <td>Sosuke Natsukawa</td>
                    <td>14 Dias</td>
                    <td><span class="status-badge inativa">Inativa</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include '../templates/footer.php'; ?>