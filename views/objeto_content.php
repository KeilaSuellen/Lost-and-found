
  <h1>Objetos Cadastrados</h1>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Data</th>
      <th>Empresa</th>
      <th>Ver</th>
    </tr>
    <?php foreach ($objetos as $obj): ?>
      <tr>
        <td><?= htmlspecialchars($obj['id_objeto']) ?></td>
        <td><?= htmlspecialchars($obj['nome_objeto']) ?></td>
        <td><?= htmlspecialchars($obj['data_cadastro']) ?></td>
        <td><?= htmlspecialchars($obj['empresa']) ?></td>
        <td><a href="detalhes_objeto.php?id=<?= urlencode($obj['id_objeto']) ?>">Detalhes</a></td>
      </tr>
    <?php endforeach; ?>
  </table>
