<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Candidato</title>
    <link rel="stylesheet" href="styles.css">

    <script>
        function validarCPF() {
            var cpfInput = document.getElementById("cpf");
            var cpf = cpfInput.value.replace(/[^\d]/g, ''); // Remove caracteres não numéricos
            if (cpf.length !== 11) {
                alert("CPF inválido. Por favor, insira um CPF com 11 dígitos.");
                return false; // Impede o envio do formulário
            }
            return true; // Permite o envio do formulário
        }
    </script>

</head>
<body>

<h2>Cadastro de Candidato</h2>

<form enctype="multipart/form-data" id="form-candidato" method="POST" action="add_candidato.php" enctype="multipart/form-data" onsubmit="return validarCPF()">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" onkey required><br>
    <label for="telefone">Telefone:</label>
    <input type="tel" id="telefone" name="telefone" required><br>
    <label for="curriculo">Currículo:</label>
    <input type="file" id="curriculo" name="curriculo" required accept=".pdf"><br>
    <button type="submit" name="submit">Enviar currículo</button>
</form>

</body>
</html>
