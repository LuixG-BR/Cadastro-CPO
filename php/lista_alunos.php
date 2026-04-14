<?php
require_once "conexao.php";

$sql = "
    SELECT 
        a.id_aluno,
        a.nome_aluno,
        a.tel_aluno,
        a.congregacao_aluno,
        COUNT(CASE WHEN p.presente = 1 THEN 1 END) AS total_presencas,
        DATE_FORMAT(MAX(p.data_presenca), '%d/%m/%Y') AS ultima_presenca
    FROM aluno a
    LEFT JOIN presenca p 
        ON a.id_aluno = p.id_aluno 
        AND p.presente = 1
    GROUP BY a.id_aluno, a.nome_aluno, a.tel_aluno, a.congregacao_aluno
    ORDER BY a.congregacao_aluno ASC
";

$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/lista_alunos.css" type="text/css">
    <script src="../js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <title>Lista de Alunos</title>
</head>
<body>

<div class="container">
<h2>Lista de Todos os Alunos Cadastrados</h2>
<input type="text" id="filtro" placeholder="Filtrar por nome, telefone ou congregação..." onkeyup="filtrarTabela()" />
<div class="selecionar-colunas">
  <label><input type="checkbox" class="coluna" value="0" checked> ID</label>
  <label><input type="checkbox" class="coluna" value="1" checked> Nome</label>
  <label><input type="checkbox" class="coluna" value="3" checked> Congregação</label>
  <label><input type="checkbox" class="coluna" value="4"> Nº Presença</label>
  <label><input type="checkbox" class="coluna" value="5"> Datas Presentes</label>
  <input type="text" placeholder="Digite o nome que você deseja salvar no arquivo..." name="nome">
</div>

<div class="acoes">
    <button id="exportarPDF"  onclick="exportarPDF()">Exportar para PDF</button>
</div>

<div class="tabela">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Congregação</th>
            <th>Nº Presenças</th>
            <th>Datas de Presença</th>
        </tr>
    </thead>
    <tbody>
    <?php while($aluno = mysqli_fetch_assoc($resultado)): ?>
        <tr>
            <td><?= $aluno["id_aluno"] ?></td>
            <td><?= htmlspecialchars($aluno["nome_aluno"]) ?></td>
            <td><?= htmlspecialchars($aluno["tel_aluno"]) ?></td>
            <td><?= htmlspecialchars($aluno["congregacao_aluno"]) ?></td>
            <td><?= $aluno["total_presencas"] ?></td>
            <td><?= $aluno["ultima_presenca"] ?: '-' ?>
            <br>
            <a href="historico_presenca.php?id=<?= $aluno['id_aluno'] ?>">Ver histórico</a></td>
        </tr>
    <?php endwhile; ?>
</tbody>
</table>
</div>
</div>

<div class="voltar">
    <a href="../index.html">← Voltar</a>
</div>

</body>
</html>
