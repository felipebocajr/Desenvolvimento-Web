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
            <th>Currículo</th>
            <th>Situação atual</th>
            <th>Atualizar situação</th>
            <th>Ações</th>
        </tr>

        <?php
        // Conexão com o banco de dados
        $strcon = mysqli_connect("localhost", "root", "", "sunsage_db") or die("Erro ao conectar com o banco");

        $sql = "SELECT * FROM candidato";
        $result = $strcon->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . $row["nome"] . "</td>";
                echo "<td>" . $row["CPF"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["numero_telefone"] . "</td>";
                echo "<td><button onclick='viewPDF(\"" . $row["paths"] . "\")'>Visualizar PDF</button> </td>";
                echo "<td class = 'situ'>" . $row["situacao"] . "</td>";
                echo "<td class = 'alterarsitu'>";
                echo "<button onclick='aprovarCurriculo()'>Aprovar</button>";
                echo "<button onclick='reprovarCurriculo()'>Reprovar</button>";
                echo "<button onclick='curriculoEmAnalise()'>Em Análise</button>";
                echo "</td>";
                echo "<td><button onclick='updateCandidate(" . $row["ID"] . ")'>Atualizar</button> </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum candidato encontrado.</td></tr>";
        }
        ?>
    </table>

    <div id="update-form" style="display: none;">
        <!-- Formulário de atualização -->
    </div>

    <script src="script.js"></script>

</body>

</html>