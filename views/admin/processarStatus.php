<?php
require_once '../basedados/basedados.h';

// Receber os dados da URL
$id = $_GET['id'];
$novo_estado = $_GET['novo_estado'];
$data_hora_agora = date('Y-m-d H:i:s'); // Registo de data e hora exata

//Obter a informação atual da requisição para validar o stock
$query_info = "SELECT livro_id, estado FROM requisicoes WHERE id = $id";
$res_info = mysqli_query($conn, $query_info);
$req = mysqli_fetch_assoc($res_info);

$livro_id = $req['livro_id'];
$estado_antigo = $req['estado'];

$campos_extra = "";

//Registo de Saída (Levantado)
if ($novo_estado == "Levantado") {
    $campos_extra = ", data_levantamento = '$data_hora_agora'";
} 
// Registo de Devolução
elseif ($novo_estado == "Terminada") {
    $campos_extra = ", data_devolucao = '$data_hora_agora'";
}

// Apenas atualizamos o stock se o estado passar a ser "Terminada" pela primeira vez
if ($novo_estado == "Terminada" && $estado_antigo !== "Terminada") {
    // Soma +1 à quantidade e garante que a Disponibilidade volta a 1 (True)
    $sql_stock = "UPDATE livros SET Quantidade = Quantidade + 1, Disponibilidade = 1 WHERE ID_Livro = $livro_id";
    mysqli_query($conn, $sql_stock);
}

// Lógica para limpar a observação se o estado deixar de ser "Inativa"
$limpar_obs = "";
if ($novo_estado !== "Inativa") {
    $limpar_obs = ", observacao = ''";
}

// Atualizar a tabela requisicoes com base na tua estrutura
$sql = "UPDATE requisicoes SET estado = '$novo_estado' $campos_extra $limpar_obs WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    // Volta para a página de gestão com sinal de sucesso
    header("Location: gestaoPedidos.php?msg=updated");
} else {
    echo "Erro ao atualizar: " . mysqli_error($conn);
}
?>