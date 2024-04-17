<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Candidatos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h2>Gerenciamento de Candidatos</h2>

<table id="candidatos-table">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CPF</th>
        <th>Email</th>
        <th>Número de Telefone</th>
        <th>Ações</th>
    </tr>
    <?php
    // Conexão com o banco de dados
    include_once 'config.php';

    $sql = "SELECT * FROM Candidatos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nome"] . "</td>";
            echo "<td>" . $row["cpf"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["telefone"] . "</td>";
            echo "<td><button onclick='updateCandidate(" . $row["id"] . ")'>Atualizar</button> <button onclick='deleteCandidate(" . $row["id"] . ")'>Excluir</button></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Nenhum candidato encontrado.</td></tr>";
    }
    $conn->close();
    ?>
</table>

<div id="update-form" style="display: none;">
    <!-- Formulário de atualização -->
</div>

<script src="script.js"></script>

</body>
</html>
