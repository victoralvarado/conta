<?php
require_once("Conexion.php");
class Compra
{
    private $id;
    private $afectas;
    private $iva;
    private $retencion;
    private $proveedor;
    private $fecha;
    private $registrado_por;
    private $condiciones;
    private $estadoC;
    private $document_type;
    private $document_number;
    private $db;

    public function __construct()
    {
        $this->db = conectar();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of afectas
     */ 
    public function getAfectas()
    {
        return $this->afectas;
    }

    /**
     * Set the value of afectas
     *
     * @return  self
     */ 
    public function setAfectas($afectas)
    {
        $this->afectas = $afectas;

        return $this;
    }

    /**
     * Get the value of iva
     */ 
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set the value of iva
     *
     * @return  self
     */ 
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    /**
     * Get the value of retencion
     */ 
    public function getRetencion()
    {
        return $this->retencion;
    }

    /**
     * Set the value of retencion
     *
     * @return  self
     */ 
    public function setRetencion($retencion)
    {
        $this->retencion = $retencion;

        return $this;
    }

    /**
     * Get the value of proveedor
     */ 
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set the value of proveedor
     *
     * @return  self
     */ 
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of registrado_por
     */ 
    public function getRegistrado_por()
    {
        return $this->registrado_por;
    }

    /**
     * Set the value of registrado_por
     *
     * @return  self
     */ 
    public function setRegistrado_por($registrado_por)
    {
        $this->registrado_por = $registrado_por;

        return $this;
    }

    /**
     * Get the value of condiciones
     */ 
    public function getCondiciones()
    {
        return $this->condiciones;
    }

    /**
     * Set the value of condiciones
     *
     * @return  self
     */ 
    public function setCondiciones($condiciones)
    {
        $this->condiciones = $condiciones;

        return $this;
    }

    /**
     * Get the value of estadoC
     */ 
    public function getEstadoC()
    {
        return $this->estadoC;
    }

    /**
     * Set the value of estadoC
     *
     * @return  self
     */ 
    public function setEstadoC($estadoC)
    {
        $this->estadoC = $estadoC;

        return $this;
    }

    /**
     * Get the value of document_type
     */ 
    public function getDocument_type()
    {
        return $this->document_type;
    }

    /**
     * Set the value of document_type
     *
     * @return  self
     */ 
    public function setDocument_type($document_type)
    {
        $this->document_type = $document_type;

        return $this;
    }

    /**
     * Get the value of document_number
     */ 
    public function getDocument_number()
    {
        return $this->document_number;
    }

    /**
     * Set the value of document_number
     *
     * @return  self
     */ 
    public function setDocument_number($document_number)
    {
        $this->document_number = $document_number;

        return $this;
    }

    /**
     * Get the value of db
     */ 
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */ 
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    public function getNombreUser($username)
    {
        $sql = $this->db->prepare("SELECT nombre FROM usuario WHERE usuario.usuario = ?;");
        mysqli_stmt_bind_param($sql, 's', $username);
        mysqli_stmt_execute($sql);
        mysqli_stmt_bind_result($sql, $res);
        mysqli_stmt_fetch($sql);
        mysqli_stmt_close($sql);
        return $res;
    }

    public function saveCompra()
    {
        $sql = $this->db->prepare("INSERT INTO compra(afectas, iva, retencion, proveedor, fecha, registrado_por, condiciones, estado, document_type, document_number) VALUES(?,?,?,?,?,?,?,?,?,?);");
            $sql->bind_param('dddissiiss',$this->afectas,$this->iva,$this->retencion,$this->proveedor,$this->fecha,$this->registrado_por,$this->condiciones,$this->estadoC,$this->document_type,$this->document_number);
        $sql->execute();
    }

    public function ultmimoId()
    {
        $info = $this->db->prepare("SELECT MAX(id) FROM compra;");
        $info->execute();
        $resultado = $info->get_result();
        $fila = $resultado->fetch_assoc();
        return $fila['MAX(id)'];
    }

    public function getAllCompras()
    {
        $sqlAll = "SELECT c.*, dc.*,p.nombre FROM compra c INNER JOIN detalle_compra dc ON c.id = dc.compra INNER JOIN proveedor p ON c.proveedor=p.id;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows > 0) {

            $dato = $info;
        } else {

            $dato = false;
        }
        return $dato;
    }
    public function getOneCompra($id)
    {
        $sqlOne = "SELECT c.id as 'idcompra',c.*, dc.*, p.tipo as 'tipoP',p.clasificacion,p.nit,p.nrc,p.nombre,p.razon_social,p.direccion,p.telefono, pr.nombre as 'nombrep' FROM compra c INNER JOIN detalle_compra dc ON c.id = dc.compra INNER JOIN proveedor p ON c.proveedor=p.id INNER JOIN producto pr ON pr.id = dc.producto where c.id =" . $id . ";";
        $info = $this->db->query($sqlOne);
        if ($info->num_rows > 0) {

            $dato = $info;
        } else {

            $dato = false;
        }
        return $dato;
    }
    public function getOneCompraMas($id)
    {
        $sqlMas = "SELECT c.numero_comprobante AS'numcomp', pr.nombre AS'nomprod',pr.codigo,dc.cant AS'cantidad',dc.price AS'precio',p.clasificacion AS'clasiprov',c.registrado_por AS'registradopor' FROM compra c INNER JOIN detalle_compra dc ON c.id = dc.compra INNER JOIN proveedor p ON c.proveedor=p.id INNER JOIN producto pr ON pr.id = dc.producto WHERE c.id =" . $id . ";";
        $info = $this->db->query($sqlMas);
        if ($info->num_rows > 0) {

            $dato = $info;
        } else {

            $dato = false;
        }
        return $dato;
    }

    public function updateCompra()
    {
        $sql = $this->db->prepare("UPDATE Compra SET afectas = ?, iva = ?, retencion = ?, proveedor = ?, fecha = ?, registrado_por = ?, condiciones = ?, estadoC = ?, tipo = ?, numero_comprobante = ?, nit = ?, sujeto_excluido = ?, nrc = ?, exentas_importacion = ?, exentas_internas = ?, gravadas_importacion = ?, gravadas_internas = ?, totalCompras = ? WHERE id = ?;");
        $res = $sql->bind_param(
            'dddissiiissdsdddddi',
            $this->afectas,
            $this->iva,
            $this->retencion,
            $this->proveedor,
            $this->fecha,
            $this->registrado_por,
            $this->condiciones,
            $this->estadoC,
            $this->tipo,
            $this->numero_comprobante,
            $this->nit,
            $this->sujeto_excluido,
            $this->nrc,
            $this->exentas_importacion,
            $this->exentas_internas,
            $this->gravadas_importacion,
            $this->gravadas_internas,
            $this->totalCompras,
            $this->id
        );
        $sql->execute();
        $data = array();
        if ($res) {
            $data['estado'] = true;
            $data['descripcion'] = 'Datos ingresado exitosamente';
        } else {
            $data['estado'] = false;
            $data['descripcion'] = 'Ocurrio un error en la inserción ' . $this->db->error;
        }
        $sql->close();
        $this->db->close();
        return $data;
    }

}
