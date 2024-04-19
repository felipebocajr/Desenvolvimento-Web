<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Conexão com o banco de dados
    include_once 'config.php';

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $curriculo_nome = $_FILES['curriculo']['name'];
    $curriculo_tmp = $_FILES['curriculo']['tmp_name'];
    $vaga_id = 1; // Valor da vaga desejada

    $curriculo_destino = 'curriculos/' . $curriculo_nome;
    move_uploaded_file($curriculo_tmp, $curriculo_destino);

    $sql = "INSERT INTO Candidatos (nome, email, cpf, numero_telefone, vaga_id, curriculo_id) VALUES ('$nome', '$email', '$cpf', '$telefone', '$vaga_id', '$curriculo_destino')";
    if ($conn->query($sql) === TRUE) {
        echo "Candidato cadastrado com sucesso.";
    } else {
        echo "Erro ao cadastrar candidato: " . $conn->error;
    }

    $conn->close();
}
?>
