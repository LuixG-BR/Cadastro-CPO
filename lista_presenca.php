<?php
require_once "conexao.php";

// 1. Define o segundo sábado do mês atual
$dataReferencia = date('Y-m-01');
$segundoSabado = date('Y-m-d', strtotime('second saturday of ' . $dataReferencia));

$data = isset($_POST["data"]) ? $_POST["data"] : $segundoSabado;

// 2. Busca os alunos
$sql = "SELECT id_aluno, nome_aluno FROM aluno ORDER BY nome_aluno ASC";
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/lista_presenca.css" type="text/css">
    <title>Lista de Presença</title>
</head>
<body>
<div class="container">

<h2>Lista de Presença — <?= date("d/m/Y", strtotime($data)) ?></h2>

<form method="post" style="margin-bottom: 18px;">
    <input type="date" name="data" value="<?= $data ?>" style="margin-top: 15px;">
    <button type="submit" style="margin-top: 10px;">Carregar Lista</button>
</form>

<hr>
<form action="salvar_presenca.php" method="post" style="margin-top: 15px;">
    <input type="hidden" name="data_presenca" value="<?= $data ?>">
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
