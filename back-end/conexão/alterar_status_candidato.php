<?php
// Conexão com o banco de dados (substitua pelos seus dados de conexão)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sunsage_db";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber o ID do candidato e o novo status enviado via AJAX
$candidatoID = $_POST['candidatoID'];
$novoStatus = $_POST['novoStatus'];

// Atualizar o campo 'status' no banco de dados
$sql = "UPDATE candidato SET situacao='$novoStatus' WHERE id=$candidatoID"; // Usando o ID do candidato recebido
if ($conn->query($sql) === TRUE) {
    echo "Status alterado com sucesso!";
} else {
    echo "Erro ao alterar status: " . $conn->error;
}

$conn->close();

?>
