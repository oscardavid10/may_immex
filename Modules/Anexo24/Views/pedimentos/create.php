<h2>Nuevo pedimento</h2>
<form method="post" action="/anexo24/pedimentos">
  <label>Tipo</label>
  <select name="tipo">
    <option>IMT</option><option>IMD</option><option>EXP</option><option>RET</option><option>VIR</option><option>REG</option>
  </select>
  <label>Patente</label><input name="patente">
  <label>Aduana</label><input name="aduana_clave">
  <label>Sección</label><input name="seccion">
  <label>Número</label><input name="numero">
  <label>Fecha</label><input type="date" name="fecha">
  <label>Proveedor/Cliente</label><input name="proveedor_cliente">
  <label>Observaciones</label><input name="observaciones">
  <button>Guardar</button>
</form>
