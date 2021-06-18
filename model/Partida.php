<?php
require_once("Conexion.php");
class Partida
{
    private $id;
    private $fecha;
    private $debe;
    private $haber;
    private $descripcion;
    private $compra_relacionada;
    private $venta_relacionada;
    private $plantilla_predeterminada;
    private $partida_reversion;
    private $partida_revertida;
    private $db;

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
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of debe
     */
    public function getDebe()
    {
        return $this->debe;
    }

    /**
     * Set the value of debe
     *
     * @return  self
     */
    public function setDebe($debe)
    {
        $this->debe = $debe;

        return $this;
    }

    /**
     * Get the value of haber
     */
    public function getHaber()
    {
        return $this->haber;
    }

    /**
     * Set the value of haber
     *
     * @return  self
     */
    public function setHaber($haber)
    {
        $this->haber = $haber;

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

    /**
     * Get the value of compra_relacionada
     */
    public function getCompra_relacionada()
    {
        return $this->compra_relacionada;
    }

    /**
     * Set the value of compra_relacionada
     *
     * @return  self
     */
    public function setCompra_relacionada($compra_relacionada)
    {
        $this->compra_relacionada = $compra_relacionada;

        return $this;
    }

    /**
     * Get the value of venta_relacionada
     */
    public function getVenta_relacionada()
    {
        return $this->venta_relacionada;
    }

    /**
     * Set the value of venta_relacionada
     *
     * @return  self
     */
    public function setVenta_relacionada($venta_relacionada)
    {
        $this->venta_relacionada = $venta_relacionada;

        return $this;
    }

    /**
     * Get the value of plantilla_predeterminada
     */
    public function getPlantilla_predeterminada()
    {
        return $this->plantilla_predeterminada;
    }

    /**
     * Set the value of plantilla_predeterminada
     *
     * @return  self
     */
    public function setPlantilla_predeterminada($plantilla_predeterminada)
    {
        $this->plantilla_predeterminada = $plantilla_predeterminada;

        return $this;
    }

    /**
     * Get the value of partida_reversion
     */
    public function getPartida_reversion()
    {
        return $this->partida_reversion;
    }

    /**
     * Set the value of partida_reversion
     *
     * @return  self
     */
    public function setPartida_reversion($partida_reversion)
    {
        $this->partida_reversion = $partida_reversion;

        return $this;
    }

    /**
     * Get the value of partida_revertida
     */
    public function getPartida_revertida()
    {
        return $this->partida_revertida;
    }

    /**
     * Set the value of partida_revertida
     *
     * @return  self
     */
    public function setPartida_revertida($partida_revertida)
    {
        $this->partida_revertida = $partida_revertida;

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

    public function savePartida()
    {
        $estado = 1;
        $sql = $this->db->prepare("INSERT INTO c_Partida(fecha,debe,haber,descripcion,compra_relacionada,estado) values (?,?,?,?,?,?);");
        # s = string; i = int; d = decimal
        $res = $sql->bind_param('sddsii', $this->fecha, $this->debe, $this->haber, $this->descripcion, $this->compra_relacionada, $estado);
        $sql->execute();
        $data = array();
        if ($res) {
            $data['estado'] = true;
            $data['descripcion'] = 'Datos ingresado exitosamente';
        } else {
            $data['estado'] = false;
            $data['descripcion'] = 'Ocurrio un error en la inserción ' . $this->db->error;
        }
        return $data;
    }

    public function ultmimoId()
    {
        $info = $this->db->prepare("SELECT MAX(id) FROM c_Partida;");
        $info->execute();
        $resultado = $info->get_result();
        $fila = $resultado->fetch_assoc();
        return $fila['MAX(id)'];
    }

    public function libroDiario($fecha)
    {
        $sqlAll = "SELECT c_cuentas.codigo , c_cuentas.nombre , c_partida.fecha, c_partida.descripcion, c_partida.id as numero
        , c_detallePartida.debe, c_detallePartida.haber,c_detallePartida.cuentaId as id_cuentas 
        from c_partida inner join c_detallePartida on c_detallePartida.partidaId = c_partida.id 
        inner join c_cuentas on c_detallePartida.cuentaId=c_cuentas.id where c_partida.fecha = '".$fecha."' ORDER by c_partida.id;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows > 0) {
            $dato = $info;
        } else {
            $dato = false;
        }
        return $dato;
    }

    public function libroDiarioR($id,$fecha)
    {
        $sqlAll = "SELECT c_cuentas.codigo , c_cuentas.nombre , c_partida.fecha, c_partida.descripcion, c_partida.id as numero
        , c_detallePartida.debe, c_detallePartida.haber,c_detallePartida.cuentaId as id_cuentas 
        from c_partida inner join c_detallePartida on c_detallePartida.partidaId = c_partida.id 
        inner join c_cuentas on c_detallePartida.cuentaId=c_cuentas.id where  c_partida.id = ".$id." and c_partida.fecha = '".$fecha."';";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows > 0) {
            $dato = $info;
        } else {
            $dato = false;
        }
        return $dato;
    }

    public function partidas($fecha)
    {
        $sqlAll = "SELECT id as numpartida, fecha AS fepartida FROM c_partida where c_partida.fecha = '".$fecha."';";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows > 0) {
            $dato = $info;
        } else {
            $dato = false;
        }
        return $dato;
    }

    
}
