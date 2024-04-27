<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Candidatos</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <h2>Gerenciamento de Candidatos</h2>

    <table id="candidatos-table">
        <tr class = 'tabletop'>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Número de Telefone</th>
            <th>Currículo</th>
            <th>Situação atual</th>
            <th>Vaga</th>
            <th>Atualizar situação</th>
        </tr>

        <?php
        // Conexão com o banco de dados
        $strcon = mysqli_connect("localhost", "root", "", "sunsage_db") or die("Erro ao conectar com o banco");

        $sql = "SELECT candidato.*, vaga.nome AS nome_vaga FROM candidato 
        JOIN candidato_vaga ON candidato.ID = candidato_vaga.ID_candidato
        JOIN vaga ON candidato_vaga.ID_vaga = vaga.id";

        $result_info = $strcon->query($sql);        $result_info = $strcon->query($sql);

        if ($result_info->num_rows > 0) {
            while ($row = $result_info->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . $row["nome"] . "</td>";
                echo "<td>" . $row["CPF"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["numero_telefone"] . "</td>";
                echo "<td><button onclick='viewPDF(\"" . $row["paths"] . "\")'>Visualizar PDF</button> </td>";
                echo "<td id='situacao-" . $row["ID"] . "'>" . $row["situacao"] . "</td>";
                echo "<td>" . $row["nome_vaga"] . "</td>"; // Exibe o nome da vaga
                echo "<td class='alterarsitu'>";
                echo "<select class='statusSelect' data-candidato-id='" . $row["ID"] . "'>";
                echo "<option value='aprovado'>aprovado</option>";
                echo "<option value='reprovado'>reprovado</option>";
                echo "<option value='em analise'>Em análise</option>";
                echo "</select>";
                echo "<button class='btn-atualizar' onclick='alterarsituacao(" . $row["ID"] . ")'>Atualizar</button>"; 
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum candidato encontrado.</td></tr>";
        }
        ?>
    </table>

    <div id="_info$result_infado"></div>

    <script>
        function alterarsituacao(candidatoID) {
            var novoStatus = $(".statusSelect[data-candidato-id='" + candidatoID + "']").val();

            $.ajax({
                type: "POST",
                url: "alterar_status_candidato.php",
                data: { candidatoID: candidatoID, novoStatus: novoStatus},
                success: function (response) {
                    $("#situacao-" + candidatoID).html(response); // Atualize a exibição com o novo status
                }

            });
        }
    </script>


    <div id="update-form" style="display: none;">
        <!-- Formulário de atualização -->
    </div>

    <script src="script.js"></script>

</body>

</html>