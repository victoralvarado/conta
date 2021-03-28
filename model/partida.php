<?php
require_once ("./config/conexion.php");
class Partida
{
    private $id;
    private $fecha;
    private $debe;
    private $haber;
    private $descripcion;
    private $compra_relacionada;
    private $venta_relacionada;
    private $plantilla_predeterminada;
    private $partida_reversion;
    private $partida_revertida;

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
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of compra_relacionada
     */ 
    public function getCompra_relacionada()
    {
        return $this->compra_relacionada;
    }

    /**
     * Set the value of compra_relacionada
     *
     * @return  self
     */ 
    public function setCompra_relacionada($compra_relacionada)
    {
        $this->compra_relacionada = $compra_relacionada;

        return $this;
    }

    /**
     * Get the value of venta_relacionada
     */ 
    public function getVenta_relacionada()
    {
        return $this->venta_relacionada;
    }

    /**
     * Set the value of venta_relacionada
     *
     * @return  self
     */ 
    public function setVenta_relacionada($venta_relacionada)
    {
        $this->venta_relacionada = $venta_relacionada;

        return $this;
    }

    /**
     * Get the value of plantilla_predeterminada
     */ 
    public function getPlantilla_predeterminada()
    {
        return $this->plantilla_predeterminada;
    }

    /**
     * Set the value of plantilla_predeterminada
     *
     * @return  self
     */ 
    public function setPlantilla_predeterminada($plantilla_predeterminada)
    {
        $this->plantilla_predeterminada = $plantilla_predeterminada;

        return $this;
    }

    /**
     * Get the value of partida_reversion
     */ 
    public function getPartida_reversion()
    {
        return $this->partida_reversion;
    }

    /**
     * Set the value of partida_reversion
     *
     * @return  self
     */ 
    public function setPartida_reversion($partida_reversion)
    {
        $this->partida_reversion = $partida_reversion;

        return $this;
    }

    /**
     * Get the value of partida_revertida
     */ 
    public function getPartida_revertida()
    {
        return $this->partida_revertida;
    }

    /**
     * Set the value of partida_revertida
     *
     * @return  self
     */ 
    public function setPartida_revertida($partida_revertida)
    {
        $this->partida_revertida = $partida_revertida;

        return $this;
    }
}