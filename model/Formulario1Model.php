<?php

Namespace model;

require_once 'core/Conexion.php';

class Formulario1Model {

    private $sql;
    private $datos;
    private $con;
    private $ec;
    private $or;
    private $ca;
    private $ea;

    public function __construct() {
        $this->con = new \core\Conexion();
    }

//ctor

    public function set($atributo, $contenido) {
        $this->$atributo = $contenido;
    }

//set

    public function get($atributo) {
        return $this->$atributo;
    }

//get 

    public function calcularDistanciaEuclides($arrayEC, $arrayOR, $arrayCA, $arrayEA) {
        
        //calcula los valores de las columnas código reciclado del javascript

        $this->ec = $arrayEC['c5'] + $arrayEC['c9'] + $arrayEC['c13'] +
                $arrayEC['c17'] + $arrayEC['c25'] + $arrayEC['c29'];

        $this->or = $arrayOR['c2'] + $arrayOR['c10'] + $arrayOR['c22'] +
                $arrayOR['c26'] + $arrayOR['c30'] + $arrayOR['c34'];

        $this->ca = $arrayCA['c7'] + $arrayCA['c11'] + $arrayCA['c15'] +
                $arrayCA['c19'] + $arrayCA['c31'] + $arrayCA['c35'];

        $this->ea = $arrayEA['c4'] + $arrayEA['c12'] + $arrayEA['c24'] +
                $arrayEA['c28'] + $arrayEA['c32'] + $arrayEA['c36'];

        $this->sql = "SELECT CA, EC, EA, ORR, Estilo FROM DatosTarea1";


        $this->datos = $this->con->consultaRetorno($this->sql);
        while ($row = $this->datos->fetch(\PDO::FETCH_ASSOC)) {
            $array[] = $row;
        }

        $numTemp = 0;
        $numActual = 0;
        $filaFinal = "";

        foreach ($array as $fila) {
            
            $numActual = sqrt(pow($fila['CA'] - $this->ca, 2) +
                    pow($fila['EA'] - $this->ea, 2) +
                    pow($fila['ORR'] - $this->or, 2) +
                    pow($fila['EC'] - $this->ec, 2));

            if ($numTemp == 0) {
                $numTemp = $numActual;
                $filaFinal = $fila['Estilo'];  // en caso que el primer resultado sea el correcto
            } else if ($numActual < $numTemp) {
                $numTemp = $numActual;
                $filaFinal = $fila['Estilo'];
            }
        }
        return "El estilo es: " . $filaFinal;
    }

}
?>