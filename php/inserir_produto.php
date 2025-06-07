<?php


$host = 'localhost';          
$dbname = 'construcao';     
$username = 'root';     
$password = 'root';       

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",  $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Dados recebidos do POST
    $nome = $_POST['nome'] ?? '';
    $categoria = $_POST['categoria'] ?? null;
    $estoque = $_POST['estoque'] ?? 0;
    $preco = $_POST['preco'] ?? null;
    $id_fornecedor = $_POST['id_fornecedor'] ?? null;

    if (empty($nome)) {
        echo "Erro: nome do produto é obrigatório.";
        exit;
    }

    $sql = "INSERT INTO produtos (nome, categoria, estoque, preco, id_fornecedor) VALUES (:nome, :categoria, :estoque, :preco, :id_fornecedor)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':categoria', $categoria);
    $stmt->bindValue(':estoque', $estoque, PDO::PARAM_INT);
    $stmt->bindValue(':preco', $preco);
    $stmt->bindValue(':id_fornecedor', $id_fornecedor, PDO::PARAM_INT);

    $stmt->execute();

    echo "Produto '$nome' inserido com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao inserir produto: " . $e->getMessage();
}
