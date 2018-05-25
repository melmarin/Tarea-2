<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;
require_once 'core/Conexion.php';

/**
 * Description of Formulario3Model
 *
 * @author Usuario
 */
class Formulario3Model {
    private $sql;
    private $datos;
    private $con;
    
     //Bayes
    private $arrayValores = [];
    private $arrayMasculino = [];
    private $arrayFemenino = [];
    private $arrayProbFrecuenciaMasculino = [];
    private $arrayProbFrecuenciaFemenino = [];
    private $frecuenciasMasculino;
    private $frecuenciasFemenino;

    //Constantes
    const m = 3; //Cantidad de clases(eventos)
    const n = 2; //total de instancias por cada clase
    const probabilidadClase = 1 / 2; //la probabilidad de que ocurra cada clase

    public function __construct() {
        $this->con = new \core\Conexion();
    }
    
     public function calcularClasificacionBayesiana($estilo, $promedio, $recinto) {
         //Se asignan las probabilidades de cada atributo
        array_push($this->arrayValores, $this->asignaProbabilida("Estilo"));
        array_push($this->arrayValores, $this->asignaProbabilida("Recinto"));
        array_push($this->arrayValores, 1/10); //PARA EL PROMEDIO
         
          //Se asignan las frecuencias de cada atributo por clase
        //MASCULINO
        $this->asignaFrecuenciasClaseMasculino("Estilo", $estilo);
        $this->asignaFrecuenciasClaseMasculino("Recinto", $recinto);
        $this->asignaFrecuenciasClaseMasculino("Promedio", $promedio);
        //FEMENINO
        $this->asignaFrecuenciasClaseFemenino("Estilo", $estilo);
        $this->asignaFrecuenciasClaseFemenino("Recinto", $recinto);
        $this->asignaFrecuenciasClaseFemenino("Promedio", $promedio);
        
         //Se asigana la probabilidad de cada cada frecuencia según la clase
        //MASCULINO
        $this->asignaProbabilidadPorFrecuenciaMasculino();
        //FEMENINO
        $this->asignaProbabilidadPorFrecuenciaFemenino();
        
        //Se multiplican todas las frecuencias según la clase
        $this->frecuenciasMasculino = $this->productoFrecuencias($this->arrayProbFrecuenciaMasculino); 
        $this->frecuenciasFemenino = $this->productoFrecuencias($this->arrayProbFrecuenciaFemenino); 
        
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
    
    public function asignaFrecuenciasClaseMasculino($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase Masculino para ese atributo
          //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from estilosexopromediorecintoacomodados where Sexo = 'M' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayMasculino, $this->row[0]);
    }
    
    public function asignaFrecuenciasClaseFemenino($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase Femenino para ese atributo
          //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from estilosexopromediorecintoacomodados where Sexo = 'F' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayFemenino, $this->row[0]);
    }
    
    public function asignaProbabilidadPorFrecuenciaMasculino() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
        //Respetar el orden de los arreglos
        foreach ($this->arrayMasculino as $atributo => $valor) {
            $result = $this->arrayMasculino[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaMasculino, $result);
        }
    }
    
    public function asignaProbabilidadPorFrecuenciaFemenino() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
        //Respetar el orden de los arreglos
        foreach ($this->arrayFemenino as $atributo => $valor) {
            $result = $this->arrayFemenino[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaFemenino, $result);
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
         $resultadoMasculino = $this->frecuenciasMasculino * self::probabilidadClase;
         $resultadoFemenino = $this->frecuenciasFemenino * self::probabilidadClase;
         $resultados = ["Masculino" => $resultadoMasculino, "Femenino" => $resultadoFemenino]; //se asignan a un arreglo
      
         //se determina el mayor de los resultados y se retorna
         $mayor = max($resultados);
         foreach ($resultados as $atributo => $valor) {
           if($mayor ==  $resultados[$atributo]){
               return $atributo;
           } 
        }
    }
}
