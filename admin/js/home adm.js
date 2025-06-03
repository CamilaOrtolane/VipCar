document.addEventListener("DOMContentLoaded", function () {
      const locacoes = [
        {
          cliente: "João Silva",
          veiculo: "Corolla XEI 2.0",
          valor: 220,
          data: "10/05/2025",
          status: "Ativa"
        },
        {
          cliente: "Asaffe Ayron",
          veiculo: "HB20 Comfort",
          valor: 180,
          data: "08/05/2025",
          status: "Cancelada"
        },
        {
          cliente: "Joaquim Passareli",
          veiculo: "Civic EXL 2.0",
          valor: 250,
          data: "12/05/2025",
          status: "Finalizada"
        },
        {
          cliente: "Domenique Jail",
          veiculo: "Onix",
          valor: 170,
          data: "07/05/2025",
          status: "Finalizada"
        }
      ];

      function preencherTabela(locacoes) {
        const tabela = document.getElementById("tabela-locacoes");
        tabela.innerHTML = "";

        locacoes.forEach(loc => {
          const tr = document.createElement("tr");

          tr.innerHTML = `
            <td>${loc.cliente}</td>
            <td>${loc.veiculo}</td>
            <td>R$ ${loc.valor.toFixed(2)}</td>
            <td>${loc.data}</td>
            <td><span class="status ${loc.status.toLowerCase()}">${loc.status}</span></td>
          `;

          tabela.appendChild(tr);
        });
      }

      function atualizarResumo(locacoes) {
        const locacoesHoje = locacoes.length;
        const veiculosDisponiveis = 50; // valor fictício
        const total = locacoes.reduce((soma, loc) => soma + loc.valor, 0);

        document.getElementById("locacoes-dia").textContent = locacoesHoje;
        document.getElementById("veiculos-disponiveis").textContent = veiculosDisponiveis;
        document.getElementById("valor-total").textContent = `R$ ${total.toFixed(2)}`;
      }

      preencherTabela(locacoes);
      atualizarResumo(locacoes);
    });
    document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('menu-toggle');
    const closeBtn = document.getElementById('close-sidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    function openSidebar() {
      sidebar.classList.add('open');
      overlay.classList.add('visible');
    }

    function closeSidebar() {
      sidebar.classList.remove('open');
      overlay.classList.remove('visible');
    }

    toggleBtn.addEventListener('click', openSidebar);
    closeBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
  });