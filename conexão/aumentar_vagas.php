<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();

    // Verifica se o administrador está logado
    if (!isset($_SESSION['id_administrador'])) {
        // Se o administrador não estiver logado, redireciona para a página de login
        header("Location: admin_login.php");
        exit();
    }

    // Inclui o arquivo de configuração do banco de dados
    $strcon = mysqli_connect("localhost", "root", "", "sunsage_db") or die("Erro ao conectar com o banco");

    // Obtém as informações das vagas do banco de dados
    $sql = "SELECT * FROM vaga";
    $result = mysqli_query($strcon, $sql);
    ?>

    <h1>Sunsage TechPower</h1>
    <?php
    // Verifica se há vagas cadastradas
    if (mysqli_num_rows($result) > 0) {
        // Início da tabela
        echo "<table>";
        echo "<tr><th>Nome da Vaga</th><th>Vagas Livres</th><th>Ação</th></tr>";

        // Loop através das linhas do resultado
        while ($row = mysqli_fetch_assoc($result)) {
            // Exibe as informações da vaga em cada linha da tabela
            echo "<tr>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td id='vagasLivres_" . $row['ID'] . "'>" . $row['vagas_livres'] . "</td>";
            echo "<td>";
            echo "<button onclick='aumentarVagas(" . $row['ID'] . ")'>Aumentar</button>";
            echo "<button onclick='diminuirVagas(" . $row['ID'] . ")'>Diminuir</button>";
            echo "</td>";
            echo "</tr>";
        }

        // Fim da tabela
        echo "</table>";
    } else {
        echo "Nenhuma vaga encontrada.";
    }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function aumentarVagas(vagaID) {
            // Solicitação AJAX para aumentar o número de vagas
            $.ajax({
                type: "POST",
                url: 'alterar_vagas_process.php', // Usa a mesma URL do arquivo atual
                data: {
                    vaga_id: vagaID,
                    action: 'aumentar'
                },
                success: function (response) {
                    // Atualiza o número de vagas livres na tabela
                    var vagasLivres = parseInt($("#vagasLivres_" + vagaID).text());
                    $("#vagasLivres_" + vagaID).text(vagasLivres + 1);
                }
            });
        }

        function diminuirVagas(vagaID) {
            // Solicitação AJAX para diminuir o número de vagas
            $.ajax({
                type: "POST",
                url: 'alterar_vagas_process.php', // Usa a mesma URL do arquivo atual
                data: {
                    vaga_id: vagaID,
                    action: 'diminuir'
                },
                success: function (response) {
                    // Atualiza o número de vagas livres na tabela
                    var vagasLivres = parseInt($("#vagasLivres_" + vagaID).text());
                    if (vagasLivres > 0) {
                        $("#vagasLivres_" + vagaID).text(vagasLivres - 1);
                    } else {
                        alert("Não é possível diminuir mais vagas.");
                    }
                }
            });
        }
    </script>
    <style>

        body {
            font-family: Arial, sans-serif;
        }
        
        h1 {
            text-align: center;
        }

        table {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: green;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        button {
            margin: 5px;
        }


        
    </style>
</body>

</html>