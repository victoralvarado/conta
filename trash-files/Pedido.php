<?php 

require_once 'Conexion.php';

class Pedido
{
	private $id;
	private $nombreCliente;
	private $rut;
	private $email;
	private $whatsapp;
	private $direccionEnvio;
	private $direccionFacturacion;
	private $recibo;
	private $detallesProductos;
	private $totalPago;
    private $descuento;
	private $fecha;
    private $fechaEnt;
	private $comision;
    private $costoEntrega;
    private $serviciosAdicionales;
	private $notas;
    private $gananciaTotal;
	private $idUsuario;
	private $idEstado;
	private $idCanalVen;
	private $formaEnt;
    private $idServicio;
    private $estado;
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
    public function getDireccionEnvio()
    {
        return $this->direccionEnvio;
    }

    /**
     * @param mixed $direccionEnvio
     *
     * @return self
     */
    public function setDireccionEnvio($direccionEnvio)
    {
        $this->direccionEnvio = $direccionEnvio;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDireccionFacturacion()
    {
        return $this->direccionFacturacion;
    }

    /**
     * @param mixed $direccionFacturacion
     *
     * @return self
     */
    public function setDireccionFacturacion($direccionFacturacion)
    {
        $this->direccionFacturacion = $direccionFacturacion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecibo()
    {
        return $this->recibo;
    }

    /**
     * @param mixed $recibo
     *
     * @return self
     */
    public function setRecibo($recibo)
    {
        $this->recibo = $recibo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDetallesProductos()
    {
        return $this->detallesProductos;
    }

    /**
     * @param mixed $detallesProductos
     *
     * @return self
     */
    public function setDetallesProductos($detallesProductos)
    {
        $this->detallesProductos = $detallesProductos;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalPago()
    {
        return $this->totalPago;
    }

    /**
     * @param mixed $totalPago
     *
     * @return self
     */
    public function setTotalPago($totalPago)
    {
        $this->totalPago = $totalPago;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * @param mixed $descuento
     *
     * @return self
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     *
     * @return self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

     /**
     * @return mixed
     */
    public function getFechaEnt()
    {
        return $this->fechaEnt;
    }

    /**
     * @param mixed $fechaEnt
     *
     * @return self
     */
    public function setFechaEnt($fechaEnt)
    {
        $this->fechaEnt = $fechaEnt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getComision()
    {
        return $this->comision;
    }

    /**
     * @param mixed $comision
     *
     * @return self
     */
    public function setComision($comision)
    {
        $this->comision = $comision;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCostoEntrega()
    {
        return $this->costoEntrega;
    }

    /**
     * @param mixed $costoEntrega
     *
     * @return self
     */
    public function setCostoEntrega($costoEntrega)
    {
        $this->costoEntrega = $costoEntrega;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getServiciosAdicionales()
    {
        return $this->serviciosAdicionales;
    }

    /**
     * @param mixed $serviciosAdicionales
     *
     * @return self
     */
    public function setServiciosAdicionales($serviciosAdicionales)
    {
        $this->serviciosAdicionales = $serviciosAdicionales;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * @param mixed $notas
     *
     * @return self
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGananciaTotal()
    {
        return $this->gananciaTotal;
    }

    /**
     * @param mixed $gananciaTotal
     *
     * @return self
     */
    public function setGananciaTotal($gananciaTotal)
    {
        $this->gananciaTotal = $gananciaTotal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idUsuario
     *
     * @return self
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * @param mixed $idEstado
     *
     * @return self
     */
    public function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdCanalVen()
    {
        return $this->idCanalVen;
    }

    /**
     * @param mixed $idCanalVen
     *
     * @return self
     */
    public function setIdCanalVen($idCanalVen)
    {
        $this->idCanalVen = $idCanalVen;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormaEnt()
    {
        return $this->formaEnt;
    }

    /**
     * @param mixed $formaEnt
     *
     * @return self
     */
    public function setFormaEnt($formaEnt)
    {
        $this->formaEnt = $formaEnt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdServicio()
    {
        return $this->idServicio;
    }

    /**
     * @param mixed $idServicio
     *
     * @return self
     */
    public function setIdServicio($idServicio)
    {
        $this->idServicio = $idServicio;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     *
     * @return self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

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


    public function getAllPedido()
    {
        $sqlAll = "SELECT p.*, e.nombre as estadoPedido, c.nombre as canal, f.nombre as forma FROM tbl_pedido as p INNER JOIN cat_estado as e INNER JOIN cat_canalVenta as c INNER JOIN cat_formaEntrega as f ON (p.idEstado=e.id AND p.idCanalVen=c.id AND p.idFormaEnt=f.id) WHERE p.estado=1 ORDER BY id;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }


    public function getAllPedido4V($idUsuario)
    {
        $sqlAll = "SELECT p.*, e.nombre as estadoPedido, c.nombre as canal, f.nombre as forma FROM tbl_pedido as p INNER JOIN cat_estado as e INNER JOIN cat_canalVenta as c INNER JOIN cat_formaEntrega as f INNER JOIN tbl_usuario as u ON (p.idEstado=e.id AND p.idCanalVen=c.id AND p.idFormaEnt=f.id AND u.id=p.idUsuario) WHERE (p.estado=1 AND (e.id=1 OR (e.id=3 AND p.idUsuario=".$idUsuario.") OR (e.id=12 AND p.idUsuario=".$idUsuario.")));";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }


    public function getAllPedido4JV()
    {
        $sqlAll = "SELECT p.*, e.nombre as estadoPedido, c.nombre as canal, f.nombre as forma FROM tbl_pedido as p INNER JOIN cat_estado as e INNER JOIN cat_canalVenta as c INNER JOIN cat_formaEntrega as f ON (p.idEstado=e.id AND p.idCanalVen=c.id AND p.idFormaEnt=f.id) WHERE (p.estado=1 AND (e.id=1 OR e.id=13 OR e.id=15));";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }


    public function getAllPedido4JP()
    {
        $sqlAll = "SELECT p.*, e.nombre as estadoPedido, c.nombre as canal, f.nombre as forma FROM tbl_pedido as p INNER JOIN cat_estado as e INNER JOIN cat_canalVenta as c INNER JOIN cat_formaEntrega as f ON (p.idEstado=e.id AND p.idCanalVen=c.id AND p.idFormaEnt=f.id) WHERE (p.estado=1 AND (e.id=2 OR e.id=4 OR e.id=5 OR e.id=6 OR e.id=9));";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            $dato = $info;
        }else{
            $dato = false;
        }
        return $dato;
    }

    public function getAllPedido4QA()
    {
        $sqlAll = "SELECT p.*, e.nombre as estadoPedido, c.nombre as canal, f.nombre as forma FROM tbl_pedido as p INNER JOIN cat_estado as e INNER JOIN cat_canalVenta as c INNER JOIN cat_formaEntrega as f ON (p.idEstado=e.id AND p.idCanalVen=c.id AND p.idFormaEnt=f.id) WHERE (p.estado=1 AND (e.id=7));";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            $dato = $info;
        }else{
            $dato = false;
        }
        return $dato;
    }


    public function getAllPedido4D()
    {
        $sqlAll = "SELECT p.*, e.nombre as estadoPedido, c.nombre as canal, f.nombre as forma FROM tbl_pedido as p INNER JOIN cat_estado as e INNER JOIN cat_canalVenta as c INNER JOIN cat_formaEntrega as f ON (p.idEstado=e.id AND p.idCanalVen=c.id AND p.idFormaEnt=f.id) WHERE (p.estado=1 AND (e.id=8 OR e.id=10 OR e.id=11 OR e.id=14));";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows>0) {
            
            $dato = $info;
        }else{

            $dato = false;
        }
        return $dato;
    }


    public function getOnePedido($idPedido)
    {
        $sqlAll = "SELECT * FROM tbl_pedido WHERE estado=1 AND id=".$idPedido;
        $info = $this->db->query($sqlAll);
        $arreglo = array();
        $data = $info->fetch_assoc();

        $arreglo['id']=$data['id'];
        $arreglo['nombreCliente']=$data['nombreCliente'];
        $arreglo['RUT']=$data['RUT'];
        $arreglo['email']=$data['email'];
        $arreglo['whatsapp']=$data['whatsapp'];
        //////////////////////////////////////////////////////////////
        $envio = explode('_',$data['direccionEnvio']);
        $factura = explode('_',$data['direccionFacturacion']);
        $arreglo['de1']=$envio[0];
        $arreglo['de2']=$envio[1];
        $arreglo['de3']=$envio[2];
        $arreglo['de4']=$envio[3];
        $arreglo['df1']=$factura[0];
        $arreglo['df2']=$factura[1];
        $arreglo['df3']=$factura[2];
        $arreglo['df4']=$factura[3];
        //////////////////////////////////////////////////////////////
        $arreglo['recibo']=$data['recibo'];
        $arreglo['detalleProductos']=$data['detalleProductos'];
        $arreglo['totalPago']=$data['totalPago'];
        $arreglo['descuento']=$data['descuento'];
        $arreglo['fecha']=$data['fecha'];
        $arreglo['comision']=$data['comision'];
        $arreglo['costoEntrega']=$data['costoEntrega'];
        $arreglo['serviciosAdicionales']=$data['serviciosAdicionales'];
        $arreglo['notas']=$data['notas'];
        $arreglo['gananciaTotal']=$data['gananciaTotal'];
        $arreglo['idEstado']=$data['idEstado'];
        $arreglo['idCanalVen']=$data['idCanalVen'];
        $arreglo['idFormaEnt']=$data['idFormaEnt'];
        $arreglo['idServicio']=$data['idServicio'];
        $arreglo['fechaEnt']=$data['fechaEnt'];
        $arreglo['estadoSen']=true;

        return $arreglo;
    }


    public function savePedido()
	{
		session_start();
		$now=(new \DateTime())->format('d/m/Y h:i a');
	    $sql="INSERT INTO tbl_pedido values (0,'".$this->nombreCliente."','".$this->rut."','".$this->email."','".$this->whatsapp."','".$this->direccionEnvio."','".$this->direccionFacturacion."','".$this->recibo."','".$this->detallesProductos."',".$this->totalPago.",".$this->descuento.",'".$now."','".$this->fechaEnt."',".$this->comision.",".$this->costoEntrega.",".$this->serviciosAdicionales.",'".$this->notas."','".$this->gananciaTotal."',".$_SESSION['ID'].",".$this->idEstado.",".$this->idCanalVen.",".$this->formaEnt.",".$this->idServicio.",1);";
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

	public function updateCant($sql)
	{
		$res=$this->db->query($sql);
	}


	public function deletePedido()
	{
	    $sql="UPDATE tbl_pedido SET estado=0 WHERE id =".$this->id.";";
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


	public function updatePedido()
    {
        $sql="UPDATE tbl_pedido SET nombreCliente='".$this->nombreCliente."', RUT='".$this->rut."', email='".$this->email."', whatsapp='".$this->whatsapp."', direccionEnvio='".$this->direccionEnvio."', direccionFacturacion='".$this->direccionFacturacion."', recibo='".$this->recibo."', detalleProductos='".$this->detallesProductos."', totalPago=".$this->totalPago.", descuento=".$this->descuento.", fechaEnt='".$this->fechaEnt."', comision=".$this->comision.", costoEntrega=".$this->costoEntrega.", serviciosAdicionales=".$this->serviciosAdicionales.", gananciaTotal='".$this->gananciaTotal."', idEstado=".$this->idEstado.", idCanalVen=".$this->idCanalVen.", idFormaEnt=".$this->formaEnt.", idServicio=".$this->idServicio." WHERE id=".$this->id.";";
        $res=$this->db->query($sql);
        $data=array();
        if($res)
        {
            $data['estado']=true;
            $data['descripcion']='Datos modificados exitosamente';
        }
        else
        {
            $data['estado']=false;
            $data['descripcion']=$sql."\nOcurrio un error en la inserción: ".$this->db->error;
        }

        return $data;
    }

    public function updateEstadoPedido()
    {
        $sql="UPDATE tbl_pedido SET notas='".$this->notas."', idEstado=".$this->idEstado." WHERE id=".$this->id.";";
        $res=$this->db->query($sql);
        $data=array();
        if($res)
        {
            $data['estado']=true;
            $data['descripcion']='Datos modificados exitosamente';
        }
        else
        {
            $data['estado']=false;
            $data['descripcion']=$sql."\nOcurrio un error en la inserción: ".$this->db->error;
        }

        return $data;
    }


    public function saveVenta($idPedido, $nc, $rut, $email, $wp, $recibo, $prod, $valorVenta, $descuento, $com, $costoEnt, $sa, $notas, $gananciaTotal, $idCanalVen, $idFormaEnt, $idServicio)
    {
		$now=date("d/m/Y h:i a", strtotime("now +3 GMT"));
		$nowDB=(new \DateTime())->format('Y-m-d H:i:s');
	    $sql="INSERT INTO tbl_venta values (0,'".$nc."','".$rut."','".$email."','".$wp."','".$recibo."','".$prod."',".$valorVenta.",'".$now."','".$nowDB."',".$descuento.",".$com.",".$costoEnt.",".$sa.",'".$notas."',".$gananciaTotal.",".$idPedido.",".$idCanalVen.",".$idFormaEnt.",".$idServicio.",1);";
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

    public function execute($sql)
    {
        $res=$this->db->query($sql);
        $data=array();
        if($res)
        {
            $data['estado']=true;
            $data['descripcion']='Datos modificados exitosamente';
        }
        else
        {
            $data['estado']=false;
            $data['descripcion']=$sql."\nOcurrio un error en la inserción: ".$this->db->error;
        }

        return $data;
    }

    public function ultimaID()
    {
        $sqlAll = "SELECT MAX(id) AS ultima FROM tbl_pedido;";
        $info = $this->db->query($sqlAll);
        $arreglo = array();
        $data = $info->fetch_assoc();

        $id=$data['ultima'];
        return $id;
    }
    
    
}

 ?>