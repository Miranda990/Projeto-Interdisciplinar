// script.js

const produtos = [
  { nome: "Cimento Votoran", categoria: "Cimento", estoque: 100, preco: "R$ 32,50", fornecedor: "Construfácil" },
  { nome: "Areia Média", categoria: "Areia", estoque: 200, preco: "R$ 18,00", fornecedor: "Areial do Zé" },
  { nome: "Brita 1", categoria: "Brita", estoque: 150, preco: "R$ 22,50", fornecedor: "Pedreira Boa Pedra" },
  { nome: "Tijolo Baiano", categoria: "Tijolos", estoque: 500, preco: "R$ 0,80", fornecedor: "Tijolaria São Jorge" },
  { nome: "Bloco de Concreto", categoria: "Blocos", estoque: 300, preco: "R$ 2,50", fornecedor: "Blocos & Cia" },
  { nome: "Cal Hidratada", categoria: "Cal", estoque: 120, preco: "R$ 10,00", fornecedor: "Químicos Vale Verde" },
  { nome: "Telha Cerâmica", categoria: "Telhas", estoque: 250, preco: "R$ 3,20", fornecedor: "Telhas Brasil" },
  { nome: "Viga de Aço", categoria: "Aço", estoque: 80, preco: "R$ 45,00", fornecedor: "Metalúrgica União" },
  { nome: "Tubo PVC 100mm", categoria: "Hidráulico", estoque: 180, preco: "R$ 27,00", fornecedor: "HidroCenter" },
  { nome: "Fio Elétrico 2,5mm", categoria: "Elétrico", estoque: 220, preco: "R$ 1,90", fornecedor: "EletroMais" },
  { nome: "Laje Treliçada", categoria: "Estrutura", estoque: 60, preco: "R$ 85,00", fornecedor: "Treliças do Brasil" },
  { nome: "Argamassa AC1", categoria: "Argamassa", estoque: 90, preco: "R$ 22,90", fornecedor: "Argamix" },
  { nome: "Porta de Madeira", categoria: "Acabamento", estoque: 40, preco: "R$ 120,00", fornecedor: "Portas Reais" },
  { nome: "Janela de Alumínio", categoria: "Acabamento", estoque: 70, preco: "R$ 210,00", fornecedor: "Alumix" },
  { nome: "Interruptor Simples", categoria: "Elétrico", estoque: 300, preco: "R$ 5,50", fornecedor: "Casa Elétrica" },
  { nome: "Torneira PVC", categoria: "Hidráulico", estoque: 130, preco: "R$ 12,00", fornecedor: "PlasCenter" },
  { nome: "Massa Corrida", categoria: "Acabamento", estoque: 110, preco: "R$ 38,00", fornecedor: "Tintas Real" },
  { nome: "Rolo de Pintura", categoria: "Ferramentas", estoque: 90, preco: "R$ 15,00", fornecedor: "Ferragens ABC" },
  { nome: "Parafuso 5mm", categoria: "Ferragens", estoque: 800, preco: "R$ 0,10", fornecedor: "Parafusos & Cia" },
  { nome: "Cano PVC 50mm", categoria: "Hidráulico", estoque: 160, preco: "R$ 19,00", fornecedor: "HidroCenter" }
];

function carregarProdutos() {
  const selects = [
    document.getElementById("produto"),
    document.getElementById("produto_saida"),
    document.getElementById("produto_info")
  ];

  selects.forEach(select => {
    produtos.forEach(produto => {
      const option = document.createElement("option");
      option.value = produto.nome;
      option.textContent = produto.nome;
      select.appendChild(option);
    });
  });
}

function mostrarDetalhesProduto() {
  const select = document.getElementById("produto_info");
  const tbody = document.getElementById("detalhes_produto");
  const produtoSelecionado = produtos.find(p => p.nome === select.value);

  if (produtoSelecionado) {
    tbody.innerHTML = `
      <tr>
        <td>${produtoSelecionado.nome}</td>
        <td>${produtoSelecionado.categoria}</td>
        <td>${produtoSelecionado.estoque}</td>
        <td>${produtoSelecionado.preco}</td>
        <td>${produtoSelecionado.fornecedor}</td>
      </tr>
    `;
  } else {
    tbody.innerHTML = `<tr><td colspan="5" style="text-align:center">Selecione um produto para ver os detalhes</td></tr>`;
  }
}

document.addEventListener("DOMContentLoaded", carregarProdutos);
