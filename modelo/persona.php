<?php

class Persona_class
{
    private $nroDni;
    private $apellido;
    private $nombre;
    private $fechaNac;
    private $telefono;
    private $domicilio;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->nroDni = "";
        $this->apellido = "";
        $this->nombre = "";
        $this->fechaNac = "";
        $this->telefono = "";
        $this->domicilio = "";
        $this->mensajeOperacion = "";
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getNroDni()
    {
        return $this->nroDni;
    }

    public function setNroDni($nroDni)
    {
        $this->nroDni = $nroDni;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getFechaNac()
    {
        return $this->fechaNac;
    }

    public function setFechaNac($fechaNac)
    {
        $this->fechaNac = $fechaNac;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getDomicilio()
    {
        return $this->domicilio;
    }

    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function setear($dni, $nombre, $apellido, $domicilio, $fechaNac, $telefono)
    {
        $this->setNroDni($dni);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setDomicilio($domicilio);
        $this->setFechaNac($fechaNac);
        $this->setTelefono($telefono);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM 'persona' WHERE id = " . $this->getNroDni();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['nroDni'], $row['nombre'], $row['apellido'],
                        $row['domicilio'], $row['fechaNac'], $row['telefono']);
                }
            }
        } else {
            $this->setmensajeoperacion("Tabla->listar: " . $base->getError());
        }
        return $resp;

    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE persona SET nombre ='{$this->getNombre()}' , apellido = '{$this->getApellido()}' ,
        telefono = '{$this->getTelefono()}' , domicilio = '{$this->getDomicilio()}' , fechaNac = '{$this->getFechaNac()}'
        WHERE nroDni = " . $this->getNroDni();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Persona->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Persona->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM persona WHERE nroDni = " . $this->getNroDni();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Tabla->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Tabla->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM persona ";
        echo 'hola afuera de todo ';

        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
            echo 'hola parametro ';

        }
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            echo 'hola inicie ';
            if ($res > -1) {
                if ($res > 0) {
                    echo 'hola';
                    while ($row = $base->Registro()) {
                        $obj = new Persona_class();
                        $obj->setear($row['nroDni'], $row['nombre'], $row['apellido'],
                            $row['domicilio'], $row['fechaNac'], $row['telefono']);
                        array_push($arreglo, $obj);
                    }
                }
            }
        } else {
            $this->setMensajeOperacion("Tabla->listar: " . $base->getError());
            echo $base->getError();
        }
        return $arreglo;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = 'INSERT INTO persona(nroDni , apellido , nombre , fechaNac , telefono, domicilio)
                VALUES'("{$this->getNroDni()} , {$this->getApellido()} , {$this->getNombre()} , {$this->getFechaNac()} , {$this->getTelefono()} , {$this->getDomicilio()}");
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setNroDni($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Persona->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Persona->insertar: " . $base->getError());
        }
        return $resp;
    }

}
