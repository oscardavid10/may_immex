<?php
namespace Modules\Anexo24\Models;
use Config\Database;
class InventarioQuery {
    public function saldos(): array {
        $db = Database::connect();
        $sql = "SELECT p.patente, p.aduana_clave, p.numero, p.fecha AS fecha_pedimento,
                       pp.partida, f.fraccion, f.nico, pr.sku, pr.descripcion,
                       l.id AS id_lote, l.cantidad_disponible, l.fecha_ingreso, l.fecha_vencimiento
                FROM lotes l
                JOIN pedimentos_partidas pp ON pp.id = l.id_ped_partida
                JOIN pedimentos p ON p.id = pp.id_pedimento
                LEFT JOIN fracciones f ON f.id = pp.id_fraccion
                LEFT JOIN productos pr ON pr.id = pp.id_producto
                WHERE l.cantidad_disponible > 0
                ORDER BY p.fecha, p.numero, pp.partida";
        return $db->query($sql)->getResultArray();
    }
    public function kardex(string $sku): array {
        $db = Database::connect();
        $sql = "SELECT mi.fecha, mi.tipo, mi.referencia, mi.cantidad
                FROM mov_inventario mi
                JOIN productos pr ON pr.id = mi.id_producto
                WHERE pr.sku = ?
                ORDER BY mi.fecha, mi.id";
        return $db->query($sql, [$sku])->getResultArray();
    }
}
