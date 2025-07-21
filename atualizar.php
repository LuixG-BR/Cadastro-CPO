<?php
require_once "conexao.php";

$id = $_POST["id"];

// Coleta todos os campos (pode vir vazio)
$nome = $_POST["nome"] ?? null;
$telefone = $_POST["tel"] ?? null;
$congregacao = $_POST["congregacao"] ?? null;
// $pegou = $_POST["pegou"] ?? null;
// $pagou = $_POST["pagou"] ?? null;

// Constrói dinamicamente os campos a serem atualizados
$campos = [];
$valores = [];

if (!empty($nome)) {
    $campos[] = "nome_aluno = ?";
    $valores[] = $nome;
}
if (!empty($telefone)) {
    $campos[] = "tel_aluno = ?";
    $valores[] = $telefone;
}
if (!empty($congregacao)) {
    $campos[] = "congregacao_aluno = ?";
    $valores[] = $congregacao;
}
// if (!empty($pegou)) {
//     $campos[] = "pegouApostila = ?";
//     $valores[] = $pegou;
// }
// if (!empty($pagou)) {
//     $campos[] = "pagouApostila = ?";
//     $valores[] = $pagou;
// }

if (empty($campos)) {
    die("Nenhum dado para atualizar.");
}

$sql = "UPDATE aluno SET " . implode(', ', $campos) . " WHERE id_aluno = ?";
$valores[] = $id;

$tipos = str_repeat('s', count($valores) - 1) . 'i'; // todos string, menos o ID final que é int

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, $tipos, ...$valores);

if (mysqli_stmt_execute($stmt)) {
    echo "Dados atualizados com sucesso!";
} else {
    echo "Erro na atualização: " . mysqli_error($conexao);
}

mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>
