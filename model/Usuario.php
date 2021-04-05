<?php
require_once("Conexion.php");

class Usuario
{
    private $id;
    private $nombre;
    private $usuario;
    private $contra;
    private $inentos;
    private $estado;
    public $db;

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

    public function saveUser()
    {
        $sql="INSERT INTO usuario values (0,'".$this->nombre."','".$this->usuario."','".$this->contra."',5,1);";
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
                $data['descripcion']=$sql."\nOcurrio un error en la inserción: ".$this->db->error;
            }

            return $data;
    }

    public function login()
    {
        $sql = "SELECT id, nombre, usuario, intentos, estado FROM usuario WHERE usuario='".$this->usuario."'  AND contra='".sha1($this->contra)."';";
        $info = $this->db->query($sql);
        if ($info->num_rows>0) {
            $data = $info->fetch_assoc();
            $estado = $data['estado'];
            if($estado=='activo')
            {
                session_start();
                $_SESSION['ID']=$data['id'];
                $_SESSION['USER']=$data['usuario'];
                $_SESSION['NOMBRE']=$data['nombre'];
                if($data['intentos']>0)
                {
                    $sql2="UPDATE usuario SET intentos=5 WHERE usuario = '".$this->usuario."' ;";
                    $res2=$this->db->query($sql2);
                }
            }
            else if($estado=='bloqueado')
            {
                    $data['estado']=true;
                    $data['descripcion']='baneado';
                    session_destroy();
            }
        }else{

            $data = false;
        }
        return $data;
    }

    public function errorLogin()
    {
        $sqlNum = "SELECT intentos FROM usuario WHERE usuario='".$this->usuario."' ";
        $info = $this->db->query($sqlNum);
        if ($info->num_rows>0) {
            $data = $info->fetch_assoc();
            $numint=$data['intentos'];
            if($numint < 1)
            {
                $data['estado']=true;
                $data['descripcion']='baneado';
            }
            else
            {
                $numint=$numint-1;
                $sql="UPDATE usuario SET intentos=".$numint." WHERE usuario = '".$this->usuario."' ;";
                $res=$this->db->query($sql);
                    if($numint == 0)
                    {
                        $sql2="UPDATE usuario SET estado='bloqueado' WHERE usuario = '".$this->usuario."' ;";
                        $res2=$this->db->query($sql2);
                    }
                $data=array();
                if($res)
                {
                    if($numint == 0)
                    {
                        $data['estado']=true;
                        $data['descripcion']='baneado';
                    }
                    else
                    {
                        $data['estado']=true;
                        $data['descripcion']='Datos actualizados exitosamente';
                    }
                }
                else
                {
                    $data['estado']=false;
                    $data['descripcion']=$sql."\nOcurrio un error en la actualización: ".$this->db->error;
                }
            }   
        }else{

            $data = false;
        }

        return $data;
    }
}
