<?php
namespace Modules\Anexo24\Controllers;
use CodeIgniter\Controller;
use Modules\Anexo24\Models\ProductoModel;
use Modules\Anexo24\Models\UnidadModel;
class Productos extends Controller {
    public function index(){ $m=new ProductoModel(); $rows=$m->orderBy('sku','ASC')->findAll();
        return view('Modules\\Anexo24\\Views\\productos\\index',['rows'=>$rows]); }
    public function create(){ $u=new UnidadModel();
        return view('Modules\\Anexo24\\Views\\productos\\create',['unidades'=>$u->findAll()]); }
    public function store(){
        $m=new ProductoModel(); $m->insert([
            'sku'=>$this->request->getPost('sku'),
            'descripcion'=>$this->request->getPost('descripcion'),
            'id_unidad'=>$this->request->getPost('id_unidad'),
            'es_insumo'=>$this->request->getPost('es_insumo')?1:0
        ]); return redirect()->to('/anexo24/productos');
    }
    public function edit($id){ $m=new ProductoModel(); $u=new UnidadModel();
        return view('Modules\\Anexo24\\Views\\productos\\create',['row'=>$m->find($id),'unidades'=>$u->findAll()]); }
    public function update($id){
        $m=new ProductoModel(); $m->update($id,[
            'sku'=>$this->request->getPost('sku'),'descripcion'=>$this->request->getPost('descripcion'),
            'id_unidad'=>$this->request->getPost('id_unidad'),'es_insumo'=>$this->request->getPost('es_insumo')?1:0
        ]); return redirect()->to('/anexo24/productos');
    }
}
