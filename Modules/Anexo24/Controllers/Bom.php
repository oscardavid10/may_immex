<?php
namespace Modules\Anexo24\Controllers;
use CodeIgniter\Controller;
use Modules\Anexo24\Models\ProductoModel;
use Modules\Anexo24\Models\BomModel;
class Bom extends Controller {
    public function index(){
        $m=new ProductoModel(); $pts=$m->where('es_insumo',0)->findAll();
        return view('Modules\\Anexo24\\Views\\bom\\index',['pts'=>$pts]);
    }
    public function edit($ptId){
        $m=new ProductoModel(); $b=new BomModel();
        return view('Modules\\Anexo24\\Views\\bom\\edit',[
            'pt'=>$m->find($ptId),'bom'=>$b->where('id_producto_pt',$ptId)->findAll(),'insumos'=>$m->where('es_insumo',1)->findAll(),
        ]);
    }
    public function save($ptId){
        $b=new BomModel(); $b->where('id_producto_pt',$ptId)->delete();
        $insumos=$this->request->getPost('insumo')??[];
        foreach($insumos as $row){
            if(empty($row['id_producto_insumo'])) continue;
            $b->insert([
                'id_producto_pt'=>$ptId,'id_producto_insumo'=>(int)$row['id_producto_insumo'],
                'consumo_por_unidad'=>(float)$row['consumo_por_unidad'],'merma_pct'=>(float)($row['merma_pct']??0),
                'vigente_desde'=>date('Y-m-d'),'vigente_hasta'=>null
            ]);
        } return redirect()->to('/anexo24/bom');
    }
}
