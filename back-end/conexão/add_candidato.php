<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$vaga = $_POST['vaga'];
$curriculo = $_FILES['curriculo'];



$strcon = mysqli_connect("localhost", "root", "", "sunsage_db") or die("Erro ao conectar com o banco");

$pasta = "curriculos/";
$nomeDoCurriculo = $curriculo["name"];
$novoNomeDoCurriculo = uniqid();
$extensao = strtolower(pathinfo($nomeDoCurriculo, PATHINFO_EXTENSION));

if ($extensao != "pdf")
    die("Tipo de arquivo não aceito");

$path = $pasta . $novoNomeDoCurriculo . "." . $extensao;

$cpf = preg_replace('/[^0-9]/', '', $cpf);

$deu_certo = move_uploaded_file($curriculo["tmp_name"], $path);
if ($deu_certo) {
    echo "<p>Currículo enviado com sucesso<p>";
} else
    echo "Falha ao enviar o arquivo<br>";
echo "Erro: " . $_FILES['curriculo']['error'];

//inserir na tabela 'candidato'
$sql_candidato = "INSERT INTO candidato (nome, email, CPF, numero_telefone, paths) VALUES (?, ?, ?, ?, ?)";
$stmt_candidato = $strcon->prepare($sql_candidato);
$stmt_candidato->bind_param("sssss", $nome, $email, $cpf, $telefone, $path);
$stmt_candidato->execute();

//obter o ID do ultimo candidato inserido
$id_candidato = $stmt_candidato->insert_id;

$stmt_candidato->close(); 

//inserir na tabela 'candidato_vaga'
$sql_candidato_vaga = "INSERT INTO candidato_vaga (ID_candidato, ID_vaga) VALUES (?, ?)";
$stmt_candidato_vaga = $strcon->prepare($sql_candidato_vaga);
$stmt_candidato_vaga->bind_param("ii", $id_candidato, $vaga);
$stmt_candidato_vaga->execute();
$stmt_candidato_vaga->close();

?>