<?php
require_once("./config/conexion.php");
class Movimiento
{
    private $id;
    private $producto;
    private $cantidad;
    private $ultima_existencia;
    private $precio;
    private $costo;
    private $ultimo_costo;
    private $descripcion;
    private $estado;
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
     * Get the value of producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set the value of producto
     *
     * @return  self
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;

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
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

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

    public function saveMovimiento()
    {
        $sql = $this->db->prepare("INSERT INTO Movimiento values (?,?,?,?,?,?,?,?,?);");
        # s = string; i = int; d = decimal
        $res = $sql->bind_param(
            'iiiidddsi',
            $this->id,
            $this->producto,
            $this->cantidad,
            $this->ultima_existencia,
            $this->precio,
            $this->costo,
            $this->ultimo_costo,
            $this->descripcion,
            $this->estado
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
