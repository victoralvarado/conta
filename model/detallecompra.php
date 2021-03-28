<?php
require_once ("./config/conexion.php");
class DetalleCompra
{
    private $id;
    private $compra;
    private $producto;
    private $cant;
    private $price;

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
     * Get the value of compra
     */ 
    public function getCompra()
    {
        return $this->compra;
    }

    /**
     * Set the value of compra
     *
     * @return  self
     */ 
    public function setCompra($compra)
    {
        $this->compra = $compra;

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
     * Get the value of cant
     */ 
    public function getCant()
    {
        return $this->cant;
    }

    /**
     * Set the value of cant
     *
     * @return  self
     */ 
    public function setCant($cant)
    {
        $this->cant = $cant;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}