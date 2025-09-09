<?php
namespace Modules\Anexo24\Controllers;
use CodeIgniter\Controller;
use Modules\Anexo24\Models\InventarioQuery;
class Inventario extends Controller {
    public function saldos(){ $q=new InventarioQuery(); $rows=$q->saldos();
        return view('Modules\\Anexo24\\Views\\inventario\\saldos',['rows'=>$rows]); }
    public function kardex($sku){ $q=new InventarioQuery(); $rows=$q->kardex($sku);
        return view('Modules\\Anexo24\\Views\\inventario\\kardex',['rows'=>$rows,'sku'=>$sku]); }
}
