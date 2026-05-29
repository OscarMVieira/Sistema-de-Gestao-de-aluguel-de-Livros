<?php
require_once '../basedados/basedados.h'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $quantidade = intval($_POST['quantidade']);

    $disponibilidade = ($quantidade > 0) ? 1 : 0;

    if (isset($_FILES['capa']) && $_FILES['capa']['error'] === 0) {
        $nomeImagem = $_FILES['capa']['name'];
        $caminhoDestino = "../../public/img/" . $nomeImagem;
        
        move_uploaded_file($_FILES['capa']['tmp_name'], $caminhoDestino);

        $sql = "UPDATE livros SET 
                Titulo_Livro = '$titulo', 
                Autor_Livro = '$autor', 
                Genero = '$genero', 
                Quantidade = $quantidade, 
                Disponibilidade = $disponibilidade,
                Capa = '$nomeImagem' 
                WHERE ID_Livro = $id";
    } else {
        $sql = "UPDATE livros SET 
                Titulo_Livro = '$titulo', 
                Autor_Livro = '$autor', 
                Genero = '$genero', 
                Quantidade = $quantidade,
                Disponibilidade = $disponibilidade
                WHERE ID_Livro = $id";
    }

    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            header("Location: paginaConsultarLivro.php?id=$id&editado=sucesso");
        } else {
            header("Location: paginaConsultarLivro.php?id=$id");
        }
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}

$conn->close();
?>