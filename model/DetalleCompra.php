<?php
require_once("Conexion.php");
class DetalleCompra
{
    private $id;
    private $compra;
    private $producto;
    private $cant;
    private $price;
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
     * Get the value of compra
     */
    public function getCompra()
    {
        return $this->compra;
    }

    /**
     * Set the value of compra
     *
     * @return  self
     */
    public function setCompra($compra)
    {
        $this->compra = $compra;

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
     * Get the value of cant
     */
    public function getCant()
    {
        return $this->cant;
    }

    /**
     * Set the value of cant
     *
     * @return  self
     */
    public function setCant($cant)
    {
        $this->cant = $cant;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

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

    public function saveDetalleCompra()
    {
        $id = 0;
        $sql = $this->db->prepare("INSERT INTO detalle_compra VALUES(?,?,?,?,?,?);");
        # s = string; i = int; d = decimal
        $res = $sql->bind_param(
            'iiiidi',
            $id,
            $this->compra,
            $this->producto,
            $this->cant,
            $this->price,
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
        $sql->close();
        $this->db->close();
        return $data;
    }

    public function updateDetalleCompra()
    {
        $sql = $this->db->prepare("UPDATE detalle_compra SET producto = ?, cant = ?, price = ?, estado = ? WHERE compra = ?;");
        $res = $sql->bind_param(
            'iidii',
            $this->producto,
            $this->cant,
            $this->price,
            $this->estado,
            $this->compra
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

    public function ultmimoIdP()
    {
        $info = $this->db->prepare("SELECT MAX(id) FROM detalle_compra;");
        $info->execute();
        $resultado = $info->get_result();
        $fila = $resultado->fetch_assoc();
        return $fila['MAX(id)'];
    }
}
