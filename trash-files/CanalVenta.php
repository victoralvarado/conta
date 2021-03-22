<?php 
require_once 'Conexion.php';
	class CanalVenta
	{
		private $id;
		private $nombre;
        private $porCom;
        private $valCom;
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
    public function getPorCom()
    {
        return $this->porCom;
    }

    /**
     * @param mixed $porCom
     *
     * @return self
     */
    public function setPorCom($porCom)
    {
        $this->porCom = $porCom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValCom()
    {
        return $this->valCom;
    }

    /**
     * @param mixed $valCom
     *
     * @return self
     */
    public function setValCom($valCom)
    {
        $this->valCom = $valCom;

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


    public function getAllCanalVenta()
    {
        $sqlAll = "SELECT * FROM cat_canalVenta WHERE estado=1;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }


    public function getOneCanalVenta($idCanal)
    {
        $sqlAll = "SELECT * FROM cat_canalVenta WHERE estado=1 AND id=".$idCanal;
        $info = $this->db->query($sqlAll);
        $arreglo = array();
        $data = $info->fetch_assoc();

        $arreglo['id']=$data['id'];
        $arreglo['nombre']=$data['nombre'];
        $arreglo['porCom']=$data['porCom'];
        $arreglo['valCom']=$data['valCom'];
        $arreglo['estadoSen']=true;

        return $arreglo;
    }


    public function saveCV()
    {
        $sql="INSERT INTO cat_canalVenta values (0,'".$this->nombre."', ".$this->porCom.", ".$this->valCom.", 1);";
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

public function deleteCV()
{
    $sql="UPDATE cat_canalVenta SET estado=0 WHERE id =".$this->id.";";
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


public function updateCV()
    {
        $sql="UPDATE cat_canalVenta SET nombre='".$this->nombre."', porCom=".$this->porCom.", valCom=".$this->valCom." WHERE id=".$this->id.";";
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