<?php
require_once '../basedados/basedados.h'; // Ligação à BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $quantidade = $_POST['quantidade'];

    // Lógica para verificar se foi enviada uma nova capa
    if (isset($_FILES['capa']) && $_FILES['capa']['error'] === 0) {
        $nomeImagem = $_FILES['capa']['name'];
        $caminhoDestino = "../../public/img/" . $nomeImagem;
        
        move_uploaded_file($_FILES['capa']['tmp_name'], $caminhoDestino);

        $sql = "UPDATE livros SET 
                Titulo_Livro = '$titulo', 
                Autor_Livro = '$autor', 
                Genero = '$genero', 
                Quantidade = '$quantidade', 
                Capa = '$nomeImagem' 
                WHERE ID_Livro = $id";
    } else {
        $sql = "UPDATE livros SET 
                Titulo_Livro = '$titulo', 
                Autor_Livro = '$autor', 
                Genero = '$genero', 
                Quantidade = '$quantidade' 
                WHERE ID_Livro = $id";
    }

    if ($conn->query($sql) === TRUE) {
        // PROTEÇÃO: Só envia 'editado=sucesso' se algo mudou mesmo na BD
        if ($conn->affected_rows > 0) {
            header("Location: paginaConsultarLivro.php?id=$id&editado=sucesso");
        } else {
            // Se os dados forem iguais aos antigos, volta sem mostrar a mensagem
            header("Location: paginaConsultarLivro.php?id=$id");
        }
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}

$conn->close();
?>