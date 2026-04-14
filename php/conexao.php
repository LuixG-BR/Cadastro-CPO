<?php
$servidor = 'localhost';
$base_de_dados = 'cadastro_cursos';
$usuario = 'root';
$senha = '';

$conexao = mysqli_connect($servidor, $usuario, $senha, $base_de_dados);

if (!$conexao) {
    die("conexao falhou" . mysqli_connect_error());
}
