<?php
namespace Modules\Anexo24\Models;
use CodeIgniter\Model;
class PedimentoModel extends Model {
    protected $table='pedimentos';
    protected $allowedFields=['id_empresa','tipo','patente','aduana_clave','seccion','numero','fecha','proveedor_cliente','observaciones'];
}
