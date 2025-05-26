<div class="detalhes-containe">
  <h2><?= $titulo ?></h2>
  <form method="POST">
   
  <div class="info"><strong>ID:</strong> <?= $objeto['id_objeto'] ?></div>
  <div class="info"><strong>Nome:</strong> <?= htmlspecialchars($objeto['nome_objeto']) ?></div>
  <div class="info"><strong>Descrição:</strong> <?= htmlspecialchars($objeto['descricao'] ?? 'Sem descrição') ?></div>
  <div class="info"><strong>Data de Cadastro:</strong> <?= $objeto['data_cadastro'] ?></div>
  <div class="info"><strong>Status:</strong> <?= ucfirst($objeto['status']) ?></div>

   <a class="back-link" href="painel_objetos.php">← Voltar ao Painel</a>

</div>