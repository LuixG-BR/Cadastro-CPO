<?php
require_once "conexao.php";

$data = $_POST["data_presenca"];
$presencas = $_POST["presenca"] ?? [];

$result = mysqli_query($conexao, "SELECT id_aluno FROM aluno");

while ($aluno = mysqli_fetch_assoc($result)) {
    $id_aluno = $aluno["id_aluno"];
    $presente = isset($presencas[$id_aluno]) ? '1' : '0';

    // Evita duplicidade — exclui se já existir presença para essa data
    mysqli_query($conexao, "DELETE FROM presenca WHERE id_aluno = $id_aluno AND data_presenca = '$data'");

    // Insere a nova presença
    $sql = "INSERT INTO presenca (id_aluno, data_presenca, presente) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'isi', $id_aluno, $data, $presente);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

echo "Presenças salvas com sucesso!";
mysqli_close($conexao);
?>
