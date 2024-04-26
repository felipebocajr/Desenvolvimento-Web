<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Candidato</title>
    <link rel="stylesheet" href="styles.css">

</head>

<body>

    <h2>Cadastro de Candidato</h2>

    <form enctype="multipart/form-data" id="form-candidato" method="POST" action="add_candidato.php"
        enctype="multipart/form-data" onsubmit="return validarCPF()">
        <label for="vaga">Vaga:</label>
        <select class = "vaga" id="vaga" name="vaga" required>
    <option value="">Selecione a vaga</option>

    <?php
    $conexao = new mysqli('localhost', 'root', '', 'sunsage_db');
    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }

    $query = "SELECT id, nome FROM vaga";
    $result = $conexao->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
        }
    } else {
        echo "<option disabled>Nenhuma vaga disponível</option>";
    }

    $conexao->close();
    ?>

</select>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required><br>
        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required><br>
        <label for="curriculo">Currículo:</label>
        <input type="file" id="curriculo" name="curriculo" required accept=".pdf"><br>
        <button type="submit" name="submit">Enviar currículo</button>
    </form>

    <script>
        function validarCPF() {
            var cpfInput = document.getElementById("cpf");
            var cpf = cpfInput.value.replace(/[^\d]/g, '');

            if (cpf.length !== 11 || cpfInput.value !== cpf) {
                alert("CPF inválido. Por favor, insira um CPF válido.");
                cpfInput.value = cpf;
                return false;
            }

            return true;
        }

        document.addEventListener("DOMContentLoaded", function () {
            var cpfInput = document.getElementById("cpf");
            cpfInput.addEventListener("input", function () {
                var sanitizedValue = this.value.replace(/[^\d]/g, '');
                this.value = sanitizedValue.slice(0, 11);
            });
        });

    </script>



</body>

</html>