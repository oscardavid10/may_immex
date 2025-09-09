<?php
namespace Modules\Anexo24\Controllers;
use CodeIgniter\Controller;
use Modules\Anexo24\Models\PedimentoModel;
class Dashboard extends Controller {
    public function index() {
        $m = new PedimentoModel();
        $pedimentos = $m->orderBy('fecha','DESC')->limit(10)->find();
        return view('Modules\\Anexo24\\Views\\dashboard\\index', ['pedimentos'=>$pedimentos]);
    }
}
