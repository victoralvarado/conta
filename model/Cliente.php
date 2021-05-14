<?php
require_once('Conexion.php');
class Cliente
{
    private $id;
    private $nombre;
    private $clasificacion;
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

    public function saveCliente()
    {
        $sql="INSERT INTO cliente VALUES (0, '".$this->nombre."','".$this->clasificacion."', '".$this->direccion."', '".$this->nit."', '".$this->nrc."', '".$this->razon_social."', '".$this->giro."', '".$this->telefono."', 1);";
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

    public function getAllClientes()
    {
            $sql="SELECT * FROM cliente where estado = 1;";
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

    public function getOneCliente($id)
    {
        $sqlAll = "SELECT * FROM cliente WHERE id=".$id;
        $info = $this->db->query($sqlAll);
        $arreglo = array();
        $data = $info->fetch_assoc();

        $arreglo['id']=$data['id'];
        $arreglo['clasificacion']=$data['clasificacion'];
        $arreglo['nombre']=$data['nombre'];
        $arreglo['nit']=$data['nit'];
        $arreglo['nrc']=$data['nrc'];
        $arreglo['direccion']=$data['direccion'];
        $arreglo['razon_social']=$data['razon_social'];
        $arreglo['giro']=$data['giro'];
        $arreglo['telefono']=$data['telefono'];
        $arreglo['estadoSen']=true;
        return $arreglo;
    }

    public function updateCliente()
    {
        $sql="UPDATE cliente SET nombre='".$this->nombre."', clasificacion='".$this->clasificacion."', direccion='".$this->direccion."', nit='".$this->nit."', nrc='".$this->nrc."', razon_social='".$this->razon_social."', giro='".$this->giro."', telefono='".$this->telefono."' WHERE id=".$this->id.";";
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

    public function deleteCliente()
    {
        $sql="UPDATE cliente SET estado=0 WHERE id=".$this->id.";";
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