<div class="topo-voltar">
  <button onclick="window.location.href='registroobj.php'">← Voltar</button>
</div>
<h2><?= $titulo ?></h2>

<table border="1" width="100%">
  <tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Descrição</th>
    <th>Status</th>
    <th>Ações</th>
  </tr>

  <?php foreach ($objetos as $obj): ?>
  <tr>
    <td><?= $obj['id_objeto'] ?></td>
    <td><?= htmlspecialchars($obj['nome_objeto']) ?></td>
    <td><?= $obj['descricao'] ?></td>
    <td><?= $obj['data_cadastro'] ?></td>
    <td>
      <a class="btn" href="registroobj.php?id=<?= $obj['id_objeto'] ?>">✏️ Editar</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
