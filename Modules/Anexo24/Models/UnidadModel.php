<?php
namespace Modules\Anexo24\Models;
use CodeIgniter\Model;
class UnidadModel extends Model {
    protected $table='unidades_medida';
    protected $allowedFields=['clave_sat','descripcion'];
}
