<?php
require_once "conexao.php";

$id = intval($_POST["id"]);
$senha = $_POST["senha"];

$senha_correta = "180509";

$sqlAluno = "DELETE FROM aluno WHERE id_aluno = $id";
$sqlPresenca = "DELETE FROM presenca WHERE id_aluno = $id";

$mensagem = "";
$tipo = "";

if ($id <= 0) {
    $mensagem = "ID inválido!";
    $tipo = "erro";
} elseif ($senha === $senha_correta) {

    mysqli_query($conexao, $sqlPresenca);
    mysqli_query($conexao, $sqlAluno);

    $mensagem = "Registro deletado com sucesso!";
    $tipo = "sucesso";
} else {
    $mensagem = "Acesso negado: senha incorreta!";
    $tipo = "erro";
}

mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/lista_alunos.css" type="text/css">
<title>Deletar Registro</title>
<style>
    .mensagem {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 20px 30px;
        border-radius: 12px;
        color: #fff;
        font-size: 18px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        opacity: 0;
        animation: slideIn 0.5s forwards, fadeOut 0.5s 3s forwards;
        z-index: 1000;
    }

    .sucesso {
        background-color: #28a745;
        border: 2px solid #1e7e34;
    }

    .erro {
        background-color: #dc3545;
        border: 2px solid #a71d2a;
    }

    @keyframes slideIn {
        from { top: -50px; opacity: 0; }
        to { top: 20px; opacity: 1; }
    }

    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }

    .mensagem a {
        display: inline-block;
        margin-top: 10px;
        color: #fff;
        text-decoration: underline;
    }
</style>
</head>
<body>

<div class="mensagem <?= $tipo ?>">
    <?= htmlspecialchars($mensagem) ?>
    <br>
    <a href="../index.html">← Voltar</a>
</div>

</body>
</html>