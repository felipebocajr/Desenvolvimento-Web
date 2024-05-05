<?php
// conexão com o banco de dados 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sunsage_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// recebe o ID do candidato e o novo status enviado via AJAX
$candidatoID = $_POST['candidatoID'];
$novoStatus = $_POST['novoStatus'];

// atualiza o campo 'status' no banco de dados
$sql = "UPDATE candidato SET situacao='$novoStatus' WHERE id=$candidatoID"; // usando o ID do candidato recebido
if ($conn->query($sql) === TRUE) {
    echo $novoStatus; // envia o novo status de volta para o JavaScript
} else {
    echo "Erro ao alterar status: " . $conn->error;
}

$conn->close();

?>