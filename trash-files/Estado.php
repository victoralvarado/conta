<?php

require_once 'Conexion.php';

class Estado
{
	private $id;
	private $nombre;
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


    public function getAllEstado()
    {
        $sqlAll = "SELECT * FROM cat_estado WHERE estado=1;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }


    public function getAllEstado4JV()
    {
        $sqlAll = "SELECT * FROM cat_estado WHERE (estado=1 AND (id=2 OR id=3 OR id=16 OR id=17));";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }


    public function getAllEstado4JP()
    {
        $sqlAll = "SELECT * FROM cat_estado WHERE (estado=1 AND (id=4 OR id=5 OR id=6 OR id=7));";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }


    public function getAllEstado4D()
    {
        $sqlAll = "SELECT * FROM cat_estado WHERE (estado=1 AND (id=10 OR id=11 OR id=12  OR id=15));";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }

    public function getAllEstado4QA()
    {
        $sqlAll = "SELECT * FROM cat_estado WHERE (estado=1 AND (id=8 OR id=9));";
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