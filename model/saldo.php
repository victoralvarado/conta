<?php
require_once ("./config/conexion.php")
class Saldo
{
    private $id;
    private $cuentaId;
    private $debe;
    private $haber;
    private $hasta;

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
     * Get the value of hasta
     */ 
    public function getHasta()
    {
        return $this->hasta;
    }

    /**
     * Set the value of hasta
     *
     * @return  self
     */ 
    public function setHasta($hasta)
    {
        $this->hasta = $hasta;

        return $this;
    }
}