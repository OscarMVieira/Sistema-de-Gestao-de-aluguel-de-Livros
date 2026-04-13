<?php 
include '../templates/header.php'; 

require_once '../basedados/basedados.h'; 

$query = "SELECT r.*, u.username, l.Titulo_Livro, l.Autor_Livro 
          FROM requisicoes r
          JOIN users u ON r.user_id = u.id
          JOIN livros l ON r.livro_id = l.ID_Livro 
          ORDER BY r.data_pedido DESC";

$resultado = mysqli_query($conn, $query);
?>

<link rel="stylesheet" href="../../public/css/gestaoPedidos.css">

<div class="gestao-container">
    <h1 class="page-title">Gestão de Pedidos</h1>
    
    <div class="gestao-card">
        <h2 class="section-title">Lista de Requisições</h2>
        
        <table class="gestao-table">
            <thead>
                <tr>
                    <th>Pedido</th>
                    <th>Data Pedido</th>
                    <th>Livro</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                //Ciclo PHP para listar os pedidos da base de dados
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    while($row = mysqli_fetch_assoc($resultado)): 
                        $statusClass = strtolower($row['estado']);
                ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['data_pedido'])); ?></td>
                    
                    <td><?php echo htmlspecialchars($row['Titulo_Livro']); ?></td>
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
                    <td>
                        <i class="fa-regular fa-file-lines obs-icon" title="<?php echo htmlspecialchars($row['observacao']); ?>"></i>
                    </td>
                </tr>
                <?php 
                    endwhile; 
                } else {
                    // Mensagem caso a tabela esteja vazia ou a query falhe
                    echo "<tr><td colspan='6' style='text-align:center; padding: 20px;'>Nenhum pedido encontrado na base de dados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
// Função para abrir/fechar o menu de seleção
function toggleStatusMenu(badge) {
    badge.parentElement.classList.toggle('active');
}

//enviar a alteração para o processarStatus.php
function updateStatus(select, id) {
    const newValue = select.value;
    
    if(confirm("Deseja alterar o estado do pedido #" + id + " para " + newValue + "?")) {
        // Redireciona para o processador de status
        window.location.href = "processarStatus.php?id=" + id + "&novo_estado=" + newValue;
    } else {
        location.reload();
    }
}
</script>

<?php 
include '../templates/footer.php'; 
?>