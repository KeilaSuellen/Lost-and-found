<script>
  function toggleMenu() {
    document.getElementById("nav-list").classList.toggle("show");
  }

  
    function imprimirComprovante() {
      window.location.href = "comprovante.html";
    }

      fetch('status_objetos.php')
      .then(response => response.json())
      .then(dados => {
        const tbody = document.getElementById('status-body');

        dados.forEach(obj => {
          const row = document.createElement('tr');
          const statusClasse = obj.status === 'Devolvido' ? 'status-devolvido' :
                               obj.status === 'Arquivado' ? 'status-arquivado' :
                               'status-disponivel';

          row.innerHTML = `
            <td>${obj.id_objeto}</td>
            <td>${obj.nome_objeto}</td>
            <td>${obj.tipo_objeto}</td>
            <td>${obj.descricao}</td>
            <td class="${statusClasse}">${obj.status}</td>
          `;
          tbody.appendChild(row);
        });
      })
      .catch(error => {
        console.error('Erro ao buscar os dados:', error);
      });


      function fecharModal() {
    document.getElementById('modal-excluir').style.display = 'none';
}

document.querySelectorAll('.btn-excluir').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const nome = this.getAttribute('data-nome');

        document.getElementById('id-usuario').value = id;
        document.getElementById('nome-usuario').textContent = nome;

        document.getElementById('modal-excluir').style.display = 'block';
    });
});

// Fecha ao clicar no X
document.querySelector('.close').onclick = fecharModal;

// Fecha ao clicar fora do modal
window.onclick = function(event) {
    const modal = document.getElementById('modal-excluir');
    if (event.target == modal) {
        fecharModal();
    }
}

</script>
