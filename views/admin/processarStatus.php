<?php
require_once '../basedados/basedados.h';

// Receber os dados
$id = $_GET['id'];
$novo_estado = $_GET['novo_estado'];
$data_hoje = date('Y-m-d');

// Se o estado mudar para "Levantado", registamos a data de levantamento
$campos_extra = "";
if ($novo_estado == "Levantado") {
    $campos_extra = ", data_levantamento = '$data_hoje'";
} elseif ($novo_estado == "Terminada") {
    $campos_extra = ", data_devolucao = '$data_hoje'";
}

// LOGICA ADICIONADA: Se o estado deixar de ser "Inativa", limpamos a observação
$limpar_obs = "";
if ($novo_estado !== "Inativa") {
    $limpar_obs = ", observacao = ''";
}

// Atualizar a tabela requisicoes com a tua lógica original + limpeza de observação
$sql = "UPDATE requisicoes SET estado = '$novo_estado' $campos_extra $limpar_obs WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    // Volta para a página de gestão com sucesso
    header("Location: gestaoPedidos.php?msg=updated");
} else {
    echo "Erro ao atualizar: " . mysqli_error($conn);
}
?>