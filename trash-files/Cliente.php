<?php 

require_once 'Conexion.php';

class Cliente
{

	private $id;
	private $nombreCliente;
	private $rut;
	private $email;
	private $whatsapp;
	public $db;
	
	function __construct()
	{
		$this->db = conectar();
	}


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNombreCliente()
    {
        return $this->nombreCliente;
    }

    /**
     * @param mixed $nombreCliente
     *
     * @return self
     */
    public function setNombreCliente($nombreCliente)
    {
        $this->nombreCliente = $nombreCliente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * @param mixed $rut
     *
     * @return self
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWhatsapp()
    {
        return $this->whatsapp;
    }

    /**
     * @param mixed $whatsapp
     *
     * @return self
     */
    public function setWhatsapp($whatsapp)
    {
        $this->whatsapp = $whatsapp;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     *
     * @return self
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    public function getOneCliente($rut)
    {
    	$sqlAll = "SELECT * FROM tbl_cliente WHERE RUT='".$rut."';";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            $arreglo = array();
	        $data = $info->fetch_assoc();

	        $arreglo['id']=$data['id'];
	        $arreglo['nombreCliente']=$data['nombreCliente'];
	        $arreglo['RUT']=$data['RUT'];
	        $arreglo['email']=$data['email'];
	        $arreglo['whatsapp']=$data['whatsapp'];
        }else{

            $arreglo = false;
        }
        return $arreglo; 
    }

    public function saveCliente()
	{
	    $sql="INSERT INTO tbl_cliente values (0,'".$this->nombreCliente."','".$this->rut."','".$this->email."','".$this->whatsapp."');";
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
}

?>