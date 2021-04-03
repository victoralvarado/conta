<?php
require_once ("./config/conexion.php");
class DetallePartida
{
    private $id;
    private $partidaId;
    private $cuentaId;
    private $debe;
    private $haber;
    private $parcial;
    private $padre;

    public function __construct() {
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
}
