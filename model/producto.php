<?php
require_once("Conexion.php");

class Producto
{
    private $id;
    private $nombre;
    private $existencias;
    private $precio;
    private $costo;
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
        $res = $sql->bind_param('siddsssi',$this->nombre,$this->existencias,$this->precio,$this->costo,$this->descripcion,$this->imagen,$this->codigo,$estado);
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

    public function deleteProducto()
	{
            $sql = $this->db->prepare("UPDATE Producto SET estado = 0 where id =?;");
	        $res = $sql->bind_param('i',$this->id);
            $sql->execute();
	        $data=array();
	        if($res)
	        {
	            $data['estado']=true;
	            $data['descripcion']='Datos eliminados exitosamente';
	        }
	        else
	        {
	            $data['estado']=false;
	            $data['descripcion']='Ocurrio un error en la eliminación '.$this->db->error;
	        }
            $sql->close();
            $this->db->close();
	        return $data;
	}


    public function updateProducto()
    {
        if ($this->imagen == '') {
            $sql = $this->db->prepare("UPDATE Producto SET nombre = ?, existencias = ?, precio = ?, costo = ?, descripcion = ?, codigo = ? where id =?;");
            $res = $sql->bind_param('siddssi', $this->nombre, $this->existencias, $this->precio, $this->costo, $this->descripcion, $this->codigo, $this->id);
            $sql->execute();
            $data = array();
            if ($res) {
                $data['estado'] = true;
                $data['descripcion'] = 'Datos eliminados exitosamente';
            } else {
                $data['estado'] = false;
                $data['descripcion'] = 'Ocurrio un error en la eliminación ' . $this->db->error;
            }
            $sql->close();
            $this->db->close();
        } else {
            $sql = $this->db->prepare("UPDATE Producto SET nombre = ?, existencias = ?, precio = ?, costo = ?, descripcion = ?, imagen = ?, codigo = ? where id =?;");
            $res = $sql->bind_param('siddsssi', $this->nombre, $this->existencias, $this->precio, $this->costo, $this->descripcion, $this->imagen, $this->codigo, $this->id);
            $sql->execute();
            $data = array();
            if ($res) {
                $data['estado'] = true;
                $data['descripcion'] = 'Datos eliminados exitosamente';
            } else {
                $data['estado'] = false;
                $data['descripcion'] = 'Ocurrio un error en la eliminación ' . $this->db->error;
            }
            $sql->close();
            $this->db->close();
        }

        return $data;
    }

}
