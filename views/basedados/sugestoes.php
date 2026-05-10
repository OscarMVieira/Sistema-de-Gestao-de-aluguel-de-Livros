<?php
require_once 'basedados.h'; 

$termo = $_GET['q'] ?? '';
$sugestoes = [];

if (strlen($termo) >= 1) {
    
    $stmt = $conn->prepare("SELECT ID_Livro, Titulo_Livro FROM livros WHERE Titulo_Livro LIKE ? LIMIT 5");
    
    $busca = "%$termo%";
    $stmt->bind_param("s", $busca);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $sugestoes[] = [
            'id' => $row['ID_Livro'],
            'titulo' => $row['Titulo_Livro']
        ];
    }
    $stmt->close();
}

echo json_encode($sugestoes); 
?>