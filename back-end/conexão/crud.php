<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    function createAdmin($nome_usuario, $senha, $email_id, $nome, $data_criacao, $vaga_id)
    {
        global $conn;
        $sql = "INSERT INTO Administradores (nome_usuario, senha, email_id, nome, data_criacao, vaga_id)
            VALUES ('$nome_usuario', '$senha', '$email_id', '$nome', '$data_criacao', '$vaga_id')";
        if ($conn->query($sql) === TRUE) {
            echo "Administrador criado com sucesso.";
        } else {
            echo "Erro ao criar o administrador: " . $conn->error;
        }
    }

    // Função para ler todos os administradores
    function readAdmins()
    {
        global $conn;
        $sql = "SELECT * FROM Administradores";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"] . " - Nome: " . $row["nome"] . "<br>";
            }
        } else {
            echo "Nenhum administrador encontrado.";
        }
    }

    // Função para atualizar um administrador
    function updateAdmin($id, $nome_usuario, $senha, $email_id, $nome, $data_criacao, $vaga_id)
    {
        global $conn;
        $sql = "UPDATE Administradores SET nome_usuario='$nome_usuario', senha='$senha', email_id='$email_id', nome='$nome', data_criacao='$data_criacao', vaga_id='$vaga_id' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Administrador atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar o administrador: " . $conn->error;
        }
    }

    // Função para excluir um administrador
    function deleteAdmin($id)
    {
        global $conn;
        $sql = "DELETE FROM Administradores WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Administrador excluído com sucesso.";
        } else {
            echo "Erro ao excluir o administrador: " . $conn->error;
        }
    }

    // Função para criar uma vaga
    function createVaga($nome, $quantidade, $administrador_id)
    {
        global $conn;
        $sql = "INSERT INTO Vagas (nome, quantidade, administrador_id)
            VALUES ('$nome', '$quantidade', '$administrador_id')";
        if ($conn->query($sql) === TRUE) {
            echo "Vaga criada com sucesso.";
        } else {
            echo "Erro ao criar a vaga: " . $conn->error;
        }
    }

    // Função para ler todas as vagas
    function readVagas()
    {
        global $conn;
        $sql = "SELECT * FROM Vagas";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"] . " - Nome: " . $row["nome"] . "<br>";
            }
        } else {
            echo "Nenhuma vaga encontrada.";
        }
    }

    // Função para atualizar uma vaga
    function updateVaga($id, $nome, $quantidade, $administrador_id)
    {
        global $conn;
        $sql = "UPDATE Vagas SET nome='$nome', quantidade='$quantidade', administrador_id='$administrador_id' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Vaga atualizada com sucesso.";
        } else {
            echo "Erro ao atualizar a vaga: " . $conn->error;
        }
    }

    // Função para excluir uma vaga
    function deleteVaga($id)
    {
        global $conn;
        $sql = "DELETE FROM Vagas WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Vaga excluída com sucesso.";
        } else {
            echo "Erro ao excluir a vaga: " . $conn->error;
        }
    }

    // Função para criar um candidato
    function createCandidato($nome, $cpf, $email, $numero_telefone, $vaga_id, $curriculo_id)
    {
        global $conn;
        $sql = "INSERT INTO Candidatos (nome, cpf, email, numero_telefone, vaga_id, curriculo_id)
            VALUES ('$nome', '$cpf', '$email', '$numero_telefone', '$vaga_id', '$curriculo_id')";
        if ($conn->query($sql) === TRUE) {
            echo "Candidato criado com sucesso.";
        } else {
            echo "Erro ao criar o candidato: " . $conn->error;
        }
    }

    // Função para ler todos os candidatos
    function readCandidatos()
    {
        global $conn;
        $sql = "SELECT * FROM Candidatos";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"] . " - Nome: " . $row["nome"] . "<br>";
            }
        } else {
            echo "Nenhum candidato encontrado.";
        }
    }

    // Função para atualizar um candidato
    function updateCandidato($id, $nome, $cpf, $email, $numero_telefone, $vaga_id, $curriculo_id)
    {
        global $conn;
        $sql = "UPDATE Candidatos SET nome='$nome', cpf='$cpf', email='$email', numero_telefone='$numero_telefone', vaga_id='$vaga_id', curriculo_id='$curriculo_id' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Candidato atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar o candidato: " . $conn->error;
        }
    }

    // Função para excluir um candidato
    function deleteCandidato($id)
    {
        global $conn;
        $sql = "DELETE FROM Candidatos WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Candidato excluído com sucesso.";
        } else {
            echo "Erro ao excluir o candidato: " . $conn->error;
        }
    }

    // Função para criar um currículo
    function createCurriculo($curriculo, $data_envio)
    {
        global $conn;
        $sql = "INSERT INTO Curriculos (curriculo, data_envio)
            VALUES ('$curriculo', '$data_envio')";
        if ($conn->query($sql) === TRUE) {
            echo "Currículo criado com sucesso.";
        } else {
            echo "Erro ao criar o currículo: " . $conn->error;
        }
    }

    // Função para ler currículos
    function readCurriculos()
    {
        global $conn;
        $sql = "SELECT * FROM Curriculos";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"] . " - Data de Envio: " . $row["data_envio"] . "<br>";
            }
        } else {
            echo "Nenhum currículo encontrado.";
        }
    }

    // Função para atualizar um currículo
    function updateCurriculo($id, $curriculo, $data_envio)
    {
        global $conn;
        $sql = "UPDATE Curriculos SET curriculo='$curriculo', data_envio='$data_envio' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Currículo atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar o currículo: " . $conn->error;
        }
    }

    // Função para excluir um currículo
    function deleteCurriculo($id)
    {
        global $conn;
        $sql = "DELETE FROM Curriculos WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Currículo excluído com sucesso.";
        } else {
            echo "Erro ao excluir o currículo: " . $conn->error;
        }
    }
    ?>
</body>

</html>