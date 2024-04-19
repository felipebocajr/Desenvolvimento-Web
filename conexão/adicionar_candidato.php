<?php
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $curriculo = $_FILES['curriculo'];


    $strcon = mysqli_connect("localhost","root","","sunsage_db") or die ("Erro ao conectar com o banco");

     // Inserir os dados do candidato na tabela candidato usando instrução preparada
    $sql_candidato = "INSERT INTO candidato (nome, email, CPF, numero_telefone) VALUES (?, ?, ?, ?)";
    $stmt_candidato = $strcon->prepare($sql_candidato);
    $stmt_candidato->bind_param("ssis", $nome, $email, $cpf, $telefone);
    $stmt_candidato->execute();
    $stmt_candidato->close();

    // Pegar o conteúdo do arquivo PDF
    $curriculo_blob = file_get_contents($_FILES['curriculo']['tmp_name']);

    // Inserir o PDF na tabela curriculo usando instrução preparada
    $sql_curriculo = "INSERT INTO curriculo (curriculo) VALUES (?)";
    $stmt_curriculo = $strcon->prepare($sql_curriculo);
    $stmt_curriculo->bind_param("b", $curriculo_blob);
    $stmt_curriculo->execute();
    $stmt_curriculo->close();

?>
