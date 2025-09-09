<?php
namespace Modules\Anexo24\Controllers;
use CodeIgniter\Controller;
use Modules\Anexo24\Models\AlertaModel;
class Alertas extends Controller {
    public function index(){ $m=new AlertaModel(); $rows=$m->orderBy('fecha_limite','ASC')->findAll(100);
        return view('Modules\\Anexo24\\Views\\alertas\\index',['rows'=>$rows]); }
}
