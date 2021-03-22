<?php 
require_once 'Conexion.php';

class  DistribucionChile
{
	public $db;

	function __construct()
	{
		$this->db = conectar();
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

    public function getAllProvincias()
    {
        $sqlAll = "SELECT * FROM regions;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }

    public function getAllComunas($idProvincia)
    {
        $sqlAll = "SELECT * FROM communes WHERE region_id=".$idProvincia.";";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }

}

 ?>