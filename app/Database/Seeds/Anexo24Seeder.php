<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Anexo24Seeder extends Seeder {
    public function run() {
        $this->db->table('empresas')->insert([
            'rfc' => 'XAXX010101000',
            'razon_social' => 'EMPRESA DEMO SA DE CV',
            'programa' => 'IMMEX',
            'domicilio' => 'GDL',
            'activo' => 1,
        ]);

        $this->db->table('unidades_medida')->insertBatch([
            ['clave_sat' => 'H87', 'descripcion' => 'Pieza'],
            ['clave_sat' => 'KGM', 'descripcion' => 'Kilogramo'],
            ['clave_sat' => 'MTR', 'descripcion' => 'Metro'],
        ]);

        $this->db->table('productos')->insertBatch([
            ['sku' => 'INS-001', 'descripcion' => 'Insumo genérico', 'id_unidad' => 1, 'es_insumo' => 1],
            ['sku' => 'PT-001', 'descripcion' => 'Producto terminado demo', 'id_unidad' => 1, 'es_insumo' => 0],
        ]);
    }
}