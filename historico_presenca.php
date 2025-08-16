<?php
require_once "conexao.php";

// Pega o ID do aluno da URL
$id_aluno = intval($_GET['id'] ?? 0);

// Busca os dados do aluno
$sqlAluno = "SELECT nome_aluno, tel_aluno, congregacao_aluno FROM aluno WHERE id_aluno = $id_aluno";
$resAluno = mysqli_query($conexao, $sqlAluno);
$aluno = mysqli_fetch_assoc($resAluno);

// Busca todas as datas e se o aluno esteve presente ou não
$sql = "
    SELECT 
        data_presenca,
        CASE 
            WHEN presente = 1 THEN '✅ Presente'
            ELSE '❌ Ausente'
        END AS status
    FROM presenca
    WHERE id_aluno = $id_aluno
    ORDER BY data_presenca DESC
";

$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/lista_alunos.css" type="text/css">
    <title>Histórico de Presença</title>
</head>
<body>

<div class="container">
    <h2>Histórico de Presença</h2>
    <p><strong>Aluno:</strong> <?= htmlspecialchars($aluno["nome_aluno"]) ?></p>
    <p><strong>Congregação:</strong> <?= htmlspecialchars($aluno["congregacao_aluno"]) ?></p>

    <div class="tabela">
        <table>
            <thead>
                <tr>
                    <th>Data da Aula</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php while($linha = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($linha["data_presenca"])) ?></td>
                    <td><?= $linha["status"] ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="voltar">
    <a href="lista_alunos.php">← Voltar para lista de alunos</a>
</div>

</body>
</html>
