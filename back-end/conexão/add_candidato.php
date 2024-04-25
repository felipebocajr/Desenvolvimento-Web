<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$curriculo = $_FILES['curriculo'];


$strcon = mysqli_connect("localhost", "root", "", "sunsage_db") or die("Erro ao conectar com o banco");

// Inserir os dados do candidato na tabela candidato usando instrução preparada

$pasta = "curriculos/";
$nomeDoCurriculo = $curriculo["name"];
$novoNomeDoCurriculo = uniqid();
$extensao = strtolower(pathinfo($nomeDoCurriculo, PATHINFO_EXTENSION));

if ($extensao != "pdf")
    die("Tipo de arquivo não aceito");

$path = $pasta . $novoNomeDoCurriculo . "." . $extensao;

$cpf = trim($cpf);

$deu_certo = move_uploaded_file($curriculo["tmp_name"], $path);
if ($deu_certo) {
    echo "<p>Currículo enviado com sucesso<p>";
} else
    echo "Falha ao enviar o arquivo<br>";
echo "Erro: " . $_FILES['curriculo']['error'];


$sql_candidato = "INSERT INTO candidato (nome, email, CPF, numero_telefone, paths) VALUES (?, ?, ?, ?, ?)";
$stmt_candidato = $strcon->prepare($sql_candidato);
$stmt_candidato->bind_param("sssss", $nome, $email, $cpf, $telefone, $path);
$stmt_candidato->execute();
$stmt_candidato->close();
?>