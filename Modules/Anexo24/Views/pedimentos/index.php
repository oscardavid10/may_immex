<h2>Pedimentos</h2>
<a href="/anexo24/pedimentos/create">Nuevo</a>
<table border="1" cellpadding="6">
<tr><th>ID</th><th>Fecha</th><th>Tipo</th><th>Número</th></tr>
<?php foreach($rows as $r): ?>
<tr>
  <td><?= esc($r['id']) ?></td>
  <td><?= esc($r['fecha']) ?></td>
  <td><?= esc($r['tipo']) ?></td>
  <td><?= esc($r['numero']) ?></td>
</tr><?php endforeach; ?></table>
<?= $pager->links() ?>
