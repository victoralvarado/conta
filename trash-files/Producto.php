<?php 

require_once 'Conexion.php';

class Producto
{
	private $id;
    private $codigo;
	private $nombre;
    private $archivo;
    private $ruta;
	private $precio;
	private $descripcion;
	private $cantidad;
	private $minimo;
	private $idSubCatProd;
	private $estado;
	public $db;
	
	function __construct()
	{
		$this->db = conectar();
	}

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     *
     * @return self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * @param mixed $archivo
     *
     * @return self
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * @param mixed $ruta
     *
     * @return self
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     *
     * @return self
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     *
     * @return self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $cantidad
     *
     * @return self
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMinimo()
    {
        return $this->minimo;
    }

    /**
     * @param mixed $minimo
     *
     * @return self
     */
    public function setMinimo($minimo)
    {
        $this->minimo = $minimo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdSubCatProd()
    {
        return $this->idSubCatProd;
    }

    /**
     * @param mixed $idSubCatProd
     *
     * @return self
     */
    public function setIdSubCatProd($idSubCatProd)
    {
        $this->idSubCatProd = $idSubCatProd;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     *
     * @return self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     *
     * @return self
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }


    public function getAllProducto()
    {
        $sqlAll = "SELECT p.*, s.nombre as subcat FROM tbl_producto as p INNER JOIN cat_subcategoriasProducto as s ON p.idSubCatProd=s.id WHERE p.estado=1;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }


    public function getOneProducto($idProducto)
    {
        $sqlAll = "SELECT * FROM tbl_producto WHERE estado=1 AND id=".$idProducto;
        $info = $this->db->query($sqlAll);
        $arreglo = array();
        $data = $info->fetch_assoc();

        $arreglo['id']=$data['id'];
        $arreglo['codigo']=$data['codigo'];
        $arreglo['nombre']=$data['nombre'];
        $arreglo['ruta']=$data['ruta'];
        $arreglo['precio']=$data['precio'];
        $arreglo['descripcion']=$data['descripcion'];
        $arreglo['cantidad']=$data['cantidad'];
        $arreglo['minimo']=$data['minimo'];
        $arreglo['idSubCatProd']=$data['idSubCatProd'];
        $arreglo['estadoSen']=true;

        return $arreglo;
    }


	public function saveProducto()
	{
	    $sql="INSERT INTO tbl_producto values (0,'".$this->codigo."','".$this->nombre."','".$this->archivo."','".$this->ruta."',".$this->precio.",'".$this->descripcion."',".$this->cantidad.",".$this->minimo.",".$this->idSubCatProd.",1);";
	        $res=$this->db->query($sql);
	        $data=array();
	        if($res)
	        {
	            $data['estado']=true;
	            $data['descripcion']='Datos ingresado exitosamente';
	        }
	        else
	        {
	            $data['estado']=false;
	            $data['descripcion']='Ocurrio un error en la inserción '.$this->db->error;
	        }

	        return $data;
	}

	public function deleteProducto()
	{
	    $sql="UPDATE tbl_producto SET estado=0 WHERE id =".$this->id.";";
	        $res=$this->db->query($sql);
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

	        return $data;
	}


	public function updateProducto()
    {
        $sql="UPDATE tbl_producto SET codigo='".$this->codigo."', nombre='".$this->nombre."', ruta='".$this->ruta."', precio=".$this->precio.", descripcion='".$this->descripcion."', cantidad=".$this->cantidad.", minimo=".$this->minimo.", idSubCatProd=".$this->idSubCatProd." WHERE id=".$this->id.";";
        $res=$this->db->query($sql);
        $data=array();
        if($res)
        {
            $data['estado']=true;
            $data['descripcion']='Datos modificados exitosamente';
        }
        else
        {
            $data['estado']=false;
            $data['descripcion']='Ocurrio un error en la modificación '.$this->db->error;
        }

        return $data;
    }


    public function updatePSD()
    {
        $sql="UPDATE tbl_producto SET archivo='".$this->archivo."' WHERE id=".$this->id.";";
        $res=$this->db->query($sql);
        $data=array();
        if($res)
        {
            $data['estado']=true;
            $data['descripcion']='Datos modificados exitosamente';
        }
        else
        {
            $data['estado']=false;
            $data['descripcion']='Ocurrio un error en la modificación '.$this->db->error;
        }

        return $data;
    }


    public function getAlertStock()
    {
        $sqlAll = "SELECT * FROM tbl_producto WHERE cantidad <= minimo;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }

    public function countAlertStock()
    {
        $sqlAll = "SELECT * FROM tbl_producto WHERE cantidad <= minimo;";
        $info = $this->db->query($sqlAll);
        $reg = $info->num_rows;
            
        return $reg;
    }



}

 ?>