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
    private $row;
    //Bayes
    private $arrayValores = [];
    private $arrayBeginner = [];
    private $arrayIntermediate = [];
    private $arrayAdvanced = [];
    private $arrayProbFrecuenciaBeginner = [];
    private $arrayProbFrecuenciaIntermediate = [];
    private $arrayProbFrecuenciaAdvanced = [];
    private $frecuenciasBeginner;
    private $frecuenciasIntermediate;
    private $frecuenciasAdvanced;

    //Constantes
    const m = 8; //Cantidad de clases(eventos)
    const n = 3; //total de instancias por cada clase
    const probabilidadClase = 1/3; //la probabilidad de que ocurra cada clase
    
    public function __construct() {
        $this->con = new \core\Conexion();
    }


    public function calcularClasificacionBayesiana($edad, $genero, $autoEvaluacion, $curso, $experiencia, $habilidadComputadoras, $usoTecnologíaWeb, $experienciaSitio) {
        //Se asignan las probabilidades de cada atributo
        array_push($this->arrayValores, $this->asignaProbabilida("age"));
        array_push($this->arrayValores, $this->asignaProbabilida("gender"));
        array_push($this->arrayValores, $this->asignaProbabilida("self_evaluation"));
        array_push($this->arrayValores, $this->asignaProbabilida("times_course"));
        array_push($this->arrayValores, $this->asignaProbabilida("discipline"));
        array_push($this->arrayValores, $this->asignaProbabilida("computers"));
        array_push($this->arrayValores, $this->asignaProbabilida("web_based_technology"));
        array_push($this->arrayValores, $this->asignaProbabilida("web_site"));
        
        //Se asignan las frecuencias de cada atributo por clase
        //BEGINNER
        $this->asignaFrecuenciasClaseBeginner("age", $edad);
        $this->asignaFrecuenciasClaseBeginner("gender", $genero);
        $this->asignaFrecuenciasClaseBeginner("self_evaluation", $autoEvaluacion);
        $this->asignaFrecuenciasClaseBeginner("times_course", $curso);
        $this->asignaFrecuenciasClaseBeginner("discipline", $experiencia);
        $this->asignaFrecuenciasClaseBeginner("computers", $habilidadComputadoras);
        $this->asignaFrecuenciasClaseBeginner("web_based_technology", $usoTecnologíaWeb);
        $this->asignaFrecuenciasClaseBeginner("web_site", $experienciaSitio);
        //INTERMEDIATE
        $this->asignaFrecuenciasClaseIntermediate("age", $edad);
        $this->asignaFrecuenciasClaseIntermediate("gender", $genero);
        $this->asignaFrecuenciasClaseIntermediate("self_evaluation", $autoEvaluacion);
        $this->asignaFrecuenciasClaseIntermediate("times_course", $curso);
        $this->asignaFrecuenciasClaseIntermediate("discipline", $experiencia);
        $this->asignaFrecuenciasClaseIntermediate("computers", $habilidadComputadoras);
        $this->asignaFrecuenciasClaseIntermediate("web_based_technology", $usoTecnologíaWeb);
        $this->asignaFrecuenciasClaseIntermediate("web_site", $experienciaSitio);
        //ADVANCED
        $this->asignaFrecuenciasClaseAdvanced("age", $edad);
        $this->asignaFrecuenciasClaseAdvanced("gender", $genero);
        $this->asignaFrecuenciasClaseAdvanced("self_evaluation", $autoEvaluacion);
        $this->asignaFrecuenciasClaseAdvanced("times_course", $curso);
        $this->asignaFrecuenciasClaseAdvanced("discipline", $experiencia);
        $this->asignaFrecuenciasClaseAdvanced("computers", $habilidadComputadoras);
        $this->asignaFrecuenciasClaseAdvanced("web_based_technology", $usoTecnologíaWeb);
        $this->asignaFrecuenciasClaseAdvanced("web_site", $experienciaSitio);
        
        //Se asigana la probabilidad de cada cada frecuencia según la clase
        //BEGINNER
        $this->asignaProbabilidadPorFrecuenciaBeginner();
        //INTERMEDIATE
        $this->asignaProbabilidadPorFrecuenciaIntermediate();
        //ADVANCED
        $this->asignaProbabilidadPorFrecuenciaAdvanced();
        
        //Se multiplican todas las frecuencias según la clase
        $this->frecuenciasBeginner = $this->productoFrecuencias($this->arrayProbFrecuenciaBeginner);
        $this->frecuenciasIntermediate = $this->productoFrecuencias($this->arrayProbFrecuenciaIntermediate);
        $this->frecuenciasAdvanced = $this->productoFrecuencias($this->arrayProbFrecuenciaAdvanced);
        
        // Se determina el resultado final que será retornado a la vista
        return "El resultado por bayes es: " . $this->determinaResultadoBayes();
    }

    //Este metodo asigna la probabilidad de cada característica
    //según los valores de cada característica
    public function asignaProbabilida($atributo) {
        // Se obtiene el valor para cada característica
        //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(DISTINCT " . $atributo . ") from datosprofesores";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        $valor = intval($this->row[0]);
        // SE ASIGNA LA PROBABILIDAD
        $valor = 1 / $valor;
        return $valor;
    }

    public function asignaFrecuenciasClaseBeginner($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase Beginner
        $this->sql = "SELECT COUNT(" . $atributo . ") from datosprofesores where class = 'Beginner' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);

        array_push($this->arrayBeginner, $this->row[0]);
    }

    public function asignaFrecuenciasClaseIntermediate($atributo, $valor) {
         //Se cuenta la cantidad de veces que aparece el valor en la clase Intermediate
        $this->sql = "SELECT COUNT(" . $atributo . ") from datosprofesores where class = 'Intermediate' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);

        array_push($this->arrayIntermediate, $this->row[0]);
    }

    public function asignaFrecuenciasClaseAdvanced($atributo, $valor) {
         //Se cuenta la cantidad de veces que aparece el valor en la clase Advanced
        $this->sql = "SELECT COUNT(" . $atributo . ") from datosprofesores where class = 'Advanced' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);

        array_push($this->arrayAdvanced, $this->row[0]);
    }

    public function asignaProbabilidadPorFrecuenciaBeginner() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
        foreach ($this->arrayBeginner as $atributo => $valor) {
            $result = $this->arrayBeginner[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaBeginner, $result);
        }
    }
    
     public function asignaProbabilidadPorFrecuenciaIntermediate() {
         //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
        foreach ($this->arrayIntermediate as $atributo => $valor) {
            $result = $this->arrayIntermediate[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaIntermediate, $result);
        }
    }
    
    public function asignaProbabilidadPorFrecuenciaAdvanced() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
        foreach ($this->arrayAdvanced as $atributo => $valor) {
            $result = $this->arrayAdvanced[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaAdvanced, $result);
        }
    }
    
    public function productoFrecuencias($array){
        //Se multiplican todos los valores de la clase y se devuelve el resultado
        $result =1;
        foreach ($array as $atributo => $valor) {
           $result *=  $array[$atributo]; 
        }
        return $result;
    }
    
    public function determinaResultadoBayes(){
        //Se aplica la fórmula Producto de frecuencias * la Prioridad de la clase
         $resultadoBegineer = $this->frecuenciasBeginner * self::probabilidadClase;
         $resultadoIntermediate = $this->frecuenciasIntermediate * self::probabilidadClase;
         $resultadoAdvanced = $this->frecuenciasAdvanced * self::probabilidadClase;
         $mayor; //variable para retornar
      
         //se determina el mayor de los resultados y se retorna
         if($resultadoBegineer >= $resultadoIntermediate && $resultadoBegineer >= $resultadoAdvanced){
             $mayor = "Beginner";
         } else if ($resultadoIntermediate >= $resultadoBegineer && $resultadoIntermediate >= $resultadoAdvanced){
             $mayor = "Intermediate";
         }
         else{
             $mayor = "Advanced";
         }
         return $mayor;
    }

}
