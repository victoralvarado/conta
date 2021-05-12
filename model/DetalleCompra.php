<?php
require_once("Conexion.php");
class DetalleCompra
{
    private $id;
    private $compra;
    private $producto;
    private $cant;
    private $price;
    private $estadoDC;
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
     * Get the value of estadoDC
     */
    public function getEstadoDC()
    {
        return $this->estadoDC;
    }

    /**
     * Set the value of estadoDC
     *
     * @return  self
     */
    public function setEstadoDC($estadoDC)
    {
        $this->estadoDC = $estadoDC;

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
            $this->estadoDC
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

    public function updateDetalleCompra()
    {
        $sql = $this->db->prepare("UPDATE detalle_compra SET producto = ?, cant = ?, price = ?, estado = ? WHERE compra = ?;");
        $res = $sql->bind_param(
            'iidii',
            $this->producto,
            $this->cant,
            $this->price,
            $this->estadoDC,
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

    public function ultmimoIdP($codigo)
    {
        $sql = $this->db->prepare("SELECT id FROM producto where codigo = ?");
        mysqli_stmt_bind_param($sql,'s',$codigo);
        mysqli_stmt_execute($sql);
        mysqli_stmt_bind_result($sql, $res);
        mysqli_stmt_fetch($sql);
        mysqli_stmt_close($sql);
        return $res;
    }
}
