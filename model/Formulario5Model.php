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
    private $valEdad;
    private $valGenero;
    private $valAutoEvaluacion;
    private $valCurso;
    private $valExperiencia;
    private $valComputadoras;
    private $valTecnología;
    private $valExperienciaSitio;
    private $arrayBeginner = [];
    private $arrayIntermediate = [];
    private $arrayAdvanced = [];

    //Constantes
    const m = 8;

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

    public function calcularClasificacionBayesiana($edad, $genero, $autoEvaluacion, $curso, $experiencia, $habilidadComputadoras, 
            $usoTecnologíaWeb, $experienciaSitio) {
        //Se asignan las probabilidades de cada atributo
        $this->valEdad = $this->asignaProbabilida("age");
        $this->valGenero = $this->asignaProbabilida("gender");
        $this->valAutoEvaluacion = $this->asignaProbabilida("self_evaluation");
        $this->valCurso = $this->asignaProbabilida("times_course");
        $this->valExperiencia = $this->asignaProbabilida("discipline");
        $this->valComputadoras = $this->asignaProbabilida("computers");
        $this->valTecnología = $this->asignaProbabilida("web_based_technology");
        $this->valExperienciaSitio = $this->asignaProbabilida("web_site");
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
    }

    //Este metodo asigna la probabilidad de cada característica
    //según los valores de cada característica
    public function asignaProbabilida($atributo) {
        // Se obtiene el valor para cada característica
        $this->sql = "SELECT COUNT(DISTINCT " . $atributo . ") from datosprofesores";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        $valor = intval($this->row[0]);
        // SE ASIGNA LA PROBABILIDAD
        $valor = 1 / $valor;
        return $valor;
    }

    public function asignaFrecuenciasClaseBeginner($atributo, $valor) {
        $this->sql = "SELECT COUNT(" . $atributo . ") from datosprofesores where class = 'Beginner' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);

        array_push($this->arrayBeginner, $this->row[0]);
    }
    
    public function asignaFrecuenciasClaseIntermediate($atributo, $valor) {
        $this->sql = "SELECT COUNT(" . $atributo . ") from datosprofesores where class = 'Intermediate' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);

        array_push($this->arrayIntermediate, $this->row[0]);
    }
    
    public function asignaFrecuenciasClaseAdvanced($atributo, $valor) {
        $this->sql = "SELECT COUNT(" . $atributo . ") from datosprofesores where class = 'Advanced' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);

        array_push($this->arrayAdvanced, $this->row[0]);
    }

}
