<?php
namespace Modules\Anexo24\Models;
use CodeIgniter\Model;
class LoteModel extends Model {
    protected $table='lotes';
    protected $allowedFields=['id_ped_partida','lote','serie','cantidad_ingreso','cantidad_disponible','fecha_ingreso','fecha_vencimiento','ubicacion'];
}
