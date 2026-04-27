<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../templates/headerCliente.php'; 
require_once '../basedados/basedados.h'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/paginaLogin.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT r.*, l.Titulo_Livro, l.Autor_Livro 
          FROM requisicoes r
          JOIN livros l ON r.livro_id = l.ID_Livro 
          WHERE r.user_id = '$user_id'
          ORDER BY r.data_pedido DESC";

$resultado = mysqli_query($conn, $query);
?>

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
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                //Ciclo para mostrar cada pedido da base de dados
                if (mysqli_num_rows($resultado) > 0) {
                    while($row = mysqli_fetch_assoc($resultado)): 
                        $statusClass = strtolower($row['estado']);
                ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['data_pedido'])); ?></td>
                    <td><?php echo htmlspecialchars($row['Titulo_Livro']); ?></td>
                    <td><?php echo htmlspecialchars($row['Autor_Livro']); ?></td>
                    <td>
                        <span class="status-badge <?php echo $statusClass; ?>">
                            <?php echo $row['estado']; ?>
                        </span>
                    </td>
                </tr>
                <?php 
                    endwhile; 
                } else {
                    echo "<tr><td colspan='5' style='text-align:center;'>Ainda não fizeste nenhuma requisição.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="containerBotao">
        <a href="paginaCatalogo.php" class="btnVoltarLargo">Voltar</a>
    </div>
</div>

<?php include '../templates/footer.php'; ?>