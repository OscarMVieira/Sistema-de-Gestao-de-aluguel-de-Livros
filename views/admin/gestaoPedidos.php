<?php 
include '../templates/header.php'; 
require_once '../basedados/basedados.h';
//FALTA CRIAR UM PROCESSAR PEDIDOS EM VEZ DE USAR AQUI PARA EVITAR PROBLEMAS DE SEGURANCA
// buscar dados reais das 3 tabelas
$query = "SELECT r.*, u.username, l.titulo, l.autor 
          FROM requisicoes r
          JOIN users u ON r.user_id = u.id
          JOIN livros l ON r.livro_id = l.id
          ORDER BY r.data_pedido DESC";
$resultado = mysqli_query($conn, $query);
?>

<link rel="stylesheet" href="../../public/css/gestaoPedidos.css">

<div class="gestao-container">
    <h1 class="page-title">Gestão de Pedidos</h1>
    
    <div class="gestao-card">
        <h2 class="section-title">Lista de Requisições Ativas</h2>
        
        <table class="gestao-table">
            <thead>
                <tr>
                    <th>Pedido</th>
                    <th>Data Pedido</th>
                    <th>Livro</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Levantamento</th>
                    <th>Devolução</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                //criar uma linha por cada registo da BD
                if (mysqli_num_rows($resultado) > 0) {
                    while($row = mysqli_fetch_assoc($resultado)): 
                        $statusClass = strtolower($row['estado']);
                ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['data_pedido'])); ?></td>
                    <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td>
                        <div class="status-wrapper">
                            <span class="status-badge <?php echo $statusClass; ?>" onclick="toggleStatusMenu(this)">
                                <?php echo $row['estado']; ?>
                            </span>
                            <select class="status-select" onchange="updateStatus(this, <?php echo $row['id']; ?>)">
                                <option value="Pendente" <?php echo ($row['estado'] == 'Pendente') ? 'selected' : ''; ?>>Pendente</option>
                                <option value="Levantado" <?php echo ($row['estado'] == 'Levantado') ? 'selected' : ''; ?>>Levantado</option>
                                <option value="Terminada" <?php echo ($row['estado'] == 'Terminada') ? 'selected' : ''; ?>>Terminada</option>
                                <option value="Inativa" <?php echo ($row['estado'] == 'Inativa') ? 'selected' : ''; ?>>Inativa</option>
                            </select>
                        </div>
                    </td>
                    <td><?php echo $row['data_levantamento'] ? date('d/m/Y', strtotime($row['data_levantamento'])) : '---'; ?></td>
                    <td><?php echo $row['data_devolucao'] ? date('d/m/Y', strtotime($row['data_devolucao'])) : '---'; ?></td>
                    <td><i class="fa-regular fa-file-lines obs-icon" title="<?php echo htmlspecialchars($row['observacao']); ?>"></i></td>
                </tr>
                <?php 
                    endwhile; 
                } else {
                    echo "<tr><td colspan='8' style='text-align:center;'>Nenhum pedido encontrado na base de dados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleStatusMenu(badge) {
    const wrapper = badge.parentElement;
    wrapper.classList.toggle('active');
}

function updateStatus(select, id) {
    const badge = select.previousElementSibling;
    const newValue = select.value;
    const newText = select.options[select.selectedIndex].text;
    
    badge.textContent = newText;
    badge.className = 'status-badge ' + newValue.toLowerCase();
    select.parentElement.classList.remove('active');
    
    console.log("Atualizar pedido " + id + " para " + newValue);
}
</script>

<?php include '../templates/footer.php'; ?>