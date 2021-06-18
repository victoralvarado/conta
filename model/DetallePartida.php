<?php
require_once("Conexion.php");
class DetallePartida
{
    private $id;
    private $partidaId;
    private $cuentaId;
    private $debe;
    private $haber;
    private $parcial;
    private $padre;
    private $db;

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
     * Get the value of partidaId
     */ 
    public function getPartidaId()
    {
        return $this->partidaId;
    }

    /**
     * Set the value of partidaId
     *
     * @return  self
     */ 
    public function setPartidaId($partidaId)
    {
        $this->partidaId = $partidaId;

        return $this;
    }

    /**
     * Get the value of cuentaId
     */ 
    public function getCuentaId()
    {
        return $this->cuentaId;
    }

    /**
     * Set the value of cuentaId
     *
     * @return  self
     */ 
    public function setCuentaId($cuentaId)
    {
        $this->cuentaId = $cuentaId;

        return $this;
    }

    /**
     * Get the value of debe
     */ 
    public function getDebe()
    {
        return $this->debe;
    }

    /**
     * Set the value of debe
     *
     * @return  self
     */ 
    public function setDebe($debe)
    {
        $this->debe = $debe;

        return $this;
    }

    /**
     * Get the value of haber
     */ 
    public function getHaber()
    {
        return $this->haber;
    }

    /**
     * Set the value of haber
     *
     * @return  self
     */ 
    public function setHaber($haber)
    {
        $this->haber = $haber;

        return $this;
    }

    /**
     * Get the value of parcial
     */ 
    public function getParcial()
    {
        return $this->parcial;
    }

    /**
     * Set the value of parcial
     *
     * @return  self
     */ 
    public function setParcial($parcial)
    {
        $this->parcial = $parcial;

        return $this;
    }

    /**
     * Get the value of padre
     */ 
    public function getPadre()
    {
        return $this->padre;
    }

    /**
     * Set the value of padre
     *
     * @return  self
     */ 
    public function setPadre($padre)
    {
        $this->padre = $padre;

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

    public function saveDPartida()
    {
        $estado = 1;
        $sql = $this->db->prepare("INSERT INTO c_detallePartida(partidaId, cuentaId, debe, haber, estado) values (?,?,?,?,?);");
        # s = string; i = int; d = decimal
        $res = $sql->bind_param('iiddi', $this->partidaId, $this->cuentaId, $this->debe, $this->haber, $estado);
        $sql->execute();
        $data = array();
        if ($res) {
            $data['estado'] = true;
            $data['descripcion'] = 'Datos ingresado exitosamente';
        } else {
            $data['estado'] = false;
            $data['descripcion'] = 'Ocurrio un error en la inserción ' . $this->db->error;
        }
        return $data;
    }
}
