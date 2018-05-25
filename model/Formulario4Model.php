<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

require_once 'core/Conexion.php';

/**
 * Description of Formulario4
 *
 * @author Usuario
 */
class Formulario4Model {

    private $sql;
    private $datos;
    private $con;
    //Bayes
    private $arrayValores = [];
    private $arrayAcomodador = [];
    private $arrayDivergente = [];
    private $arrayAsimilador = [];
    private $arrayConvergente = [];
    private $arrayProbFrecuenciaAcomodador = [];
    private $arrayProbFrecuenciaDivergente = [];
    private $arrayProbFrecuenciaAsimilador = [];
    private $arrayProbFrecuenciaConvergente = [];
    private $frecuenciasAcomodador;
    private $frecuenciasDivergente;
    private $frecuenciasAsimilador;
    private $frecuenciasConvergente;

    //Constantes
    const m = 3; //Cantidad de clases(eventos)
    const n = 4; //total de instancias por cada clase
    const probabilidadClase = 1 / 4; //la probabilidad de que ocurra cada clase

    public function __construct() {
        $this->con = new \core\Conexion();
    }

    public function calcularClasificacionBayesiana($sexo, $promedio, $recinto) {
        //Se asignan las probabilidades de cada atributo
        array_push($this->arrayValores, $this->asignaProbabilida("Sexo"));
        array_push($this->arrayValores, 1 / 10); //PARA EL PROMEDIO
        array_push($this->arrayValores, $this->asignaProbabilida("Recinto"));
        
         //Se asignan las frecuencias de cada atributo por clase
        //ACOMODADOR
        $this->asignaFrecuenciasClaseAcomodador("Sexo", $sexo);
        $this->asignaFrecuenciasClaseAcomodador("Promedio", $promedio);
        $this->asignaFrecuenciasClaseAcomodador("Recinto", $recinto);
        //DIVERGENTE
        $this->asignaFrecuenciasClaseDivergente("Sexo", $sexo);
        $this->asignaFrecuenciasClaseDivergente("Promedio", $promedio);
        $this->asignaFrecuenciasClaseDivergente("Recinto", $recinto);
        //ASIMILADOR
        $this->asignaFrecuenciasClaseAsimilador("Sexo", $sexo);
        $this->asignaFrecuenciasClaseAsimilador("Promedio", $promedio);
        $this->asignaFrecuenciasClaseAsimilador("Recinto", $recinto);
        //CONVERGENTE
        $this->asignaFrecuenciasClaseConvergente("Sexo", $sexo);
        $this->asignaFrecuenciasClaseConvergente("Promedio", $promedio);
        $this->asignaFrecuenciasClaseConvergente("Recinto", $recinto);
        
         //Se asigana la probabilidad de cada cada frecuencia según la clase
        //ACOMODADOR
        $this->asignaProbabilidadPorFrecuenciaAcomodador();
        //DIVERGENTE
        $this->asignaProbabilidadPorFrecuenciaDivergente();
        //ASIMILADOR
         $this->asignaProbabilidadPorFrecuenciaAsimilador();
        //CONVERGENTE
         $this->asignaProbabilidadPorFrecuenciaConvergente();
         
           //Se multiplican todas las frecuencias según la clase
        $this->frecuenciasAcomodador = $this->productoFrecuencias($this->arrayProbFrecuenciaAcomodador); 
        $this->frecuenciasDivergente = $this->productoFrecuencias($this->arrayProbFrecuenciaDivergente); 
        $this->frecuenciasAsimilador = $this->productoFrecuencias($this->arrayProbFrecuenciaAsimilador);
        $this->frecuenciasConvergente = $this->productoFrecuencias($this->arrayProbFrecuenciaConvergente); 
        
        // Se determina el resultado final que será retornado a la vista
        return "El resultado por bayes es: " . $this->determinaResultadoBayes();
    }

    //Este metodo asigna la probabilidad de cada característica
    //según los valores de cada característica
    public function asignaProbabilida($atributo) {
        // Se obtiene el valor para cada característica
        $this->sql = "SELECT COUNT(DISTINCT " . $atributo . ") from estilosexopromediorecintoacomodados";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        $valor = intval($this->row[0]);
        // SE ASIGNA LA PROBABILIDAD
        $valor = 1 / $valor;
        return $valor;
    }
    
     public function asignaFrecuenciasClaseAcomodador($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase ACOMODADOR para ese atributo
          //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from estilosexopromediorecintoacomodados where Estilo = 'ACOMODADOR' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayAcomodador, $this->row[0]);
    }
    
    public function asignaFrecuenciasClaseDivergente($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase DIVERGENTE para ese atributo
          //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from estilosexopromediorecintoacomodados where Estilo = 'DIVERGENTE' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayDivergente, $this->row[0]);
    }

    public function asignaFrecuenciasClaseAsimilador($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase ASIMILADOR para ese atributo
          //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from estilosexopromediorecintoacomodados where Estilo = 'ASIMILADOR' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayAsimilador, $this->row[0]);
    }

    public function asignaFrecuenciasClaseConvergente($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase CONVERGENTE para ese atributo
          //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from estilosexopromediorecintoacomodados where Estilo = 'CONVERGENTE' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayConvergente, $this->row[0]);
    }
    
    public function asignaProbabilidadPorFrecuenciaAcomodador() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
          //Respetar el orden de los arreglos
        foreach ($this->arrayAcomodador as $atributo => $valor) {
            $result = $this->arrayAcomodador[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaAcomodador, $result);
        }
    }
    
     public function asignaProbabilidadPorFrecuenciaDivergente() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
           //Respetar el orden de los arreglos
        foreach ($this->arrayDivergente as $atributo => $valor) {
            $result = $this->arrayDivergente[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaDivergente, $result);
        }
    }
    
    public function asignaProbabilidadPorFrecuenciaAsimilador() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
          //Respetar el orden de los arreglos
        foreach ($this->arrayAsimilador as $atributo => $valor) {
            $result = $this->arrayAsimilador[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaAsimilador, $result);
        }
    }
    
    public function asignaProbabilidadPorFrecuenciaConvergente() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
          //Respetar el orden de los arreglos
        foreach ($this->arrayConvergente as $atributo => $valor) {
            $result = $this->arrayConvergente[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaConvergente, $result);
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
         $resultadoAcomodador = $this->frecuenciasAcomodador * self::probabilidadClase;
         $resultadoDivergente = $this->frecuenciasDivergente * self::probabilidadClase;
         $resultadoAsimilador = $this->frecuenciasAsimilador * self::probabilidadClase;
         $resultadoConvergente = $this->frecuenciasConvergente * self::probabilidadClase;
         $resultados = ["ACOMODADOR" => $resultadoAcomodador, "DIVERGENTE" => $resultadoDivergente,  
             "ASIMILADOR" => $resultadoAsimilador, "CONVERGENTE" =>$resultadoConvergente]; //asignan a un arreglo
      
         //se determina el mayor de los resultados y se retorna
         $mayor = max($resultados);
         foreach ($resultados as $atributo => $valor) {
           if($mayor ==  $resultados[$atributo]){
               return $atributo;
           } 
        }
    }

}
