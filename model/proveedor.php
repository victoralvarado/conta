<?php
require_once ("Conexion.php");
class Proveedor
{
    private $id;
    private $tipo;
    private $clasificacion;
    private $nit;
    private $nrc;
    private $nombre;
    private $razon_social;
    private $direccion;
    private $telefono;
    private $db;

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

    /**
     * Get the value of clasificacion
     */ 
    public function getClasificacion()
    {
        return $this->clasificacion;
    }

    /**
     * Set the value of clasificacion
     *
     * @return  self
     */ 
    public function setClasificacion($clasificacion)
    {
        $this->clasificacion = $clasificacion;

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
     * Get the value of razon_social
     */ 
    public function getRazon_social()
    {
        return $this->razon_social;
    }

    /**
     * Set the value of razon_social
     *
     * @return  self
     */ 
    public function setRazon_social($razon_social)
    {
        $this->razon_social = $razon_social;

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

    /**
     * Get the value of db
     */ 
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */ 
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    public function getAllProveedor()
    {
        $sqlAll = "SELECT * FROM Proveedor WHERE estado = 1;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows > 0) {

            $dato = $info;
        } else {

            $dato = false;
        }
        return $dato;
    }

    public function saveProveedor()
    {
        
        
        $estado = 1;
        $sql = $this->db->prepare("INSERT INTO Proveedor(tipo,clasificacion,nit,nrc,nombre,razon_social,direccion,telefono,estado) values (?,?,?,?,?,?,?,?,?);");
        $res = $sql->bind_param('iissssssi',$this->tipo,$this->clasificacion,$this->nit,$this->nrc,$this->nombre,$this->razon_social,$this->direccion,$this->telefono,$estado);
        $sql->execute();
        $data = array();
        if ($res) {
            echo "<script> alert('save'); </script>";
            $data['estado'] = true;
            $data['descripcion'] = 'Datos ingresado exitosamente';
        } else {
            echo "<script> alert('error'); </script>";
            $data['estado'] = false;
            $data['descripcion'] = 'Ocurrio un error en la inserción ' . $this->db->error;
        }
        $sql->close();
        $this->db->close();
        return $data;
    }

    public function deleteProveedor()
	{
            $sql = $this->db->prepare("UPDATE Proveedor SET estado = 0 where id =?;");
	        $res = $sql->bind_param('i',$this->id);
            $sql->execute();
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
            $sql->close();
            $this->db->close();
	        return $data;
	}
}