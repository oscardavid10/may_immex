<h2>Productos</h2>
<a href="/anexo24/productos/create">Nuevo</a>
<table border="1" cellpadding="6">
<tr><th>SKU</th><th>Descripción</th><th>Unidad</th><th>Tipo</th></tr>
<?php foreach($rows as $r): ?>
<tr>
<td><?= esc($r['sku']) ?></td>
<td><?= esc($r['descripcion']) ?></td>
<td><?= esc($r['id_unidad']) ?></td>
<td><?= $r['es_insumo'] ? 'INSUMO' : 'PT' ?></td>
</tr><?php endforeach; ?></table>
