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
    <link rel="stylesheet" href="css/certificado.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <title>Histórico de Presença</title>

    <script src="js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>

<body>

    <!-- ===================== HISTÓRICO ===================== -->
    <div class="historico-container">
        <div class="container">

            <h2>Histórico de Presença</h2>

            <p><strong>Aluno(a):</strong> <?= htmlspecialchars($aluno["nome_aluno"]) ?></p>
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
                        <?php while ($linha = mysqli_fetch_assoc($resultado)): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($linha["data_presenca"])) ?></td>
                                <td><?= $linha["status"] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="btn">
        <input type="hidden" id="aluno_id" value="<?= $id_aluno ?>">
        <input type="hidden" id="aluno_nome" value="<?= htmlspecialchars($aluno['nome_aluno'], ENT_QUOTES, 'UTF-8') ?>">

        <button id="btnExportar">
            Exportar Certificado em PDF
        </button>
    </div>

    <!-- ===================== CERTIFICADO ===================== -->
    <div class="a4" id="certificado-container">
        <div class="certificado" id="certificado">
            <div class="logo"></div>
            <div class="marca-dagua"></div>
            <!-- Triângulos -->
            <div class="decoracao canto-esq-superior"></div>
            <div class="decoracao canto-esq-superior2"></div>
            <div class="decoracao canto-esq-superior3"></div>
            <div class="decoracao canto-dir-inferior"></div>
            <div class="decoracao canto-dir-inferior2"></div>
            <div class="decoracao canto-dir-inferior3"></div>

            <div class="certificado-borda">
                <div class="conteudo">
                    <h1 class="titulo">CERTIFICADO</h1>

                    <p class="texto-intro">Este certificado comprova que</p>

                    <div class="aluno">
                        <h2 class="nome"><?= htmlspecialchars($aluno["nome_aluno"]) ?></h2> 
                    </div>

                    <p class="texto-principal">
                        Concluiu com êxito o <strong>Curso Preparatório para Obreiros</strong>, com duração de 20 horas,
                        demonstrando dedicação, esforço e compromisso exemplares.
                        Que esta conquista seja o início de uma trajetória de sucesso e sabedoria.
                    </p>


                    <div class="assinaturas">
                        <div class="assinatura">
                            <img src="./imgs/assinatura-pr_ismael2.png" alt="Assinatura" class="img-assinatura" style="margin-top: 65px;   opacity: 0.52;">
                            <hr>
                            <span>Pr. Presidente Ismael de Souza Alves</span>
                            <br>
                            <span>Direção Geral</span>
                        </div>
                        <div class="assinatura">
                            <img src="./imgs/assinatura-pr_jorge.png" alt="Assinatura" class="img-assinatura" style="margin-top: 48px;">
                            <hr>
                            <span>Pr. Jorge Rodrigues Cordeiro</span>
                            <br>
                            <span>Coordenação</span>
                        </div>
                        <div class="assinatura">
                            <img src="./imgs/assinatura-pr_renan.png" alt="Assinatura" class="img-assinatura" style="margin-top: 13px;">
                            <hr>
                            <span>Pr. Renan Welligton da Silva</span>
                            <br>
                            <span>Coordenação</span>
                        </div>
                    </div>

                    <p class="texto-final">Regsitro SP - 10 de Janeiro de 2026</p>

                </div>
            </div>

        </div>

    </div>


    <!-- ===================== VOLTAR ===================== -->
    <div class="voltar">
        <a href="lista_alunos.php">← Voltar para lista de alunos</a>
    </div>

</body>
<script>
    document.getElementById("btnExportar").addEventListener("click", function() {
        const id = document.getElementById("aluno_id").value;
        const nome = document.getElementById("aluno_nome").value;

        exportarCertificado(id, nome);
        console.log(
            document.getElementById("aluno_id").value,
            document.getElementById("aluno_nome").value
        );
    });
</script>


</html>