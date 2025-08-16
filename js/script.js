function filtrarTabela() {
  const input = document.getElementById("filtro");
  const filtro = input.value.toLowerCase();
  const linhas = document.querySelectorAll("tbody tr");

  linhas.forEach((linha) => {
    const textoLinha = linha.textContent.toLowerCase();
    linha.style.display = textoLinha.includes(filtro) ? "" : "none";
  });
}

async function exportarPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();

  const colunasSelecionadas = Array.from(document.querySelectorAll(".coluna:checked")).map(cb => parseInt(cb.value));

  const headers = [];
  const cabecalhos = document.querySelectorAll("table thead tr th");
  colunasSelecionadas.forEach(index => {
    headers.push(cabecalhos[index].innerText);
  });

  const body = [];
  const linhas = document.querySelectorAll("table tbody tr");
  linhas.forEach(tr => {
    const cels = tr.querySelectorAll("td");
    const linha = [];
    colunasSelecionadas.forEach(index => {
      linha.push(cels[index].innerText.trim());
    });
    body.push(linha);
  });

  doc.text("Lista de Alunos", 14, 14);
  doc.autoTable({
    head: [headers],
    body: body,
    startY: 20,
    styles: { fontSize: 10, cellPadding: 3 },
    headStyles: { fillColor: [30, 64, 175] }
  });

  const nomeArquivo = document.querySelector("input[name='nome']").value.trim();

  doc.save(nomeArquivo + ".pdf");
}


function confirmarDelete() {
  let senha = prompt("Digite a senha para confirmar a exclusão:");
  if (senha === "180509") {
    return true; // envia o form
  } else {
    alert("Senha incorreta! Exclusão cancelada.");
    return false; // cancela envio
  }
}