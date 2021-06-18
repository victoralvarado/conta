<?php
require_once("Conexion.php");
class Cuentas
{
    private $id;
    private $rubro;
    private $agrupacion;
    private $cuenta;
    private $nombre;
    private $codigo;
    private $debe;
    private $haber;
    private $tipo_saldo;
    private $cuenta_padre;
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
     * Get the value of rubro
     */ 
    public function getRubro()
    {
        return $this->rubro;
    }

    /**
     * Set the value of rubro
     *
     * @return  self
     */ 
    public function setRubro($rubro)
    {
        $this->rubro = $rubro;

        return $this;
    }

    /**
     * Get the value of agrupacion
     */ 
    public function getAgrupacion()
    {
        return $this->agrupacion;
    }

    /**
     * Set the value of agrupacion
     *
     * @return  self
     */ 
    public function setAgrupacion($agrupacion)
    {
        $this->agrupacion = $agrupacion;

        return $this;
    }

    /**
     * Get the value of cuenta
     */ 
    public function getCuenta()
    {
        return $this->cuenta;
    }

    /**
     * Set the value of cuenta
     *
     * @return  self
     */ 
    public function setCuenta($cuenta)
    {
        $this->cuenta = $cuenta;

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
     * Get the value of codigo
     */ 
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */ 
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

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
     * Get the value of tipo_saldo
     */ 
    public function getTipo_saldo()
    {
        return $this->tipo_saldo;
    }

    /**
     * Set the value of tipo_saldo
     *
     * @return  self
     */ 
    public function setTipo_saldo($tipo_saldo)
    {
        $this->tipo_saldo = $tipo_saldo;

        return $this;
    }

    /**
     * Get the value of cuenta_padre
     */ 
    public function getCuenta_padre()
    {
        return $this->cuenta_padre;
    }

    /**
     * Set the value of cuenta_padre
     *
     * @return  self
     */ 
    public function setCuenta_padre($cuenta_padre)
    {
        $this->cuenta_padre = $cuenta_padre;

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

    public function getAllCuentas()
    {
        $sqlAll = "SELECT * FROM c_cuentas WHERE estado = 1;";
        $info = $this->db->query($sqlAll);
        if ($info->num_rows > 0) {

            $dato = $info;
        } else {

            $dato = false;
        }
        return $dato;
    }

    public function debeAnterior($codigo)
    {
        $sql = $this->db->prepare("SELECT debe from c_cuentas where codigo = ?;");
        mysqli_stmt_bind_param($sql, 'i', $codigo);
        mysqli_stmt_execute($sql);
        mysqli_stmt_bind_result($sql, $res);
        mysqli_stmt_fetch($sql);
        mysqli_stmt_close($sql);
        return $res;
    }
    public function haberAnterior($codigo)
    {
        $sql = $this->db->prepare("SELECT haber from c_cuentas where codigo = ?;");
        mysqli_stmt_bind_param($sql, 'i', $codigo);
        mysqli_stmt_execute($sql);
        mysqli_stmt_bind_result($sql, $res);
        mysqli_stmt_fetch($sql);
        mysqli_stmt_close($sql);
        return $res;
    }

    public function CuentaId($codigo)
    {
        $sql = $this->db->prepare("SELECT id from c_cuentas where codigo = ?;");
        mysqli_stmt_bind_param($sql, 'i', $codigo);
        mysqli_stmt_execute($sql);
        mysqli_stmt_bind_result($sql, $res);
        mysqli_stmt_fetch($sql);
        mysqli_stmt_close($sql);
        return $res;
    }

    public function updateCuenta()
    {
        $sql = $this->db->prepare("UPDATE c_cuentas SET debe = ?, haber = ? WHERE codigo = ?;");
        $res = $sql->bind_param('ddi', $this->debe, $this->haber, $this->codigo);
        
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
