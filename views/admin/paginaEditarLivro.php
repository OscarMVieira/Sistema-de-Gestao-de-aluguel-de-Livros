<?php 
$activePage = 'catalogo'; 
include '../templates/header.php'; 
require_once '../basedados/basedados.h'; 

$id = $_GET['id'];

$sql = "SELECT * FROM livros WHERE ID_Livro = $id";
$resultado = $conn->query($sql);
$livro = $resultado->fetch_assoc();
?>

<link rel="stylesheet" href="../../public/css/detalhesLivro.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="centralizador-pagina">
    <h1 class="tituloPagina">Editar Livro</h1>

    <form action="processaEdicao.php" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="<?php echo $livro['ID_Livro']; ?>">

        <div class="gradeInfo">
            <section class="caixaCard selecaoCapa">
                <h2 class="tituloCard">Editar Capa</h2>
                <p class="textoUpload">Upload Capa</p>
                <div class="bordaImagem">
                    <img src="../../public/img/<?php echo $livro['Capa']; ?>" alt="Capa">
                </div>
                <input type="file" name="capa" style="margin-top: 10px;">
            </section>

            <section class="caixaCard detalhesLivro">
                <h2 class="tituloCardSublinhado">Informação Principal</h2>
                <div class="linhaForm">
                    <input type="text" name="titulo" value="<?php echo htmlspecialchars($livro['Titulo_Livro']); ?>">
                    <input type="text" name="genero" value="<?php echo htmlspecialchars($livro['Genero']); ?>">
                </div>
                <div class="linhaForm">
                    <input type="text" name="autor" value="<?php echo htmlspecialchars($livro['Autor_Livro']); ?>">
                    <input type="text" value="<?php echo $livro['ID_Livro']; ?>" readonly>
                </div>
                <div class="containerCampos">
                    <div class="campoIndividual"><label>Data:</label><input type="text" name="data" value="--"></div>
                    <div class="campoIndividual"><label>Preço:</label><input type="text" name="preco" value="--"></div>
                    <div class="campoIndividual"><label>Qtd:</label><input type="text" name="quantidade" value="<?php echo $livro['Quantidade']; ?>"></div>
                </div>
            </section>
        </div>

        <div class="containerAcoesFinal">
            <button type="submit" class="btnAzulLargo">Editar Livro</button>
            
            <div class="grupoBotoesAcaoDireita">
                <button type="reset" class="btnAzulMedio">Limpar Formulário</button>
                <a href="paginaConsultarLivro.php?id=<?php echo $id; ?>" class="btnAzulMedio">Voltar</a>
            </div>
        </div>
    </form> 
</div>

<?php include '../templates/footer.php'; ?>