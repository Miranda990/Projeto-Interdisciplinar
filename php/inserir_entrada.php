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

    // Insere na tabela entradas_estoque
    $sql = "INSERT INTO entradas_estoque (id_produto, quantidade) VALUES (:id_produto, :quantidade)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
    $stmt->execute();

    // Atualiza o estoque do produto
    $sqlUpdate = "UPDATE produtos SET estoque = estoque + :quantidade WHERE id_produto = :id_produto";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
    $stmtUpdate->bindValue(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmtUpdate->execute();

    echo "Entrada registrada e estoque atualizado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao registrar entrada: " . $e->getMessage();
}
