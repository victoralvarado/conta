<?php

require_once "Conexion.php";

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

    public function saveDS()
    {
        $sql="INSERT INTO documento_serie VALUES (0, ".$this->inicia_desde.", ".$this->termina_en.", '".$this->serie."', '".$this->tipo."', 1);";
        $res=$this->db->query($sql);
        $data=array();
        if($res)
        {
            $data['estado']=true;
            $data['descripcion']='Datos ingresado exitosamente';
        }
        else
        {
            $data['estado']=false;
            $data['descripcion']='Ocurrio un error en la inserción '.$this->db->error;
        }

        return $data;
    }

    public function getAllDS()
    {
            $sql="SELECT * FROM documento_serie where estado = 1;";
            $data= $this->db->query($sql);
            if($data->num_rows>0)
            {
                $info=$data;
            }
            else
            {
                $info=null;
            }
        
        return $info;
    }

    public function getOneDS($id)
    {
        $sqlAll = "SELECT * FROM documento_serie WHERE id=".$id;
        $info = $this->db->query($sqlAll);
        $arreglo = array();
        $data = $info->fetch_assoc();

        $arreglo['id']=$data['id'];
        $arreglo['inicia_desde']=$data['inicia_desde'];
        $arreglo['termina_en']=$data['termina_en'];
        $arreglo['serie']=$data['serie'];
        $arreglo['tipo']=$data['tipo'];
        /*$arreglo['direccion']=$data['direccion'];
        $arreglo['razon_social']=$data['razon_social'];
        $arreglo['giro']=$data['giro'];
        $arreglo['telefono']=$data['telefono'];*/
        $arreglo['estadoSen']=true;
        return $arreglo;
    }

    public function updateDS()
    {
        $sql="UPDATE documento_serie SET inicia_desde=".$this->inicia_desde.", termina_en=".$this->termina_en.", serie='".$this->serie."', tipo='".$this->tipo."' WHERE id=".$this->id.";";
        $res=$this->db->query($sql);
        $data=array();
        if($res)
        {
            $data['estado']=true;
            $data['descripcion']='Datos ingresado exitosamente';
        }
        else
        {
            $data['estado']=false;
            $data['descripcion']='Ocurrio un error en la inserción '.$this->db->error;
        }

        return $data;
    }

    public function deleteDS()
    {
        $sql="UPDATE documento_serie SET estado=0 WHERE id=".$this->id.";";
        $res=$this->db->query($sql);
        $data=array();
        if($res)
        {
            $data['estado']=true;
            $data['descripcion']='Datos eliminados exitosamente';
        }
        else
        {
            $data['estado']=false;
            $data['descripcion']='Ocurrio un error en la eliminación '.$this->db->error;
        }

        return $data;
    }


}

?>