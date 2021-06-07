<?php
require_once("Conexion.php");
class Documento
{
    private $id;
    private $numero;
    private $seria;
    private $cliente;
    private $fecha;
    private $documento_anterior;
    private $anulada_por;
    private $anulada_en;
    private $motivo_anulacion;
    private $afectas;
    private $exentas;
    private $iva;
    private $retencion;
    private $condicion;
    private $datos_clientes;
    private $nota_remision;
    private $creacion;
    private $creado_por;
    private $caso;

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
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of seria
     */ 
    public function getSeria()
    {
        return $this->seria;
    }

    /**
     * Set the value of seria
     *
     * @return  self
     */ 
    public function setSeria($seria)
    {
        $this->seria = $seria;

        return $this;
    }

    /**
     * Get the value of cliente
     */ 
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set the value of cliente
     *
     * @return  self
     */ 
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

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
     * Get the value of documento_anterior
     */ 
    public function getDocumento_anterior()
    {
        return $this->documento_anterior;
    }

    /**
     * Set the value of documento_anterior
     *
     * @return  self
     */ 
    public function setDocumento_anterior($documento_anterior)
    {
        $this->documento_anterior = $documento_anterior;

        return $this;
    }

    /**
     * Get the value of anulada_por
     */ 
    public function getAnulada_por()
    {
        return $this->anulada_por;
    }

    /**
     * Set the value of anulada_por
     *
     * @return  self
     */ 
    public function setAnulada_por($anulada_por)
    {
        $this->anulada_por = $anulada_por;

        return $this;
    }

    /**
     * Get the value of anulada_en
     */ 
    public function getAnulada_en()
    {
        return $this->anulada_en;
    }

    /**
     * Set the value of anulada_en
     *
     * @return  self
     */ 
    public function setAnulada_en($anulada_en)
    {
        $this->anulada_en = $anulada_en;

        return $this;
    }

    /**
     * Get the value of motivo_anulacion
     */ 
    public function getMotivo_anulacion()
    {
        return $this->motivo_anulacion;
    }

    /**
     * Set the value of motivo_anulacion
     *
     * @return  self
     */ 
    public function setMotivo_anulacion($motivo_anulacion)
    {
        $this->motivo_anulacion = $motivo_anulacion;

        return $this;
    }

    /**
     * Get the value of afectas
     */ 
    public function getAfectas()
    {
        return $this->afectas;
    }

    /**
     * Set the value of afectas
     *
     * @return  self
     */ 
    public function setAfectas($afectas)
    {
        $this->afectas = $afectas;

        return $this;
    }

    /**
     * Get the value of exentas
     */ 
    public function getExentas()
    {
        return $this->exentas;
    }

    /**
     * Set the value of exentas
     *
     * @return  self
     */ 
    public function setExentas($exentas)
    {
        $this->exentas = $exentas;

        return $this;
    }

    /**
     * Get the value of iva
     */ 
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set the value of iva
     *
     * @return  self
     */ 
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    /**
     * Get the value of retencion
     */ 
    public function getRetencion()
    {
        return $this->retencion;
    }

    /**
     * Set the value of retencion
     *
     * @return  self
     */ 
    public function setRetencion($retencion)
    {
        $this->retencion = $retencion;

        return $this;
    }

    /**
     * Get the value of condicion
     */ 
    public function getCondicion()
    {
        return $this->condicion;
    }

    /**
     * Set the value of condicion
     *
     * @return  self
     */ 
    public function setCondicion($condicion)
    {
        $this->condicion = $condicion;

        return $this;
    }

    /**
     * Get the value of datos_clientes
     */ 
    public function getDatos_clientes()
    {
        return $this->datos_clientes;
    }

    /**
     * Set the value of datos_clientes
     *
     * @return  self
     */ 
    public function setDatos_clientes($datos_clientes)
    {
        $this->datos_clientes = $datos_clientes;

        return $this;
    }

    /**
     * Get the value of nota_remision
     */ 
    public function getNota_remision()
    {
        return $this->nota_remision;
    }

    /**
     * Set the value of nota_remision
     *
     * @return  self
     */ 
    public function setNota_remision($nota_remision)
    {
        $this->nota_remision = $nota_remision;

        return $this;
    }

    /**
     * Get the value of creacion
     */ 
    public function getCreacion()
    {
        return $this->creacion;
    }

    /**
     * Set the value of creacion
     *
     * @return  self
     */ 
    public function setCreacion($creacion)
    {
        $this->creacion = $creacion;

        return $this;
    }

    /**
     * Get the value of creado_por
     */ 
    public function getCreado_por()
    {
        return $this->creado_por;
    }

    /**
     * Set the value of creado_por
     *
     * @return  self
     */ 
    public function setCreado_por($creado_por)
    {
        $this->creado_por = $creado_por;

        return $this;
    }

    /**
     * Get the value of caso
     */ 
    public function getCaso()
    {
        return $this->caso;
    }

    /**
     * Set the value of caso
     *
     * @return  self
     */ 
    public function setCaso($caso)
    {
        $this->caso = $caso;

        return $this;
    }

    public function updateCantidadProd($sql)
    {
            $res=$this->db->query($sql);
}

    public function saveMovimiento($id,$cantidad,$precio,$descripcion)
    {
        $sql="INSERT INTO movimiento values (0,".$id.",".$cantidad.",NULL,".$precio.",NULL,NULL,'".$descripcion."',1);";
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

    public function saveDocumento($numfac,$serie,$cliente,$fecha,$ant,$af,$ex,$iva,$ret,$cpago,$classi,$caso)
    {
        $sql="INSERT INTO documento values (0,".$numfac.",".$serie.",".$cliente.",'".$fecha."',".$ant.",NULL,NULL,NULL,".$af.",".$ex.",".$iva.",".$ret.",".$cpago.",'".$classi."',NULL,NULL,NULL,'".$caso."',1);";
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

    //Método que devuelve el idUsuario del último INSERT
    public function ultimoID()
    {
        $ultimoId = mysqli_insert_id($this->db);
        return $ultimoId;
    }

    public function saveDetalleDocumento($doc,$prod,$cant,$precio,$numfac)
    {
        $sql="INSERT INTO detalle_documento values (0,".$doc.",".$prod.",".$cant.",".$precio.",1);";
            $res=$this->db->query($sql);
            $data=array();
            if($res)
            {
                $data['estado']=true;
                $data['descripcion']='Datos ingresado exitosamente';
                $data['numfac']=$numfac;
            }
            else
            {
                $data['estado']=false;
                $data['descripcion']=$sql."\nOcurrio un error en la inserción: ".$this->db->error;
                $data['numfac']=$numfac;
            }

            return $data;
    }

    public function datosCliente($numfac)
    {
        $sqlAll = "SELECT c.*, d.condiciones, d.fecha from documento AS d INNER JOIN cliente AS c ON c.id=d.cliente INNER JOIN detalle_documento AS ds ON ds.documento = d.id WHERE  ds.id =".$numfac;
        $info = $this->db->query($sqlAll);
        if ($info->num_rows > 0) {

            $dato = $info;
        } else {

            $dato = false;
        }
        return $dato;
    }

    public function datosSerie($numfac)
    {
        $sqlAll = "SELECT  dse.serie, dse.tipo FROM documento AS d INNER JOIN detalle_documento AS ds ON ds.documento = d.id INNER JOIN documento_serie AS dse ON d.serie=dse.id WHERE ds.id =".$numfac;
        $info = $this->db->query($sqlAll);
        if ($info->num_rows > 0) {

            $dato = $info;
        } else {

            $dato = false;
        }
        return $dato;
    }

}
