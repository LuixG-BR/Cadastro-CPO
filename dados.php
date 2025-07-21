<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados</title>
</head>
<body>
    <?php
    require_once "conexao.php";

    $nome = $_POST["nome"];
    $telefone = $_POST["tel"] ??null ;
    $congregacao = $_POST["congregacao"];
    // $pegouApostila = $_POST["pegou"];
    // $pagouApostila = $_POST["pagou"];

    if(empty($nome)||empty($congregacao)){
        echo "Campos Vazios !";
        die ("Campos Vazios !");
    }

    $sql = "insert into aluno(nome_aluno, tel_aluno, congregacao_aluno)
     values(?,?,?)";
    $comando = mysqli_prepare($conexao,$sql);
    mysqli_stmt_bind_param($comando,'sss',$nome,$telefone,$congregacao);

    if(mysqli_stmt_execute($comando)){
        echo "cadastro com sucesso !!";
    }else{
        echo "erro no cadastro".mysqli_error($conexao);
    }

    mysqli_stmt_close($comando);
    mysqli_close($conexao);
    ?>
</body>
</html>