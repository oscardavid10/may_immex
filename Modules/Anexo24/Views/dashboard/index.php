<h2>Dashboard Anexo 24</h2>
<p>Últimos pedimentos</p>
<table border="1" cellpadding="6">
<tr><th>Fecha</th><th>Tipo</th><th>Patente/Aduana</th><th>Número</th></tr>
<?php foreach(($pedimentos ?? []) as $p): ?>
<tr>
  <td><?= esc($p['fecha']) ?></td>
  <td><?= esc($p['tipo']) ?></td>
  <td><?= esc($p['patente']) ?>/<?= esc($p['aduana_clave']) ?></td>
  <td><?= esc($p['numero']) ?></td>
</tr><?php endforeach; ?></table>
