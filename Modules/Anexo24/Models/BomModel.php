<?php
namespace Modules\Anexo24\Models;
use CodeIgniter\Model;
class BomModel extends Model {
    protected $table='bom';
    protected $allowedFields=['id_producto_pt','id_producto_insumo','consumo_por_unidad','merma_pct','vigente_desde','vigente_hasta'];
}
