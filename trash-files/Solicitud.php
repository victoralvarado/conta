<?php 

require_once 'Conexion.php';

class Solicitud
{
	private $id;
	private $nombreCliente;
	private $RUT;
	private $codigo;
	private $nombre;
	private $imgEntrada;
	private $imgSalida;
	private $archivo;
	private $precio;
	private $descripcion;
	private $notas;
	private $idSubCatProd;
    private $idPedido;
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
    public function getNombreCliente()
    {
        return $this->nombreCliente;
    }

    /**
     * @param mixed $nombreCliente
     *
     * @return self
     */
    public function setNombreCliente($nombreCliente)
    {
        $this->nombreCliente = $nombreCliente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRUT()
    {
        return $this->RUT;
    }

    /**
     * @param mixed $RUT
     *
     * @return self
     */
    public function setRUT($RUT)
    {
        $this->RUT = $RUT;

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
    public function getImgEntrada()
    {
        return $this->imgEntrada;
    }

    /**
     * @param mixed $imgEntrada
     *
     * @return self
     */
    public function setImgEntrada($imgEntrada)
    {
        $this->imgEntrada = $imgEntrada;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImgSalida()
    {
        return $this->imgSalida;
    }

    /**
     * @param mixed $imgSalida
     *
     * @return self
     */
    public function setImgSalida($imgSalida)
    {
        $this->imgSalida = $imgSalida;

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
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * @param mixed $notas
     *
     * @return self
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;

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
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * @param mixed $idPedido
     *
     * @return self
     */
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;

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

    public function getAllSolicitudPed()
    {
        $sqlAll = "SELECT s.*, sc.nombre as sub FROM tbl_solicitud as s INNER JOIN cat_subcategoriasProducto as sc ON (s.idSubCatProd=sc.id) WHERE s.estado=4;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }

    public function getAllSolicitudV()
    {
        $sqlAll = "SELECT s.*, sc.nombre as sub FROM tbl_solicitud as s INNER JOIN cat_subcategoriasProducto as sc ON (s.idSubCatProd=sc.id) WHERE s.estado=2;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }

    public function getAllSolicitudJP()
    {
        $sqlAll = "SELECT s.*, sc.nombre as sub FROM tbl_solicitud as s INNER JOIN cat_subcategoriasProducto as sc ON (s.idSubCatProd=sc.id) WHERE (s.estado=1 OR s.estado=3);";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }


    public function countSolicitudV()
    {
        $sqlAll = "SELECT s.*, sc.nombre as sub FROM tbl_solicitud as s INNER JOIN cat_subcategoriasProducto as sc ON (s.idSubCatProd=sc.id) WHERE s.estado=2;";
        $info = $this->db->query($sqlAll);
        $arreglo = array();
        $arreglo['num']=$info->num_rows;
        $arreglo['rol']=2;
        $arreglo['estado']=1;
        return $arreglo;
    }

    public function countSolicitudJP()
    {
        $sqlAll = "SELECT s.*, sc.nombre as sub FROM tbl_solicitud as s INNER JOIN cat_subcategoriasProducto as sc ON (s.idSubCatProd=sc.id) WHERE (s.estado=1 OR s.estado=3);";
        $info = $this->db->query($sqlAll);
        $arreglo = array();
        $arreglo['num']=$info->num_rows;
        $arreglo['rol']=4;
        $arreglo['estado']=1;
        return $arreglo;
    }


    public function getOneSolicitud($idSolicitud)
    {
        $sqlAll = "SELECT * FROM tbl_solicitud WHERE estado!=0 AND id=".$idSolicitud;
        $info = $this->db->query($sqlAll);
        $arreglo = array();
        $data = $info->fetch_assoc();

        $arreglo['id']=$data['id'];
        $arreglo['nombreCliente']=$data['nombreCliente'];
        $arreglo['RUT']=$data['RUT'];
        $arreglo['codigo']=$data['codigo'];
        $arreglo['nombre']=$data['nombre'];
        $arreglo['precio']=$data['precio'];
        $arreglo['archivo']=$data['archivo'];
        $arreglo['descripcion']=$data['descripcion'];
        $arreglo['notas']=$data['notas'];
        $arreglo['idSubCatProd']=$data['idSubCatProd'];
        $arreglo['estadoSen']=true;

        return $arreglo;
    }


    public function saveSolicitud()
    {
        $sql="INSERT INTO tbl_solicitud values (0,'".$this->nombreCliente."', '".$this->RUT."', '".$this->codigo."', '".$this->nombre."', '".$this->imgEntrada."', 'dummy', 'dummy', 0, 'dummy', '".$this->notas."', 1, ".$this->idPedido.", 1);";
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

	public function deleteSolicitud()
	{
	    $sql="UPDATE tbl_solicitud SET estado=0 WHERE id =".$this->id.";";
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

	public function banSolicitud()
	{
	    $sql="UPDATE tbl_solicitud SET estado=3, notas='".$this->notas."' WHERE id =".$this->id.";";
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

	public function goodSolicitud()
	{
	    $sql="UPDATE tbl_solicitud SET estado=4 WHERE id =".$this->id.";";
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


	public function updateSolicitud()
    {
        $sql="UPDATE tbl_solicitud SET codigo='".$this->codigo."', nombre='".$this->nombre."', imgSalida='".$this->imgSalida."', archivo='".$this->archivo."', precio=".$this->precio.", descripcion='".$this->descripcion."', notas='".$this->notas."', idSubCatProd=".$this->idSubCatProd.", estado=".$this->estado." WHERE id=".$this->id.";";
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


    public function updateSol()
    {
        $sql="UPDATE tbl_solicitud SET codigo='".$this->codigo."', nombre='".$this->nombre."', archivo='".$this->archivo."',  precio=".$this->precio.", descripcion='".$this->descripcion."' WHERE id=".$this->id.";";
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


    public function updateSolPSD()
    {
        $sql="UPDATE tbl_solicitud SET imgSalida='".$this->archivo."' WHERE id=".$this->id.";";
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

    
}

 ?>