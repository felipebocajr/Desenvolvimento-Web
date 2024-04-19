<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];

$strcon = mysqli_connect("localhost","root","","sunsage_db") or die ("Erro ao conectar com o banco");

// Inserir os dados do candidato na tabela candidato usando instrução preparada
$sql_candidato = "INSERT INTO candidato (nome, email, CPF, numero_telefone) VALUES (?, ?, ?, ?)";
$stmt_candidato = $strcon->prepare($sql_candidato);
$stmt_candidato->bind_param("ssis", $nome, $email, $cpf, $telefone);
$stmt_candidato->execute();
$stmt_candidato->close();

// Enviar o currículo para a pasta de currículos e inserir o caminho na tabela curriculo
$curriculo = $_FILES['curriculo'];

$pasta = "curriculos/";
$nomeDoCurriculo = $curriculo["name"];
$novoNomeDoCurriculo = uniqid();
$extensao = strtolower(pathinfo($nomeDoCurriculo, PATHINFO_EXTENSION));

if ($extensao != "pdf")
die("Tipo de arquivo não aceito");

$deu_certo = move_uploaded_file($curriculo["tmp_name"], $pasta. $novoNomeDoCurriculo . "." . $extensao);
if($deu_certo)
    echo "<p>Currículo enviado com sucesso";
else
    echo "Falha ao enviar o arquivo"

?>
    
</body>
</html>