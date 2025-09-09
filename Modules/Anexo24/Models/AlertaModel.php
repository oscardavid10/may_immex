<?php
namespace Modules\Anexo24\Models;
use CodeIgniter\Model;
class AlertaModel extends Model {
    protected $table='alertas_plazo';
    protected $allowedFields=['id_lote','tipo','fecha_limite','atendida','atendida_por','fecha_atencion'];
}
