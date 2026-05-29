<?php 
$activePage = 'catalogo'; 
include '../templates/header.php'; 
require_once '../basedados/basedados.h'; 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: paginaCatalogo.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM livros WHERE ID_Livro = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$livro = $resultado->fetch_assoc();

if (!$livro) {
    echo "<script>alert('Livro não encontrado!'); window.location.href='paginaCatalogo.php';</script>";
    exit();
}

$titulo = !empty($livro['Titulo_Livro']) ? htmlspecialchars($livro['Titulo_Livro']) : "Título Indisponível";
$autor  = !empty($livro['Autor_Livro']) ? htmlspecialchars($livro['Autor_Livro']) : "Autor Desconhecido";
$genero = !empty($livro['Genero']) ? htmlspecialchars($livro['Genero']) : "Sem Género";
$capa   = !empty($livro['Capa']) ? $livro['Capa'] : "default_cover.png"; 
?>

<link rel="stylesheet" href="../../public/css/detalhesLivro.css">

<div class="centralizador-pagina">
    <h1 class="tituloPagina"></h1>

    <div class="gradeInfo">
        <section class="caixaCard selecaoCapa">
            <h2 class="tituloCard">Capa</h2>
            <div class="bordaImagem">
                <img src="../../public/img/<?php echo $capa; ?>" alt="Capa">
            </div>
        </section>

        <section class="caixaCard detalhesLivro">
            <h2 class="tituloCardSublinhado">Informação Principal</h2>
            <div class="linhaForm">
                <div class="campoIndividual"><label>Título:</label>
                    <input type="text" value="<?php echo $titulo; ?>" readonly>
                </div>
                <div class="campoIndividual"><label>Género:</label>
                    <input type="text" value="<?php echo $genero; ?>" readonly>
                </div>
            </div>
            <div class="linhaForm">
                <div class="campoIndividual"><label>Autor:</label>
                    <input type="text" value="<?php echo $autor; ?>" readonly>
                </div>
                <div class="campoIndividual"><label>ID Interno:</label>
                    <input type="text" value="<?php echo $livro['ID_Livro']; ?>" readonly>
                </div>
            </div>
            <div class="containerCampos">
                <div class="campoIndividual"><label>Stock Atual:</label>
                    <input type="text" value="<?php echo $livro['Quantidade']; ?> unidades" readonly>
                </div>
                <div class="campoIndividual"><label>Estado:</label>
                    <input type="text" value="<?php echo ($livro['Quantidade'] > 0) ? 'Disponível' : 'Esgotado'; ?>" readonly>
                </div>
            </div>
        </section>
    </div>

    <div class="containerAcoesFinal">
        <a href="paginaEditarLivro.php?id=<?php echo $livro['ID_Livro']; ?>" class="btnAzulLargo">
            <i class="fa-solid fa-pen-to-square"></i> Editar Livro
        </a>
        <div class="grupoBotoesAcaoDireita">
            <a href="paginaCatalogo.php" class="btnAzulMedio">Voltar ao Catálogo</a>
        </div>
    </div>
</div>