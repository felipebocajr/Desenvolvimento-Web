<?php
session_start();

// verifica se o administrador está logado; caso contrário, retorna para admin_login.php
if (!isset($_SESSION['id_administrador'])) {
    header("Location: admin_login.php");
    exit();
}

// atribui a uma variável o nome do administrador
$nome_administrador = $_SESSION['nome_administrador'];

// Inclui o arquivo de configuração do banco de dados
$strcon = mysqli_connect("localhost", "root", "", "sunsage_db") or die("Erro ao conectar com o banco");

// atribui o id do administrador
$id_administrador_logado = $_SESSION['id_administrador'];

// conexão com o banco de dados
$strcon = mysqli_connect("localhost", "root", "", "sunsage_db") or die("Erro ao conectar com o banco");

// atribui a uma variável a query sql com os candidatos que pertencem as vagas de cada administrador
$sql = "SELECT candidato.*, vaga.nome AS nome_vaga 
        FROM candidato 
        JOIN candidato_vaga ON candidato.ID = candidato_vaga.ID_candidato
        JOIN vaga ON candidato_vaga.ID_vaga = vaga.ID
        JOIN administrador_vaga ON vaga.ID = administrador_vaga.ID_vaga
        WHERE administrador_vaga.ID_administrador = ?";

// preparação e execução da query sql
$stmt = $strcon->prepare($sql);
$stmt->bind_param("i", $id_administrador_logado);
$stmt->execute();
$result = $stmt->get_result();

// cria um array multidimensional com informação dos candidatos
$candidatos = array();

// cria as variáveis com o total de candidatos, e total de aprovados, reprovados e em análise
$totalCandidatos = 0;
$totalAprovados = 0;
$totalReprovados = 0;
$totalEmAnalise = 0;

// loop while para imprimir na tabela os dados do candidato enquanto houver candidatos na query
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // atribui as informações do candidato ao array multidimensional
        $candidato = array(
            'ID' => $row["ID"],
            'nome' => $row["nome"],
            'CPF' => $row["CPF"],
            'email' => $row["email"],
            'numero_telefone' => $row["numero_telefone"],
            'paths' => $row["paths"],
            'situacao' => $row["situacao"],
            'nome_vaga' => $row["nome_vaga"]
        );

        // insere o candidato ao array de candidatos
        $candidatos[] = $candidato;

        // incrementa o contador de candidatos
        $totalCandidatos++;

        // incrementa os contadores de acordo com a situação do candidato
        if ($row["situacao"] == "aprovado") {
            $totalAprovados++;
        } elseif ($row["situacao"] == "reprovado") {
            $totalReprovados++;
        } elseif ($row["situacao"] == "em analise") {
            $totalEmAnalise++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Candidatos</title>
    <link rel="stylesheet" href="CSS/admin_styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
</head>

<body>
    <h1>Gerenciamento de Candidatos<h1>
            <h3>SunSage TechPower</h3>

            <div class='bemvindo'>
                Bem-vindo(a) <div class='nomeadmin'><?php echo ", " . $nome_administrador; ?>!</div>
                <div class='adicionarvagas'>
                    <a href="aumentar_vagas.php" class='botaodireita'>Aumentar número de vagas disponíveis</a>
                </div>
            </div>

            <table id="candidatos-table">
                <tr class='tabletop'>
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
                // loop for para imprimir na tabela os dados do candidato enquanto houver candidatos no array
                for ($i = 0; $i < count($candidatos); $i++) {
                    echo "<tr>";
                    echo "<td>" . $candidatos[$i]["ID"] . "</td>";
                    echo "<td>" . $candidatos[$i]["nome"] . "</td>";
                    echo "<td>" . $candidatos[$i]["CPF"] . "</td>";
                    echo "<td>" . $candidatos[$i]["email"] . "</td>";
                    echo "<td>" . $candidatos[$i]["numero_telefone"] . "</td>";
                    // botão para ver o PDF do candidato
                    echo "<td><button onclick='viewPDF(\"" . $candidatos[$i]["paths"] . "\")'>Visualizar PDF</button> </td>";
                    echo "<td id='situacao-" . $candidatos[$i]["ID"] . "'>" . $candidatos[$i]["situacao"] . "</td>";
                    echo "<td>" . $candidatos[$i]["nome_vaga"] . "</td>"; // exibe o nome da vaga
                    echo "<td class='alterarsitu'>";
                    // select para alterar a situação do candidato: aprovado, reprovado, em análise
                    echo "<select class='statusSelect' data-candidato-id='" . $candidatos[$i]["ID"] . "'>";
                    echo "<option value='aprovado'>aprovado</option>";
                    echo "<option value='reprovado'>reprovado</option>";
                    echo "<option value='em analise'>Em análise</option>";
                    echo "</select>";
                    echo "<button class='btn-atualizar' onclick='alterarsituacao(" . $candidatos[$i]["ID"] . ")'>Atualizar</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>

            <script>


            </script>

</body>

</html>
