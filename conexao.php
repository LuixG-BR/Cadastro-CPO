<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexao</title>
</head>
<body>
    <?php
    $servidor = 'localhost';
    $base_de_dados = 'inscricoes_cpo';
    $usuario = 'root';
    $senha = '';

    $conexao = mysqli_connect($servidor,$usuario,$senha,$base_de_dados);

    if(!$conexao){
        die("conexao falhou".mysqli_conenect_error());
    }
    ?>
</body>
</html>