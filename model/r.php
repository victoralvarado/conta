<?php
require_once ("./config/conexion.php");
class DocumentoSerie
{
    private $id;
    private $inicia_desde;
    private $termina_en;
    private $serie;
    private $tipo;

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
     * Get the value of inicia_desde
     */ 
    public function getInicia_desde()
    {
        return $this->inicia_desde;
    }

    /**
     * Set the value of inicia_desde
     *
     * @return  self
     */ 
    public function setInicia_desde($inicia_desde)
    {
        $this->inicia_desde = $inicia_desde;

        return $this;
    }

    /**
     * Get the value of termina_en
     */ 
    public function getTermina_en()
    {
        return $this->termina_en;
    }

    /**
     * Set the value of termina_en
     *
     * @return  self
     */ 
    public function setTermina_en($termina_en)
    {
        $this->termina_en = $termina_en;

        return $this;
    }

    /**
     * Get the value of serie
     */ 
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set the value of serie
     *
     * @return  self
     */ 
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }
}