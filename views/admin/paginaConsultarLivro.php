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

<div class="centralizador-pagina">
    <h1 class="tituloPagina">Informações Livro</h1>

    <div class="gradeInfo">
        <section class="caixaCard selecaoCapa">
            <h2 class="tituloCard">Capa</h2>
            <div class="bordaImagem">
                <img src="../../public/img/<?php echo $livro['Capa']; ?>" alt="Capa">
            </div>
        </section>

        <section class="caixaCard detalhesLivro">
            <h2 class="tituloCardSublinhado">Informação Principal</h2>
            <div class="linhaForm">
                <input type="text" value="<?php echo htmlspecialchars($livro['Titulo_Livro']); ?>" readonly>
                <input type="text" value="<?php echo htmlspecialchars($livro['Genero']); ?>" readonly>
            </div>
            <div class="linhaForm">
                <input type="text" value="<?php echo htmlspecialchars($livro['Autor_Livro']); ?>" readonly>
                <input type="text" value="<?php echo $livro['ID_Livro']; ?>" readonly>
            </div>
            <div class="containerCampos">
                <div class="campoIndividual"><label>Data:</label><input type="text" value="--" readonly></div>
                <div class="campoIndividual"><label>Preço:</label><input type="text" value="--" readonly></div>
                <div class="campoIndividual"><label>Qtd:</label><input type="text" value="<?php echo $livro['Quantidade']; ?>" readonly></div>
            </div>
        </section>
    </div>

    <div class="containerAcoesFinal">
        <a href="paginaEditarLivro.php?id=<?php echo $livro['ID_Livro']; ?>" class="btnAzulLargo">
            <i class="fa-solid fa-pen-to-square"></i> Editar Livro
        </a>
        
        <div class="grupoBotoesAcaoDireita">
            <a href="paginaCatalogo.php" class="btnAzulMedio">Voltar</a>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Captura os parâmetros da URL
const urlParams = new URLSearchParams(window.location.search);

if (urlParams.get('editado') === 'sucesso') {
    Swal.fire({
        icon: 'success',
        title: 'Livro Atualizado!',
        text: 'As alterações foram gravadas com sucesso.',
        confirmButtonColor: '#004080',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            // Limpa o parâmetro da URL para não repetir o alerta no refresh
            const idLivro = urlParams.get('id');
            const novaUrl = window.location.pathname + "?id=" + idLivro;
            window.history.replaceState({}, document.title, novaUrl);
        }
    });
}
</script>
<?php include '../templates/footer.php'; ?>