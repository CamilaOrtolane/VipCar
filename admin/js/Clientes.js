document.addEventListener("DOMContentLoaded", () => {
  const clientes = [
    { nome: "Camila Oliveira", cpf: "123.456.789-00", telefone: "(11) 91234-5678", cidade: "São Paulo" },
    { nome: "José Almeida", cpf: "987.654.321-00", telefone: "(21) 99876-5432", cidade: "Rio de Janeiro" },
    { nome: "Ana Souza", cpf: "456.789.123-00", telefone: "(31) 98888-7777", cidade: "Belo Horizonte" }
  ];

  const tbody = document.getElementById("tabela-clientes");

  clientes.forEach(cliente => {
    const tr = document.createElement("tr");

    tr.innerHTML = `
      <td>${cliente.nome}</td>
      <td>${cliente.cpf}</td>
      <td>${cliente.telefone}</td>
      <td>${cliente.cidade}</td>
      <td>
        <a href="vizu_clientes.html" class="button">Visualizar</a>
        <a href="edit_clientes.html" class="button">Editar</a>
        <button class="button" onclick="deletarCliente('${cliente.cpf}')">Excluir</button>
      </td>
    `;

    tbody.appendChild(tr);
  });
});

function deletarCliente(cpf) {
  alert(`Cliente com CPF ${cpf} será excluído (função ainda não implementada).`);
}

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
