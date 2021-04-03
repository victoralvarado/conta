<?php
require_once ("./config/conexion.php");
class Compra
{
    private $id;
    private $afectas;
    private $iva;
    private $retencion;
    private $proveedor;
    private $fecha;
    private $registrado_por;
    private $condiciones;

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
     * Get the value of afectas
     */ 
    public function getAfectas()
    {
        return $this->afectas;
    }

    /**
     * Set the value of afectas
     *
     * @return  self
     */ 
    public function setAfectas($afectas)
    {
        $this->afectas = $afectas;

        return $this;
    }

    /**
     * Get the value of iva
     */ 
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set the value of iva
     *
     * @return  self
     */ 
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    /**
     * Get the value of retencion
     */ 
    public function getRetencion()
    {
        return $this->retencion;
    }

    /**
     * Set the value of retencion
     *
     * @return  self
     */ 
    public function setRetencion($retencion)
    {
        $this->retencion = $retencion;

        return $this;
    }

    /**
     * Get the value of proveedor
     */ 
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set the value of proveedor
     *
     * @return  self
     */ 
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of registrado_por
     */ 
    public function getRegistrado_por()
    {
        return $this->registrado_por;
    }

    /**
     * Set the value of registrado_por
     *
     * @return  self
     */ 
    public function setRegistrado_por($registrado_por)
    {
        $this->registrado_por = $registrado_por;

        return $this;
    }

    /**
     * Get the value of condiciones
     */ 
    public function getCondiciones()
    {
        return $this->condiciones;
    }

    /**
     * Set the value of condiciones
     *
     * @return  self
     */ 
    public function setCondiciones($condiciones)
    {
        $this->condiciones = $condiciones;

        return $this;
    }
}
