<?php include '../templates/header.php'; ?>

<link rel="stylesheet" href="../../public/css/gestaoPedidos.css">

<div class="gestao-container">
    <h1 class="page-title">Gestão de Pedidos</h1>
    
    <div class="gestao-card">
        <h2 class="section-title">Gestão de Pedidos</h2>
        
        <table class="gestao-table">
            <thead>
                <tr>
                    <th>Pedido</th>
                    <th>Data Pedido</th>
                    <th>Livro(s)</th>
                    <th>Autores</th>
                    <th>Estado</th>
                    <th>Levantamento</th>
                    <th>Devolução</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>23/07/2026</td>
                    <td>O Gato Que Salvava Livros, etc...</td>
                    <td>Sosuke Natsukawa</td>
                    <td>
                        <div class="status-wrapper">
                            <span class="status-badge terminada" onclick="toggleStatusMenu(this)">Terminada</span>
                            <select class="status-select" onchange="updateStatus(this)">
                                <option value="terminada" selected>Terminada</option>
                                <option value="levantado">Levantado</option>
                                <option value="inativa">Inativa</option>
                            </select>
                        </div>
                    </td>
                    <td>24/07/2026</td>
                    <td>27/07/2026</td>
                    <td><i class="fa-regular fa-file-lines obs-icon"></i></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>26/08/2026</td>
                    <td>Os Lusíadas</td>
                    <td>Luís de Camões</td>
                    <td>
                        <div class="status-wrapper">
                            <span class="status-badge levantado" onclick="toggleStatusMenu(this)">Levantado</span>
                            <select class="status-select" onchange="updateStatus(this)">
                                <option value="terminada">Terminada</option>
                                <option value="levantado" selected>Levantado</option>
                                <option value="inativa">Inativa</option>
                            </select>
                        </div>
                    </td>
                    <td>28/07</td>
                    <td>30/07/2026</td>
                    <td><i class="fa-regular fa-file-lines obs-icon"></i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
// Função para mostrar a lista de seleção
function toggleStatusMenu(badge) {
    const wrapper = badge.parentElement;
    wrapper.classList.toggle('active');
}

// Função para atualizar o visual após mudar o estado
function updateStatus(select) {
    const badge = select.previousElementSibling;
    const newValue = select.value;
    const newText = select.options[select.selectedIndex].text;
    
    // Atualiza o texto e a classe do badge
    badge.textContent = newText;
    badge.className = 'status-badge ' + newValue;
    
    // Fecha o menu
    select.parentElement.classList.remove('active');
}
</script>

<?php include '../templates/footer.php'; ?>