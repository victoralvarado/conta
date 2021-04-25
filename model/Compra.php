<?php
require_once("Conexion.php");
class Compra
{
    private $id;
    private $afectas;
    private $iva;
    private $retencion;
    private $proveedor;
    private $fecha;
    private $registrado_por;
    private $condiciones;
    private $estado;
    private $tipo;
    private $numero_comprobante;
    private $nit;
    private $nrc;
    private $exentas_importacion;
    private $exentas_internas;
    private $gravadas_importacion;
    private $gravadas_internas;
    private $sujeto_excluido;
    private $totalCompras;
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
     * Get the value of proveedor
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set the value of proveedor
     *
     * @return  self
     */
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

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
     * Get the value of registrado_por
     */
    public function getRegistrado_por()
    {
        return $this->registrado_por;
    }

    /**
     * Set the value of registrado_por
     *
     * @return  self
     */
    public function setRegistrado_por($registrado_por)
    {
        $this->registrado_por = $registrado_por;

        return $this;
    }

    /**
     * Get the value of condiciones
     */
    public function getCondiciones()
    {
        return $this->condiciones;
    }

    /**
     * Set the value of condiciones
     *
     * @return  self
     */
    public function setCondiciones($condiciones)
    {
        $this->condiciones = $condiciones;

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

    public function getAllCompras()
    {
        $sqlAll = $this->db->prepare("SELECT c.*, dc.* FROM Compra c INNER JOIN Detalle_Compra dc ON c.id = dc.compra;");
        $info = $this->db->query($sqlAll);
        if ($info->num_rows > 0) {

            $dato = $info;
        } else {

            $dato = false;
        }
        return $dato;
    }

    /**
     * Get the value of sujeto_excluido
     */
    public function getSujeto_excluido()
    {
        return $this->sujeto_excluido;
    }

    /**
     * Set the value of sujeto_excluido
     *
     * @return  self
     */
    public function setSujeto_excluido($sujeto_excluido)
    {
        $this->sujeto_excluido = $sujeto_excluido;

        return $this;
    }

    /**
     * Get the value of gravadas_internas
     */
    public function getGravadas_internas()
    {
        return $this->gravadas_internas;
    }

    /**
     * Set the value of gravadas_internas
     *
     * @return  self
     */
    public function setGravadas_internas($gravadas_internas)
    {
        $this->gravadas_internas = $gravadas_internas;

        return $this;
    }

    /**
     * Get the value of gravadas_importacion
     */
    public function getGravadas_importacion()
    {
        return $this->gravadas_importacion;
    }

    /**
     * Set the value of gravadas_importacion
     *
     * @return  self
     */
    public function setGravadas_importacion($gravadas_importacion)
    {
        $this->gravadas_importacion = $gravadas_importacion;

        return $this;
    }

    /**
     * Get the value of exentas_internas
     */
    public function getExentas_internas()
    {
        return $this->exentas_internas;
    }

    /**
     * Set the value of exentas_internas
     *
     * @return  self
     */
    public function setExentas_internas($exentas_internas)
    {
        $this->exentas_internas = $exentas_internas;

        return $this;
    }

    /**
     * Get the value of exentas_importacion
     */
    public function getExentas_importacion()
    {
        return $this->exentas_importacion;
    }

    /**
     * Set the value of exentas_importacion
     *
     * @return  self
     */
    public function setExentas_importacion($exentas_importacion)
    {
        $this->exentas_importacion = $exentas_importacion;

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
     * Get the value of numero_comprobante
     */
    public function getNumero_comprobante()
    {
        return $this->numero_comprobante;
    }

    /**
     * Set the value of numero_comprobante
     *
     * @return  self
     */
    public function setNumero_comprobante($numero_comprobante)
    {
        $this->numero_comprobante = $numero_comprobante;

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

    /**
     * Get the value of totalCompras
     */
    public function getTotalCompras()
    {
        return $this->totalCompras;
    }

    /**
     * Set the value of totalCompras
     *
     * @return  self
     */
    public function setTotalCompras($totalCompras)
    {
        $this->totalCompras = $totalCompras;

        return $this;
    }

    public function getNombreUser($username)
    {
        $sql = $this->db->prepare("SELECT nombre FROM Usuario WHERE usuario = ?;");
        mysqli_stmt_bind_param($sql, 's', $username);
        mysqli_stmt_execute($sql);
        mysqli_stmt_bind_result($sql, $res);
        mysqli_stmt_fetch($sql);
        mysqli_stmt_close($sql);
        return $res;
    }
    public function saveProducto()
    {
        $sql = $this->db->prepare("INSERT INTO Compra(afectas,iva,retencion,proveedor,fecha,registrado_por,condiciones,estado,tipo,numero_comprobante
        nit,nrc,exentas_importacion,exentas_internas,gravadas_importacion,gravadas_internas,sujeto_excluido,totalCompras) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
        # s = string; i = int; d = decimal
        $res = $sql->bind_param(
            'dddsssiissssdddddd',
            $this->afectas,
            $this->iva,
            $this->retencion,
            $this->proveedor,
            $this->fecha,
            $this->registrado_por,
            $this->condiciones,
            $this->estado,
            $this->tipo,
            $this->numero_comprobante,
            $this->nit,
            $this->nrc,
            $this->exentas_importacion,
            $this->exentas_internas,
            $this->gravadas_importacion,
            $this->gravadas_internas,
            $this->sujeto_excluido,
            $this->totalCompras
        );
        $sql->execute();
        $data = array();
        if ($res) {
            $data['estado'] = true;
            $data['descripcion'] = 'Datos ingresado exitosamente';
        } else {
            $data['estado'] = false;
            $data['descripcion'] = 'Ocurrio un error en la inserción ' . $this->db->error;
        }
        $sql->close();
        $this->db->close();
        return $data;
    }
}
