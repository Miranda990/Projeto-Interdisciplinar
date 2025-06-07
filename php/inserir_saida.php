<?php

$host = 'localhost';          
$dbname = 'construcao';    
$username = 'root';     
$password = 'root';     

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",  $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id_produto = $_POST['id_produto'] ?? null;
    $quantidade = $_POST['quantidade'] ?? null;

    if (!$id_produto || !$quantidade || $quantidade <= 0) {
        echo "Erro: Produto e quantidade válidos são obrigatórios.";
        exit;
    }

    // Verifica estoque atual
    $sqlCheck = "SELECT estoque FROM produtos WHERE id_produto = :id_produto";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->bindValue(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmtCheck->execute();
    $produto = $stmtCheck->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        echo "Produto não encontrado.";
        exit;
    }

    if ($produto['estoque'] < $quantidade) {
        echo "Erro: Estoque insuficiente.";
        exit;
    }

    // Insere na tabela saidas_estoque
    $sql = "INSERT INTO saidas_estoque (id_produto, quantidade) VALUES (:id_produto, :quantidade)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
    $stmt->execute();

    // Atualiza o estoque do produto
    $sqlUpdate = "UPDATE produtos SET estoque = estoque - :quantidade WHERE id_produto = :id_produto";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
    $stmtUpdate->bindValue(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmtUpdate->execute();

    echo "Saída registrada e estoque atualizado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao registrar saída: " . $e->getMessage();
}
