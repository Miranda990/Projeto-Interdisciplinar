<?php

$host = 'localhost';
$dbname = 'construcao';
$username = 'root';
$password = 'root';

// Criar conexão usando MySQLi
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Dados recebidos do POST
$nome = $_POST['nome'] ?? '';
$cnpj = $_POST['cnpj'] ?? '';
$telefone = $_POST['telefone'] ?? null;
$email = $_POST['email'] ?? null;

// Validação básica
if (empty($nome) || empty($cnpj)) {
    echo "Erro: nome e CNPJ são obrigatórios.";
    exit;
}

// Preparar e executar a query
$sql = "INSERT INTO fornecedores (nome, cnpj, telefone, email) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssss", $nome, $cnpj, $telefone, $email);

    if ($stmt->execute()) {
        echo "Fornecedor '$nome' inserido com sucesso!";
    } else {
        echo "Erro ao inserir fornecedor: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Erro ao preparar statement: " . $conn->error;
}

// Fechar conexão
$conn->close();
?>
