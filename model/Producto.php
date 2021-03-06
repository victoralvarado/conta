<?php
require_once("Conexion.php");

class Producto
{
    private $id;
    private $nombre;
    private $existencias;
    private $precio;
    private $costoP;
    private $descripcion;
    private $imagen;
    private $codigo;
    public $db;

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
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of existencias
     */
    public function getExistencias()
    {
        return $this->existencias;
    }

    /**
     * Set the value of existencias
     *
     * @return  self
     */
    public function setExistencias($existencias)
    {
        $this->existencias = $existencias;

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
     * Get the value of costoP
     */
    public function getCostoP()
    {
        return $this->costoP;
    }

    /**
     * Set the value of costoP
     *
     * @return  self
     */
    public function setCostoP($costoP)
    {
        $this->costoP = $costoP;

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
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get the value of codigo
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

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

    public function getIdProducto($codigo)
    {
        $sql = $this->db->prepare("SELECT id FROM Producto WHERE codigo = ?;");
        mysqli_stmt_bind_param($sql, 's', $codigo);
        mysqli_stmt_execute($sql);
        mysqli_stmt_bind_result($sql, $res);
        mysqli_stmt_fetch($sql);
        mysqli_stmt_close($sql);
        return $res;
    }

    public function getAllProducto()
    {
        $sqlAll = "SELECT * FROM Producto WHERE estado = 1;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows > 0) {

            $dato = $info;
        } else {

            $dato = false;
        }
        return $dato;
    }

    public function saveProducto()
    {
        $estado = 1;
        $sql = $this->db->prepare("INSERT INTO Producto(nombre,existencias,precio,costo,descripcion,imagen,codigo,estado) values (?,?,?,?,?,?,?,?);");
        # s = string; i = int; d = decimal
        $res = $sql->bind_param('siddsssi', $this->nombre, $this->existencias, $this->precio, $this->costoP, $this->descripcion, $this->imagen, $this->codigo, $estado);
        $sql->execute();
        $data = array();
        if ($res) {
            $data['estado'] = true;
            $data['descripcion'] = 'Datos ingresado exitosamente';
        } else {
            $data['estado'] = false;
            $data['descripcion'] = 'Ocurrio un error en la inserci??n ' . $this->db->error;
        }
        return $data;
    }

    public function deleteProducto()
    {
        $sql = $this->db->prepare("UPDATE Producto SET estado = 0 where id =?;");
        $res = $sql->bind_param('i', $this->id);
        $sql->execute();
        $data = array();
        if ($res) {
            $data['estado'] = true;
            $data['descripcion'] = 'Datos eliminados exitosamente';
        } else {
            $data['estado'] = false;
            $data['descripcion'] = 'Ocurrio un error en la eliminaci??n ' . $this->db->error;
        }
        $sql->close();
        $this->db->close();
        return $data;
    }

    public function getUltimoCostoP($codigo)
    {
        $sql = $this->db->prepare("SELECT costo FROM producto WHERE codigo = ?;");
        mysqli_stmt_bind_param($sql, 's', $codigo);
        mysqli_stmt_execute($sql);
        mysqli_stmt_bind_result($sql, $res);
        mysqli_stmt_fetch($sql);
        mysqli_stmt_close($sql);
        return $res;
    }

    public function getUltimaExistenciaP($codigo)
    {
        $sql = $this->db->prepare("SELECT existencias FROM producto WHERE codigo = ?;");
        mysqli_stmt_bind_param($sql, 's', $codigo);
        mysqli_stmt_execute($sql);
        mysqli_stmt_bind_result($sql, $res);
        mysqli_stmt_fetch($sql);
        mysqli_stmt_close($sql);
        return $res;
    }

    public function getCodProducto($codigo)
    {
        $sql = $this->db->prepare("SELECT codigo FROM producto WHERE codigo = ?;");
        mysqli_stmt_bind_param($sql, 's', $codigo);
        mysqli_stmt_execute($sql);
        mysqli_stmt_bind_result($sql, $res);
        mysqli_stmt_fetch($sql);
        mysqli_stmt_close($sql);
        return $res;
    }


    public function updateProducto()
    {
        if ($this->imagen == '') {
            $sql = $this->db->prepare("UPDATE Producto SET nombre = ?, existencias = ?, precio = ?, costo = ?, descripcion = ?, codigo = ? where id =?;");
            $res = $sql->bind_param('siddssi', $this->nombre, $this->existencias, $this->precio, $this->costoP, $this->descripcion, $this->codigo, $this->id);
            $sql->execute();
            $data = array();
            if ($res) {
                $data['estado'] = true;
                $data['descripcion'] = 'Datos eliminados exitosamente';
            } else {
                $data['estado'] = false;
                $data['descripcion'] = 'Ocurrio un error en la modificacion ' . $this->db->error;
            }
            $sql->close();
            $this->db->close();
        } else {
            $sql = $this->db->prepare("UPDATE Producto SET nombre = ?, existencias = ?, precio = ?, costo = ?, descripcion = ?, imagen = ?, codigo = ? where id =?;");
            $res = $sql->bind_param('siddsssi', $this->nombre, $this->existencias, $this->precio, $this->costoP, $this->descripcion, $this->imagen, $this->codigo, $this->id);
            $sql->execute();
            $data = array();
            if ($res) {
                $data['estado'] = true;
                $data['descripcion'] = 'Datos eliminados exitosamente';
            } else {
                $data['estado'] = false;
                $data['descripcion'] = 'Ocurrio un error en la modificacion ' . $this->db->error;
            }
            $sql->close();
            $this->db->close();
        }

        return $data;
    }
    public function updateProductoCE()
    {
        $sql = $this->db->prepare("UPDATE Producto SET existencias = ?, costo = ? where codigo =?;");
        $res = $sql->bind_param('idi', $this->existencias, $this->costoP, $this->codigo);
        $sql->execute();
        $data = array();
        if ($res) {
            $data['estado'] = true;
            $data['descripcion'] = 'Datos eliminados exitosamente';
        } else {
            $data['estado'] = false;
            $data['descripcion'] = 'Ocurrio un error en la modificacion ' . $this->db->error;
        }
        return $data;
    }

    public function mostrarClPr($tipo, $cp)
    {
        if ($tipo == 1) {
            $sql = $this->db->prepare("SELECT distinct  p.nombre from proveedor p inner join movimiento m on m.cliente=p.id where m.tipo = ? and p.id = ?;");
            mysqli_stmt_bind_param($sql, 'ii', $tipo, $cp);
            mysqli_stmt_execute($sql);
            mysqli_stmt_bind_result($sql, $res);
            mysqli_stmt_fetch($sql);
            mysqli_stmt_close($sql);
            return $res;
        } else if ($tipo == 0) {
            $sql = $this->db->prepare("SELECT distinct  c.nombre from cliente c inner join movimiento m on m.cliente=c.id where m.tipo = ? and c.id = ?;");
            mysqli_stmt_bind_param($sql, 'ii', $tipo, $cp);
            mysqli_stmt_execute($sql);
            mysqli_stmt_bind_result($sql, $res);
            mysqli_stmt_fetch($sql);
            mysqli_stmt_close($sql);
            return $res;
        }
    }

    public function movimiento($producto, $desde, $hasta)
    {
        $sqlAll = "SELECT 0 as id,'' as producto,'' as cantidad,0 as ultima_existencia,'' as precio,'' as costo,0 as ultimo_costo,'' as descripcion,'' as tipo,'' as fecha,'' as cliente,'Saldo Inicial a la Fecha' as doc,1 as estado union SELECT * FROM Movimiento WHERE estado = 1 AND producto = " . $producto . " AND fecha  BETWEEN  '" . $desde . "' AND '" . $hasta . "';";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows > 0) {

            $dato = $info;
        } else {

            $dato = false;
        }
        return $dato;
    }

    public function costoP($producto)
    {
        $sql = $this->db->prepare("SELECT costo from producto where id = ?;");
        mysqli_stmt_bind_param($sql, 's', $producto);
        mysqli_stmt_execute($sql);
        mysqli_stmt_bind_result($sql, $res);
        mysqli_stmt_fetch($sql);
        mysqli_stmt_close($sql);
        return $res;
    }
}
