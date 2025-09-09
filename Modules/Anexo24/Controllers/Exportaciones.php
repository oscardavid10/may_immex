<?php
namespace Modules\Anexo24\Controllers;
use CodeIgniter\Controller;
use Modules\Anexo24\Models\ExpedienteModel;
class Exportaciones extends Controller {
    public function index(){ $m=new ExpedienteModel(); $rows=$m->orderBy('fecha','DESC')->findAll(50);
        return view('Modules\\Anexo24\\Views\\exportaciones\\index',['rows'=>$rows]); }
    public function create(){ return view('Modules\\Anexo24\\Views\\exportaciones\\create'); }
    public function store(){ $m=new ExpedienteModel(); $m->insert([
            'id_empresa'=>1,'id_pedimento_exp'=>$this->request->getPost('id_pedimento_exp'),
            'fecha'=>$this->request->getPost('fecha'),'numero_doc'=>$this->request->getPost('numero_doc')
        ]); return redirect()->to('/anexo24/exportaciones'); }
    public function descargas($id){ return view('Modules\\Anexo24\\Views\\exportaciones\\descargas',['id'=>$id]); }
    public function storeDescarga($id){ return redirect()->to('/anexo24/exportaciones'); }
}
