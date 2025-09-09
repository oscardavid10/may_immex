<?php
namespace Modules\Anexo24\Controllers;
use CodeIgniter\Controller;
use Modules\Anexo24\Models\PedimentoModel;
use Modules\Anexo24\Models\PartidaModel;
use Modules\Anexo24\Models\LoteModel;
class Pedimentos extends Controller {
    public function index(){ $m=new PedimentoModel(); $rows=$m->orderBy('fecha','DESC')->paginate(20);
        return view('Modules\\Anexo24\\Views\\pedimentos\\index',['rows'=>$rows,'pager'=>$m->pager]); }
    public function create(){ return view('Modules\\Anexo24\\Views\\pedimentos\\create'); }
    public function store(){
        $m=new PedimentoModel();
        $m->insert([
            'id_empresa'=>$this->request->getPost('id_empresa')??1,
            'tipo'=>$this->request->getPost('tipo'),
            'patente'=>$this->request->getPost('patente'),
            'aduana_clave'=>$this->request->getPost('aduana_clave'),
            'seccion'=>$this->request->getPost('seccion'),
            'numero'=>$this->request->getPost('numero'),
            'fecha'=>$this->request->getPost('fecha'),
            'proveedor_cliente'=>$this->request->getPost('proveedor_cliente'),
            'observaciones'=>$this->request->getPost('observaciones'),
        ]);
        return redirect()->to('/anexo24/pedimentos');
    }
    public function show($id){ $m=new PedimentoModel(); $p=$m->find($id);
        return view('Modules\\Anexo24\\Views\\pedimentos\\show',['p'=>$p]); }
    public function partidas($id){ $pm=new PartidaModel(); $rows=$pm->where('id_pedimento',$id)->findAll();
        return view('Modules\\Anexo24\\Views\\pedimentos\\partidas',['rows'=>$rows,'id'=>$id]); }
    public function storePartida($id){
        $pm=new PartidaModel(); $pm->insert([
            'id_pedimento'=>$id,'partida'=>$this->request->getPost('partida'),
            'id_fraccion'=>$this->request->getPost('id_fraccion'),'id_producto'=>$this->request->getPost('id_producto'),
            'descripcion'=>$this->request->getPost('descripcion'),'cantidad'=>$this->request->getPost('cantidad'),
            'id_unidad'=>$this->request->getPost('id_unidad'),'valor_aduana'=>$this->request->getPost('valor_aduana'),
            'pais_origen'=>$this->request->getPost('pais_origen'),
        ]); return redirect()->to('/anexo24/pedimentos/'.$id.'/partidas');
    }
    public function lotear($id){
        $pm=new PartidaModel(); $lm=new LoteModel(); $partidas=$pm->where('id_pedimento',$id)->findAll();
        foreach($partidas as $pp){
            $lm->insert([
                'id_ped_partida'=>$pp['id'],'lote'=>null,'serie'=>null,
                'cantidad_ingreso'=>$pp['cantidad'],'cantidad_disponible'=>$pp['cantidad'],
                'fecha_ingreso'=>date('Y-m-d'),'fecha_vencimiento'=>null,'ubicacion'=>null,
            ]);
        } return redirect()->to('/anexo24/pedimentos');
    }
}
