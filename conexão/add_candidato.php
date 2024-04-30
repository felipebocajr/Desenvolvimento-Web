<?php

// atribui em variáveis a requisição do POST dos dados do usuário
$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$vaga = $_POST['vaga'];
$curriculo = $_FILES['curriculo'];

//conexão com o banco de dados
$strcon = mysqli_connect("localhost", "root", "", "sunsage_db") or die("Erro ao conectar com o banco");

//prepara e executa uma query sql com o id da vaga escolhida
$query = "SELECT id FROM vaga WHERE id = ?";
$stmt = $strcon->prepare($query);
$stmt->bind_param("i", $vaga);
$stmt->execute();
$stmt->store_result();

//atribui a uma variável o caminho correto para o diretório com os currículos
$pasta = "curriculos/";
$nomeDoCurriculo = $curriculo["name"];
//cria um nome aleatório para o arquivo do currículo enviado
$novoNomeDoCurriculo = uniqid();
$extensao = strtolower(pathinfo($nomeDoCurriculo, PATHINFO_EXTENSION));

//recusa arquivos em que o formato não estjea em .PDF
if ($extensao != "pdf")
    die("Tipo de arquivo não aceito");

//indica a localização do currículo
$path = $pasta . $novoNomeDoCurriculo . "." . $extensao;

//envia o currículo para o caminho correto, caso apresente erro, indica o erro
$deu_certo = move_uploaded_file($curriculo["tmp_name"], $path);
if ($deu_certo) {
    echo "<p>Currículo enviado com sucesso<p>";
} else
    echo "Falha ao enviar o arquivo<br>";
echo "Erro: " . $_FILES['curriculo']['error'];

//inserir os dados pessoais na tabela 'candidato
$sql_candidato = "INSERT INTO candidato (nome, email, CPF, numero_telefone, paths) VALUES (?, ?, ?, ?, ?)";
$stmt_candidato = $strcon->prepare($sql_candidato);
$stmt_candidato->bind_param("sssss", $nome, $email, $cpf, $telefone, $path);
$stmt_candidato->execute();

//obter o ID do ultimo candidato inserido
$id_candidato = $stmt_candidato->insert_id;

// Decrementar o número de vagas livres
$sql_decrement_vagas = "UPDATE vaga SET vagas_livres = vagas_livres - 1 WHERE id = ?";
$stmt_decrement_vagas = $strcon->prepare($sql_decrement_vagas);
$stmt_decrement_vagas->bind_param("i", $vaga);
$stmt_decrement_vagas->execute();
$stmt_decrement_vagas->close();

$stmt_candidato->close(); 

//inserir na tabela relacional 'candidato_vaga' o ID do candidato e o ID da vaga que ele se candidatou
$sql_candidato_vaga = "INSERT INTO candidato_vaga (ID_candidato, ID_vaga) VALUES (?, ?)";
$stmt_candidato_vaga = $strcon->prepare($sql_candidato_vaga);
$stmt_candidato_vaga->bind_param("ii", $id_candidato, $vaga);
$stmt_candidato_vaga->execute();
$stmt_candidato_vaga->close();

?> 