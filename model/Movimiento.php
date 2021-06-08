<?php
require_once("Conexion.php");
class Movimiento
{
    private $id;
    private $productoM;
    private $cantidad;
    private $ultima_existencia;
    private $precio;
    private $costo;
    private $ultimo_costo;
    private $descripcion;
    private $tipo;
    private $fecha;
    private $cliente;
    private $doc;
    private $estadoM;
    private $db;

    public function __construct()
    {
        $this->db = conectar();
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

    /**
     * Get the value of estadoM
     */ 
    public function getEstadoM()
    {
        return $this->estadoM;
    }

    /**
     * Set the value of estadoM
     *
     * @return  self
     */ 
    public function setEstadoM($estadoM)
    {
        $this->estadoM = $estadoM;

        return $this;
    }

    /**
     * Get the value of doc
     */ 
    public function getDoc()
    {
        return $this->doc;
    }

    /**
     * Set the value of doc
     *
     * @return  self
     */ 
    public function setDoc($doc)
    {
        $this->doc = $doc;

        return $this;
    }

    /**
     * Get the value of cliente
     */ 
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set the value of cliente
     *
     * @return  self
     */ 
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

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
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of ultimo_costo
     */ 
    public function getUltimo_costo()
    {
        return $this->ultimo_costo;
    }

    /**
     * Set the value of ultimo_costo
     *
     * @return  self
     */ 
    public function setUltimo_costo($ultimo_costo)
    {
        $this->ultimo_costo = $ultimo_costo;

        return $this;
    }

    /**
     * Get the value of costo
     */ 
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * Set the value of costo
     *
     * @return  self
     */ 
    public function setCosto($costo)
    {
        $this->costo = $costo;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of ultima_existencia
     */ 
    public function getUltima_existencia()
    {
        return $this->ultima_existencia;
    }

    /**
     * Set the value of ultima_existencia
     *
     * @return  self
     */ 
    public function setUltima_existencia($ultima_existencia)
    {
        $this->ultima_existencia = $ultima_existencia;

        return $this;
    }

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */ 
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get the value of productoM
     */ 
    public function getProductoM()
    {
        return $this->productoM;
    }

    /**
     * Set the value of productoM
     *
     * @return  self
     */ 
    public function setProductoM($productoM)
    {
        $this->productoM = $productoM;

        return $this;
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

    

    public function saveMovimiento()
    {
        $sql = $this->db->prepare("INSERT INTO Movimiento values (?,?,?,?,?,?,?,?,?,?,?,?,?);");
        # s = string; i = int; d = decimal
        $res = $sql->bind_param(
            'iiiidddsisisi',
            $this->id,
            $this->productoM,
            $this->cantidad,
            $this->ultima_existencia,
            $this->precio,
            $this->costo,
            $this->ultimo_costo,
            $this->descripcion,
            $this->tipo,
            $this->fecha,
            $this->cliente,
            $this->doc,
            $this->estadoM
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
        return $data;
    }

    public function desMovimiento($id)
    {
        $sql = $this->db->prepare("SELECT concat('Compra a ',if(p.clasificacion = 'ninguno', 'Sujeto Excluido', ''),if(p.clasificacion = 'mediano', 'Mediano Contribuyente', ''),if(p.clasificacion = 'peqeño', 'Peqeño Contribuyente', ''),if(p.clasificacion = 'gran contribuyente', 'Gran Contribuyente', ''),' con ',c.document_type,' #',c.document_number) as 'descripcion' from compra c inner join proveedor p on c.proveedor = p.id inner join detalle_compra dc on dc.compra = c.id where c.id = ? limit 1;");
        mysqli_stmt_bind_param($sql, 'i', $id);
        mysqli_stmt_execute($sql);
        mysqli_stmt_bind_result($sql, $res);
        mysqli_stmt_fetch($sql);
        mysqli_stmt_close($sql);
        return $res;
    }
}
