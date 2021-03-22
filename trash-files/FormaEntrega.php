<?php 

require_once 'Conexion.php';

class FormaEntrega
{
	private $id;
	private $nombre;
    private $costo;
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
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @param mixed $costo
     *
     * @return self
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;

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

    public function getAllFormaEntrega()
    {
        $sqlAll = "SELECT * FROM cat_formaEntrega WHERE estado=1;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }

    public function getOneFormaEntrega($idForma)
    {
        $sqlAll = "SELECT * FROM cat_formaEntrega WHERE estado=1 AND id=".$idForma;
        $info = $this->db->query($sqlAll);
        $arreglo = array();
        $data = $info->fetch_assoc();

        $arreglo['id']=$data['id'];
        $arreglo['nombre']=$data['nombre'];
        $arreglo['costo']=$data['costo'];
        $arreglo['estadoSen']=true;

        return $arreglo;
    }


	public function saveFE()
	{
	    $sql="INSERT INTO cat_formaEntrega values (0,'".$this->nombre."','".$this->costo."',1);";
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

	public function deleteFE()
	{
	    $sql="UPDATE cat_formaEntrega SET estado=0 WHERE id =".$this->id.";";
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


    public function updateFE()
    {
        $sql="UPDATE cat_formaEntrega SET nombre='".$this->nombre."', costo='".$this->costo."' WHERE id=".$this->id.";";
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