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

<form id="form-candidato" method="POST" action="adicionar_candidato.php" enctype="multipart/form-data">
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
    <button type="submit" name="submit">Enviar</button>
</form>

</body>
</html>
