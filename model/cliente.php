<?php
require_once('./config/conexion.php');
class Cliente
{
    private $id;
    private $nombre;
    private $classificacion;
    private $direccion;
    private $nit;
    private $nrc;
    private $razon_social;
    private $giro;
    private $telefono;


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
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of classificacion
     */
    public function getClassificacion()
    {
        return $this->classificacion;
    }

    /**
     * Set the value of classificacion
     *
     * @return  self
     */
    public function setClassificacion($classificacion)
    {
        $this->classificacion = $classificacion;

        return $this;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of nit
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * Set the value of nit
     *
     * @return  self
     */
    public function setNit($nit)
    {
        $this->nit = $nit;

        return $this;
    }

    /**
     * Get the value of nrc
     */
    public function getNrc()
    {
        return $this->nrc;
    }

    /**
     * Set the value of nrc
     *
     * @return  self
     */
    public function setNrc($nrc)
    {
        $this->nrc = $nrc;

        return $this;
    }

    /**
     * Get the value of razon_social
     */
    public function getRazonSocial()
    {
        return $this->razon_social;
    }

    /**
     * Set the value of razon_social
     *
     * @return  self
     */
    public function setRazonSocial($razon_social)
    {
        $this->razon_social = $razon_social;

        return $this;
    }

    /**
     * Get the value of giro
     */
    public function getGiro()
    {
        return $this->giro;
    }

    /**
     * Set the value of giro
     *
     * @return  self
     */
    public function setGiro($giro)
    {
        $this->giro = $giro;

        return $this;
    }

    /**
     * Get the value of telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }
}
