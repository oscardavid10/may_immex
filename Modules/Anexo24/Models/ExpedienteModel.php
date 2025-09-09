<?php
namespace Modules\Anexo24\Models;
use CodeIgniter\Model;
class ExpedienteModel extends Model {
    protected $table='expedientes_exportacion';
    protected $allowedFields=['id_empresa','id_pedimento_exp','fecha','numero_doc'];
}
