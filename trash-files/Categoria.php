<?php 

require_once 'Conexion.php';

class Categoria
{
	private $id;
	private $nombre;
	private $estado;
	private $idFamilia;
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
    public function getIdFamilia()
    {
        return $this->idFamilia;
    }

    /**
     * @param mixed $idFamilia
     *
     * @return self
     */
    public function setIdFamilia($idFamilia)
    {
        $this->idFamilia = $idFamilia;

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


    public function getAllCatProd()
    {
        $sqlAll = "SELECT c.*, f.nombre as familia FROM cat_categoriasProducto as c INNER JOIN cat_familia as f ON c.idFamilia=f.id WHERE c.estado=1;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }


	public function saveCatProd()
	{
	    $sql="INSERT INTO cat_categoriasProducto values (0,'".$this->nombre."',".$this->idFamilia.",1);";
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

	public function deleteCatProd()
	{
	    $sql="UPDATE cat_categoriasProducto SET estado=0 WHERE id =".$this->id.";";
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

}

 ?>