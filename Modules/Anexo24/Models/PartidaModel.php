<?php
namespace Modules\Anexo24\Models;
use CodeIgniter\Model;
class PartidaModel extends Model {
    protected $table='pedimentos_partidas';
    protected $allowedFields=['id_pedimento','partida','id_fraccion','id_producto','descripcion','cantidad','id_unidad','valor_aduana','pais_origen','tasa_ig_ieps','tasa_iva','observaciones'];
}
