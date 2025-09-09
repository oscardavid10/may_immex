<?php
namespace Modules\Anexo24\Models;
use CodeIgniter\Model;
class ProductoModel extends Model {
    protected $table='productos';
    protected $allowedFields=['sku','descripcion','id_unidad','es_insumo'];
}
