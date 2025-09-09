<?php
namespace Modules\Anexo24\Controllers;
use CodeIgniter\RESTful\ResourceController;
use Modules\Anexo24\Models\PedimentoModel;
use Modules\Anexo24\Models\ProductoModel;
use Modules\Anexo24\Models\UnidadModel;
use Modules\Anexo24\Models\InventarioQuery;
use Modules\Anexo24\Models\ExpedienteModel;
use Modules\Anexo24\Models\AlertaModel;

class Api extends ResourceController {
    protected function cors(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
    }
    public function options($any=null){ $this->cors(); return $this->respond(['ok'=>true]); }

    public function pedimentos(){
        $this->cors();
        $m = new PedimentoModel();
        $rows = $m->orderBy('fecha','DESC')->findAll(200);
        return $this->respond(['rows'=>$rows]);
    }
    public function pedimentosCreate(){
        $this->cors();
        $input = $this->request->getJSON(true) ?? $this->request->getPost();
        $m = new PedimentoModel();
        $m->insert([
            'id_empresa'=>$input['id_empresa'] ?? 1,
            'tipo'=>$input['tipo'] ?? 'IMT',
            'patente'=>$input['patente'] ?? '',
            'aduana_clave'=>$input['aduana_clave'] ?? '',
            'seccion'=>$input['seccion'] ?? '',
            'numero'=>$input['numero'] ?? '',
            'fecha'=>$input['fecha'] ?? date('Y-m-d'),
            'proveedor_cliente'=>$input['proveedor_cliente'] ?? null,
            'observaciones'=>$input['observaciones'] ?? null,
        ]);
        return $this->respondCreated(['ok'=>true]);
    }
    public function productos(){
        $this->cors();
        $m = new ProductoModel();
        $rows = $m->orderBy('sku','ASC')->findAll(1000);
        return $this->respond(['rows'=>$rows]);
    }
    public function productosCreate(){
        $this->cors();
        $d = $this->request->getJSON(true) ?? $this->request->getPost();
        $m = new ProductoModel();
        $m->insert([
            'sku'=>$d['sku'] ?? '',
            'descripcion'=>$d['descripcion'] ?? '',
            'id_unidad'=>$d['id_unidad'] ?? 1,
            'es_insumo'=>!empty($d['es_insumo']) ? 1 : 0
        ]);
        return $this->respondCreated(['ok'=>true]);
    }
    public function inventarioSaldos(){
        $this->cors();
        $q = new InventarioQuery();
        return $this->respond(['rows'=>$q->saldos()]);
    }
    public function inventarioKardex($sku){
        $this->cors();
        $q = new InventarioQuery();
        return $this->respond(['rows'=>$q->kardex($sku)]);
    }
    public function exportaciones(){
        $this->cors();
        $m = new ExpedienteModel();
        $rows = $m->orderBy('fecha','DESC')->findAll(200);
        return $this->respond(['rows'=>$rows]);
    }
    public function alertas(){
        $this->cors();
        $m = new AlertaModel();
        $rows = $m->orderBy('fecha_limite','ASC')->findAll(200);
        return $this->respond(['rows'=>$rows]);
    }
}
