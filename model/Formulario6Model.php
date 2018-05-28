<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

require_once '/opt/lampp/htdocs/estudiantes/Tarea2B03675/core/Conexion.php';

class Formulario6Model {

    private $sql;
    private $datos;
    private $row;
    //Bayes
    private $arrayValores = [];
    private $arrayA = [];
    private $arrayB = [];
    private $arrayProbFrecuenciaA = [];
    private $arrayProbFrecuenciaB = [];
    private $frecuenciasA;
    private $frecuenciasB;

    //Constantes
    const m = 4; //Cantidad de clases(eventos)
    const n = 2; //total de instancias por cada clase
    const probabilidadClase = 0.5; //la probabilidad de que ocurra cada clase

    public function __construct() {
        $this->con = new \core\Conexion();
    }

    public function calcularClasificacionBayesiana($networkReliability, $numberLinks, $networkCapacity, $networkCost) {
        //Se asignan las probabilidades de cada atributo
        array_push($this->arrayValores, 0.25); //PARA reliability 1/4
        array_push($this->arrayValores, 0, 0714285714285714); //PARA number of links 1/14
        array_push($this->arrayValores, $this->asignaProbabilida("Capacity_Ca"));
        array_push($this->arrayValores, $this->asignaProbabilida("Costo_Co"));

        //Se asignan las frecuencias de cada atributo por clase
        //CLASE A
        $this->asignaFrecuenciasClaseA("Reliability_R", $networkReliability);
        $this->asignaFrecuenciasClaseA("Number_of_links_L", $numberLinks);
        $this->asignaFrecuenciasClaseA("Capacity_Ca", $networkCapacity);
        $this->asignaFrecuenciasClaseA("Costo_Co", $networkCost);
        //CLASE B
        $this->asignaFrecuenciasClaseB("Reliability_R", $networkReliability);
        $this->asignaFrecuenciasClaseB("Number_of_links_L", $numberLinks);
        $this->asignaFrecuenciasClaseB("Capacity_Ca", $networkCapacity);
        $this->asignaFrecuenciasClaseB("Costo_Co", $networkCost);
        
         //Se asigana la probabilidad de cada cada frecuencia según la clase
        //A
        $this->asignaProbabilidadPorFrecuenciaA();
        //B
        $this->asignaProbabilidadPorFrecuenciaB();
        
         //Se multiplican todas las frecuencias según la clase
        $this->frecuenciasA = $this->productoFrecuencias($this->arrayProbFrecuenciaA); 
        $this->frecuenciasB = $this->productoFrecuencias($this->arrayProbFrecuenciaB); 
        
        // Se determina el resultado final que será retornado a la vista
        return "El resultado por bayes es: " . $this->determinaResultadoBayes();
    }

    //Este metodo asigna la probabilidad de cada característica
    //según los valores de cada característica
    public function asignaProbabilida($atributo) {
        // Se obtiene el valor para cada característica
        $this->sql = "SELECT COUNT(DISTINCT " . $atributo . ") from Redes";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        $valor = intval($this->row[0]);
        // SE ASIGNA LA PROBABILIDAD
        $valor = 1 / $valor;
        return $valor;
    }

    public function asignaFrecuenciasClaseA($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase Paraiso para ese atributo
        //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from Redes where Class = 'A' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayA, $this->row[0]);
    }

    public function asignaFrecuenciasClaseB($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase Paraiso para ese atributo
        //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from Redes where Class = 'B' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayB, $this->row[0]);
    }
    
    public function asignaProbabilidadPorFrecuenciaA() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
        //Respetar el orden de los arreglos
        foreach ($this->arrayA as $atributo => $valor) {
            $result = $this->arrayA[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaA, $result);
        }
    }
    
    public function asignaProbabilidadPorFrecuenciaB() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
        //Respetar el orden de los arreglos
        foreach ($this->arrayB as $atributo => $valor) {
            $result = $this->arrayB[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaB, $result);
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
        //Se aplica la fórmula Producto de frecuencias * la Probabilidad de la clase
         $resultadoA = $this->frecuenciasA * self::probabilidadClase;
         $resultadoB = $this->frecuenciasB * self::probabilidadClase;
         $resultados = ["A" => $resultadoA, "B" => $resultadoB]; //asignan a un arreglo
      
         //se determina el mayor de los resultados y se retorna
         $mayor = max($resultados);
         foreach ($resultados as $atributo => $valor) {
           if($mayor ==  $resultados[$atributo]){
               return $atributo;
           } 
        }
    }

}
