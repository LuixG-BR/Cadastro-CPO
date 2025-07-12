<?php
require_once "conexao.php";

// 1. Define o segundo sábado do mês atual
$dataReferencia = date('Y-m-01');
$segundoSabado = date('Y-m-d', strtotime('second saturday of ' . $dataReferencia));

// 2. Busca os alunos
$sql = "SELECT id_aluno, nome_aluno FROM aluno ORDER BY nome_aluno ASC";
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Lista de Presença</title>
</head>
<body>
<div class="container">
<h2>Lista de Presença — <?= date("d/m/Y", strtotime($segundoSabado)) ?></h2>
<form action="salvar_presenca.php" method="post">
    <input type="hidden" name="data_presenca" value="<?= $segundoSabado ?>">

    <?php while($aluno = mysqli_fetch_assoc($resultado)): ?>
        <label>
            <input type="checkbox" name="presenca[<?= $aluno['id_aluno'] ?>]" value="P">
            <?= htmlspecialchars($aluno['nome_aluno']) ?>
        </label>
    <?php endwhile; ?>

    <button type="submit">Salvar Presenças</button>
</form>
</div>
    <div class="voltar">
        <a href="index.html">← Voltar</a>
    </div>
</body>
</html>
