<h2>Partidas del pedimento #<?= esc($id) ?></h2>
<form method="post" action="/anexo24/pedimentos/<?= $id ?>/partidas">
  <label>Partida</label><input name="partida" type="number">
  <label>ID Fracción</label><input name="id_fraccion" type="number">
  <label>ID Producto</label><input name="id_producto" type="number">
  <label>Descripción</label><input name="descripcion">
  <label>Cantidad</label><input name="cantidad" type="number" step="0.000001">
  <label>ID Unidad</label><input name="id_unidad" type="number">
  <label>Valor Aduana</label><input name="valor_aduana" type="number" step="0.000001">
  <label>País Origen</label><input name="pais_origen">
  <button>Agregar partida</button>
</form>
