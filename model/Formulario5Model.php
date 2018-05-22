<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

require_once 'core/Conexion.php';

/**
 * Description of Formulario5Model
 *
 * @author Usuario
 */
class Formulario5Model {

    private $sql;
    private $datos;
    private $con;

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

    public function calcularDistanciaEuclides($edad, $genero, $autoEvaluacion, $curso, $experiencia, $habilidadComputadoras, $usoTecnologíaWeb, $experienciaSitio) {

        $this->sql = "SELECT * FROM DatosProfesores";

        $this->datos = $this->con->consultaRetorno($this->sql);
        while ($row = $this->datos->fetch(\PDO::FETCH_ASSOC)) {
            $array[] = $row;
        }

        $pesoGenero = 2;
        $pesoAutoEvaluacion = 2;
        $pesoExperiencia = 2;
        $pesoHabilidadComputadoras = 2;
        $pesoUsoTecnologíaWeb = 2;
        $pesoExperienciaSitio = 2;
        $numTemp = 0;
        $numActual = 0;

        foreach ($array as $fila) {

             //sea asignan pesos de forma binaria en su mayoría
            $pesoGenero = $this->calculaPesoGenero($genero, $fila['gender']);
            $pesoExperiencia = $this->calculaPesoExperiencia($experiencia, $fila['discipline']);
            $pesoHabilidadComputadoras = $this->calculaPesoHabilidadComputadoras($habilidadComputadoras, $fila['computers']);
            $pesoUsoTecnologíaWeb = $this->calculaPesoUsoTecnologíaWeb($usoTecnologíaWeb, $fila['web_based_technology']);
            $pesoExperienciaSitio = $this->calculaPesoExperienciaSitio($experienciaSitio, $fila['web_site']);
            $pesoAutoEvaluacion = $this->calculaPesoAutoEvaluacion($autoEvaluacion, $fila['self_evaluation']);

            $numActual = sqrt(pow($fila['age'] - (int)$edad, 2) + pow($pesoGenero, 2) +
                    pow($pesoAutoEvaluacion, 2) + pow($fila['times_course'] - (int) $curso, 2) +
                    pow($pesoExperiencia, 2) + pow($pesoHabilidadComputadoras, 2) +
                    pow($pesoUsoTecnologíaWeb, 2) + pow($pesoExperienciaSitio, 2));

            if ($numTemp == 0) {
                $numTemp = $numActual;
                $filaFinal = $fila['Class']; // en caso que el primer resultado sea el correcto
            } else if ($numActual < $numTemp) {
                $numTemp = $numActual;
                $filaFinal = $fila['Class'];
            }
             // se reinician los valores
            $pesoGenero = 2;
            $pesoAutoEvaluacion = 2;
            $pesoExperiencia = 2;
            $pesoHabilidadComputadoras = 2;
            $pesoUsoTecnologíaWeb = 2;
            $pesoExperienciaSitio = 2;
        }

        return "La clase de profesor es: " . $filaFinal;
    }

    public function calculaPesoGenero($genero, $generoBase) {
        if ($genero == $generoBase) {
            return 1;
        } else if ($genero == 'NA') {
            return 1.5;
        } else {
            return 2;
        }
    }

    public function calculaPesoExperiencia($experiencia, $experienciaBase) {
        if ($experiencia == $experienciaBase) {
            return 1;
        } else {
            return 2;
        }
    }

    public function calculaPesoHabilidadComputadoras($habilidadComputadoras, $habilidadComputadorasBase) {
        if ($habilidadComputadoras == $habilidadComputadorasBase) {
            return 1;
        } else {
            return 2;
        }
    }

    public function calculaPesoUsoTecnologíaWeb($usoTecnologíaWeb, $usoTecnologíaWebBase) {
        if ($usoTecnologíaWeb == $usoTecnologíaWebBase) {
            return 1;
        } else {
            return 2;
        }
    }

    public function calculaPesoExperienciaSitio($experienciaSitio, $experienciaSitioBase) {
        if ($experienciaSitio == $experienciaSitioBase) {
            return 1;
        } else {
            return 2;
        }
    }

    public function calculaPesoAutoEvaluacion($autoEvaluacion, $autoEvaluacionBase) {
        if ($autoEvaluacion == $autoEvaluacionBase) {
            return 1;
        } else {
            return 2;
        }
    }

}
