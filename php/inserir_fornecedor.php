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
    $cnpj = $_POST['cnpj'] ?? '';
    $telefone = $_POST['telefone'] ?? null;
    $email = $_POST['email'] ?? null;

    if (empty($nome) || empty($cnpj)) {
        echo "Erro: nome e CNPJ são obrigatórios.";
        exit;
    }

    $sql = "INSERT INTO fornecedores (nome, cnpj, telefone, email) VALUES (:nome, :cnpj, :telefone, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':cnpj', $cnpj);
    $stmt->bindValue(':telefone', $telefone);
    $stmt->bindValue(':email', $email);

    $stmt->execute();

    echo "Fornecedor '$nome' inserido com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao inserir fornecedor: " . $e->getMessage();
}
