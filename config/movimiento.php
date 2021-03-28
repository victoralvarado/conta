<?php
require_once ("./config/conexion.php");
class Movimiento
{
    private $id;
    private $producto;
    private $cantidad;
    private $ultima_eistencia;
    private $precio;
    private $costo;
    private $ultimo_consto;
    private $descripcion;

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
     * Get the value of producto
     */ 
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set the value of producto
     *
     * @return  self
     */ 
    public function setProducto($producto)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */ 
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get the value of ultima_eistencia
     */ 
    public function getUltima_eistencia()
    {
        return $this->ultima_eistencia;
    }

    /**
     * Set the value of ultima_eistencia
     *
     * @return  self
     */ 
    public function setUltima_eistencia($ultima_eistencia)
    {
        $this->ultima_eistencia = $ultima_eistencia;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of costo
     */ 
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * Set the value of costo
     *
     * @return  self
     */ 
    public function setCosto($costo)
    {
        $this->costo = $costo;

        return $this;
    }

    /**
     * Get the value of ultimo_consto
     */ 
    public function getUltimo_consto()
    {
        return $this->ultimo_consto;
    }

    /**
     * Set the value of ultimo_consto
     *
     * @return  self
     */ 
    public function setUltimo_consto($ultimo_consto)
    {
        $this->ultimo_consto = $ultimo_consto;

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
}