<?php 

require_once 'Conexion.php';

class Insumo
{
	private $id;
	private $nombre;
	private $cantidad;
	private $minimo;
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

    public function getAllInsumo()
    {
        $sqlAll = "SELECT * FROM tbl_insumo;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }

    public function getOneInsumo($idInsumo)
    {
        $sqlAll = "SELECT * FROM tbl_insumo WHERE id=".$idInsumo;
        $info = $this->db->query($sqlAll);
        $arreglo = array();
        $data = $info->fetch_assoc();

        $arreglo['id']=$data['id'];
        $arreglo['nombre']=$data['nombre'];
        $arreglo['cantidad']=$data['cantidad'];
        $arreglo['minimo']=$data['minimo'];
        $arreglo['estadoSen']=true;

        return $arreglo;
    }

    public function updateInsumo()
    {
        $sql="UPDATE tbl_insumo SET nombre='".$this->nombre."', cantidad=".$this->cantidad.", minimo=".$this->minimo." WHERE id=".$this->id.";";
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


    public function updateCantidadInsumo()
    {
        $sql="UPDATE tbl_insumo SET cantidad=".$this->cantidad." WHERE id=".$this->id.";";
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

    public function getAlertInsumo()
    {
        $sqlAll = "SELECT * FROM tbl_insumo WHERE cantidad <= minimo;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }

    public function countAlertInsumo()
    {
        $sqlAll = "SELECT * FROM tbl_insumo WHERE cantidad <= minimo;";
        $info = $this->db->query($sqlAll);
        $reg = $info->num_rows;
            
        return $reg;
    }

}

 ?>