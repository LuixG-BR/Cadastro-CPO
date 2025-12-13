function filtrarTabela() {
  const input = document.getElementById("filtro");
  const filtro = input.value.toLowerCase();
  const linhas = document.querySelectorAll("tbody tr");

  linhas.forEach((linha) => {
    const textoLinha = linha.textContent.toLowerCase();
    linha.style.display = textoLinha.includes(filtro) ? "" : "none";
  });
}

// RELATORIO EM PDF 
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

// CERTIFICADO EM PDF
  
function exportarCertificado(id, nome) {
  const { jsPDF } = window.jspdf;

  // normaliza o nome para arquivo
  const nomeArquivo = nome
    .toLowerCase()
    .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
    .replace(/\s+/g, "_")
    .replace(/[^a-z0-9_]/g, "");

  html2canvas(document.getElementById("certificado-container"), {
    scale: 3
  }).then(canvas => {
    const img = canvas.toDataURL("image/png");
    const pdf = new jsPDF("landscape", "mm", "a4");

    pdf.addImage(img, "PNG", 0, 0, 297, 210);
    pdf.save(`${id}-${nomeArquivo}.pdf`);
  });
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