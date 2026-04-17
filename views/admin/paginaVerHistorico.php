<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../basedados/basedados.h'; 

$id_utilizador = isset($_GET['id']) ? intval($_GET['id']) : 0;

$nome_utilizador = "Utilizador";
if ($id_utilizador > 0) {
    $sql_user = "SELECT username FROM users WHERE id = $id_utilizador;";
    $res_user = mysqli_query($conn, $sql_user);
    if ($res_user && $user_data = mysqli_fetch_assoc($res_user)) {
        $nome_utilizador = $user_data['username'];
    }
}

$query = "SELECT l.Titulo_Livro, r.data_pedido, r.data_devolucao, r.estado 
          FROM requisicoes r 
          JOIN livros l ON r.livro_id = l.ID_Livro 
          WHERE r.user_id = $id_utilizador 
          ORDER BY r.data_pedido DESC;";
$resultado = mysqli_query($conn, $query);

$lista_historico = [];
if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $lista_historico[] = $row;
    }
}
?>

<?php include '../templates/header.php'; ?>

<link rel="stylesheet" href="../../public/css/paginaHistorico.css">

<section class="seccaoHistorico">
    <div class="containerHistorico">
        
        <h1 class="tituloHistorico">Histórico: <?php echo htmlspecialchars($nome_utilizador); ?></h1>

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
                    <?php if (count($lista_historico) > 0) { ?>
                        <?php foreach ($lista_historico as $item) { 
                            $d_req = date("d/m/Y", strtotime($item['data_pedido']));
                            $d_ent = (!empty($item['data_devolucao']) && $item['data_devolucao'] != '0000-00-00') 
                                     ? date("d/m/Y", strtotime($item['data_devolucao'])) 
                                     : "Pendente";
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['Titulo_Livro']); ?></td>
                                <td><?php echo $d_req; ?></td>
                                <td><?php echo $d_ent; ?></td>
                                <td><?php echo htmlspecialchars($item['estado']); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4" style="padding: 30px;">Este utilizador não tem registos no histórico.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="areaBotoes">
            <a href="../admin/gerirClientes.php" class="botaoVoltar">Voltar</a>
        </div>

    </div>
</section>

<?php include '../templates/footer.php'; ?>