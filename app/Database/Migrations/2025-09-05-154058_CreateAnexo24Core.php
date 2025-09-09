<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class CreateAnexo24Core extends Migration {
    public function up() {
        $forge = $this->forge;
        $this->db->query("CREATE TABLE IF NOT EXISTS empresas (
          id INT AUTO_INCREMENT PRIMARY KEY,
          rfc VARCHAR(13) NOT NULL UNIQUE,
          razon_social VARCHAR(255) NOT NULL,
          programa VARCHAR(20) NULL,
          domicilio TEXT NULL,
          activo TINYINT(1) DEFAULT 1
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        $this->db->query("CREATE TABLE IF NOT EXISTS unidades_medida (
          id INT AUTO_INCREMENT PRIMARY KEY,
          clave_sat VARCHAR(5) NOT NULL,
          descripcion VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        $this->db->query("CREATE TABLE IF NOT EXISTS fracciones (
          id INT AUTO_INCREMENT PRIMARY KEY,
          fraccion VARCHAR(8) NOT NULL,
          nico VARCHAR(2) NULL,
          descripcion VARCHAR(255) NULL,
          UNIQUE KEY uq_fracc_nico (fraccion, nico)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        $this->db->query("CREATE TABLE IF NOT EXISTS productos (
          id INT AUTO_INCREMENT PRIMARY KEY,
          sku VARCHAR(100) NOT NULL,
          descripcion VARCHAR(255) NOT NULL,
          id_unidad INT NOT NULL,
          es_insumo TINYINT(1) DEFAULT 1,
          UNIQUE KEY uq_sku (sku),
          CONSTRAINT fk_prod_unidad FOREIGN KEY (id_unidad) REFERENCES unidades_medida(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        $this->db->query("CREATE TABLE IF NOT EXISTS pedimentos (
          id BIGINT AUTO_INCREMENT PRIMARY KEY,
          id_empresa INT NOT NULL,
          tipo ENUM('IMT','IMD','EXP','RET','VIR','REG') NOT NULL,
          patente VARCHAR(4) NOT NULL,
          aduana_clave VARCHAR(2) NOT NULL,
          seccion VARCHAR(2) NULL,
          numero VARCHAR(7) NOT NULL,
          fecha DATE NOT NULL,
          proveedor_cliente VARCHAR(255) NULL,
          observaciones TEXT NULL,
          KEY ix_empresa_fecha (id_empresa, fecha),
          KEY ix_claves (patente, aduana_clave, numero),
          CONSTRAINT fk_ped_empresa FOREIGN KEY (id_empresa) REFERENCES empresas(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        $this->db->query("CREATE TABLE IF NOT EXISTS pedimentos_partidas (
          id BIGINT AUTO_INCREMENT PRIMARY KEY,
          id_pedimento BIGINT NOT NULL,
          partida INT NOT NULL,
          id_fraccion INT NOT NULL,
          id_producto INT NULL,
          descripcion VARCHAR(255),
          cantidad DECIMAL(18,6) NOT NULL,
          id_unidad INT NOT NULL,
          valor_aduana DECIMAL(18,6) NOT NULL,
          pais_origen VARCHAR(3) NULL,
          tasa_ig_ieps DECIMAL(9,6) NULL,
          tasa_iva DECIMAL(9,6) NULL,
          observaciones TEXT NULL,
          UNIQUE KEY uq_partida (id_pedimento, partida),
          KEY ix_fraccion (id_fraccion),
          KEY ix_producto (id_producto),
          CONSTRAINT fk_pp_ped FOREIGN KEY (id_pedimento) REFERENCES pedimentos(id),
          CONSTRAINT fk_pp_fracc FOREIGN KEY (id_fraccion) REFERENCES fracciones(id),
          CONSTRAINT fk_pp_unid FOREIGN KEY (id_unidad) REFERENCES unidades_medida(id),
          CONSTRAINT fk_pp_prod FOREIGN KEY (id_producto) REFERENCES productos(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        $this->db->query("CREATE TABLE IF NOT EXISTS lotes (
          id BIGINT AUTO_INCREMENT PRIMARY KEY,
          id_ped_partida BIGINT NOT NULL,
          lote VARCHAR(100) NULL,
          serie VARCHAR(100) NULL,
          cantidad_ingreso DECIMAL(18,6) NOT NULL,
          cantidad_disponible DECIMAL(18,6) NOT NULL,
          fecha_ingreso DATE NOT NULL,
          fecha_vencimiento DATE NULL,
          ubicacion VARCHAR(100) NULL,
          KEY ix_disponible (cantidad_disponible),
          KEY ix_vencimiento (fecha_vencimiento),
          CONSTRAINT fk_lote_pp FOREIGN KEY (id_ped_partida) REFERENCES pedimentos_partidas(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        $this->db->query("CREATE TABLE IF NOT EXISTS bom (
          id BIGINT AUTO_INCREMENT PRIMARY KEY,
          id_producto_pt INT NOT NULL,
          id_producto_insumo INT NOT NULL,
          consumo_por_unidad DECIMAL(18,6) NOT NULL,
          merma_pct DECIMAL(9,6) DEFAULT 0,
          vigente_desde DATE NULL,
          vigente_hasta DATE NULL,
          UNIQUE KEY uq_bom (id_producto_pt, id_producto_insumo, vigente_desde),
          CONSTRAINT fk_bom_pt FOREIGN KEY (id_producto_pt) REFERENCES productos(id),
          CONSTRAINT fk_bom_ins FOREIGN KEY (id_producto_insumo) REFERENCES productos(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        $this->db->query("CREATE TABLE IF NOT EXISTS mov_inventario (
          id BIGINT AUTO_INCREMENT PRIMARY KEY,
          id_empresa INT NOT NULL,
          fecha DATETIME NOT NULL,
          tipo ENUM('ENTRADA_IMT','ENTRADA_IMD','SALIDA_EXP','SALIDA_RET','SALIDA_TRANSF','SALIDA_REG','CONSUMO','AJUSTE_POS','AJUSTE_NEG') NOT NULL,
          id_lote BIGINT NULL,
          id_producto INT NOT NULL,
          cantidad DECIMAL(18,6) NOT NULL,
          referencia VARCHAR(100) NULL,
          detalle JSON NULL,
          KEY ix_empresa_fecha (id_empresa, fecha),
          KEY ix_producto (id_producto),
          CONSTRAINT fk_mi_emp FOREIGN KEY (id_empresa) REFERENCES empresas(id),
          CONSTRAINT fk_mi_lote FOREIGN KEY (id_lote) REFERENCES lotes(id),
          CONSTRAINT fk_mi_prod FOREIGN KEY (id_producto) REFERENCES productos(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        $this->db->query("CREATE TABLE IF NOT EXISTS expedientes_exportacion (
          id BIGINT AUTO_INCREMENT PRIMARY KEY,
          id_empresa INT NOT NULL,
          id_pedimento_exp BIGINT NOT NULL,
          fecha DATE NOT NULL,
          numero_doc VARCHAR(100) NULL,
          KEY ix_empresa_fecha (id_empresa, fecha),
          CONSTRAINT fk_ee_emp FOREIGN KEY (id_empresa) REFERENCES empresas(id),
          CONSTRAINT fk_ee_ped FOREIGN KEY (id_pedimento_exp) REFERENCES pedimentos(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        $this->db->query("CREATE TABLE IF NOT EXISTS descargas_insumos (
          id BIGINT AUTO_INCREMENT PRIMARY KEY,
          id_expediente BIGINT NOT NULL,
          id_producto_insumo INT NOT NULL,
          id_lote_origen BIGINT NOT NULL,
          cantidad_descargada DECIMAL(18,6) NOT NULL,
          metodo ENUM('FIFO','FEFO','LIFO','LOTE_EXPLÍCITO') DEFAULT 'FIFO',
          KEY ix_lote (id_lote_origen),
          CONSTRAINT fk_di_exp FOREIGN KEY (id_expediente) REFERENCES expedientes_exportacion(id),
          CONSTRAINT fk_di_prod FOREIGN KEY (id_producto_insumo) REFERENCES productos(id),
          CONSTRAINT fk_di_lote FOREIGN KEY (id_lote_origen) REFERENCES lotes(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        $this->db->query("CREATE TABLE IF NOT EXISTS alertas_plazo (
          id BIGINT AUTO_INCREMENT PRIMARY KEY,
          id_lote BIGINT NOT NULL,
          tipo ENUM('MP_18M','AF_2Y','OTRO') NOT NULL,
          fecha_limite DATE NOT NULL,
          atendida TINYINT(1) DEFAULT 0,
          atendida_por VARCHAR(100) NULL,
          fecha_atencion DATETIME NULL,
          KEY ix_limite (fecha_limite, atendida),
          CONSTRAINT fk_alerta_lote FOREIGN KEY (id_lote) REFERENCES lotes(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    }
    public function down() {
        $forge = $this->forge;
        $forge->dropTable('alertas_plazo', true);
        $forge->dropTable('descargas_insumos', true);
        $forge->dropTable('expedientes_exportacion', true);
        $forge->dropTable('mov_inventario', true);
        $forge->dropTable('bom', true);
        $forge->dropTable('lotes', true);
        $forge->dropTable('pedimentos_partidas', true);
        $forge->dropTable('pedimentos', true);
        $forge->dropTable('productos', true);
        $forge->dropTable('fracciones', true);
        $forge->dropTable('unidades_medida', true);
        $forge->dropTable('empresas', true);
    }
}