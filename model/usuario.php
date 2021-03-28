<?php
require_once("./config/conexion.php");

class Usuario
{
    private $id;
    private $nombre;
    private $usuario;
    private $contra;
    private $inentos;
    private $estado;

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
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of contra
     */ 
    public function getContra()
    {
        return $this->contra;
    }

    /**
     * Set the value of contra
     *
     * @return  self
     */ 
    public function setContra($contra)
    {
        $this->contra = $contra;

        return $this;
    }

    /**
     * Get the value of inentos
     */ 
    public function getInentos()
    {
        return $this->inentos;
    }

    /**
     * Set the value of inentos
     *
     * @return  self
     */ 
    public function setInentos($inentos)
    {
        $this->inentos = $inentos;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}