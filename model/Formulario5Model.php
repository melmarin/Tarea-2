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
    
    //Bayes
    private $valEdad = 0;
    private $valGenero;
    private $valAutoEvaluacion;
    private $valCurso;
    private $valExperiencia;
    private $valComputadoras;
    private $valTecnología;
    private $valExperienciaSitio;

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

    public function calcularClasificacionBayesiana($edad, $genero, $autoEvaluacion, $curso, $experiencia, $habilidadComputadoras, $usoTecnologíaWeb, $experienciaSitio) {
        $this->valEdad = $this->asignaProbabilida("age");
       
    }
    
    //Este metodo asigna la probabilidad de cada característica
    //según los valores de cada característica
    public function asignaProbabilida($atributo){
         // Se obtiene el valor para cada característica
         $this->sql = "SELECT COUNT(DISTINCT ".$atributo.") from datosprofesores";
         $this->datos = $this->con->consultaRetorno($this->sql);       
         $val = $this->datos->fetch(\PDO::FETCH_ASSOC); //devuelve un arreglo
        // SE ASIGNA LA PROBABILIDAD
         $valor = 1 / $valor;
         return $valor;
    } 

   

}
