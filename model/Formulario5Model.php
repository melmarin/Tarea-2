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
    
     public function calcularDistanciaEuclides($edad, $genero, $curso, $experiencia, $habilidadComputadoras, $usoTecnologíaWeb, $experienciaSitio) {
         
        $this->sql = "SELECT * FROM datosprofesores";
        
        $this->datos = $this->con->consultaRetorno($this->sql);
        while ($row = $this->datos->fetch(\PDO::FETCH_ASSOC)) {
            $array[] = $row;
        }
        
        $pesoGenero =2;
        $pesoExperiencia = 2;
        $pesoHabilidadComputadoras = 2;
        $pesoUsoTecnologíaWeb = 2;
        $pesoExperienciaSitio = 2;
        
        foreach ($array as $fila) {
            
          $pesoGenero = $this->calculaPesoGenero($genero, $fila['gender']);
          $pesoExperiencia = $this->calculaPesoExperiencia($experiencia, $fila['discipline']);
            
            $numActual = sqrt(pow($fila['Promedio'] - (float)$promedio, 2) +
                         pow($pesoSexo, 2) + pow($pesoRecinto, 2));

            if ($numTemp == 0) {
                $numTemp = $numActual;
            } else if ($numActual < $numTemp) {
                $numTemp = $numActual;
                $filaFinal = $fila['Estilo'];
            }
            
            $pesoRecinto=2;
            $pesoSexo=2;
           
        }
      
         return "El Estilo es: " . $filaFinal;
         
     }
     
     public function calculaPesoGenero($genero, $generoBase){
          if($genero == $generoBase){
                return 1;
            }
            else if($genero == 'NA'){
                return 1.5;
            }
            else{
                return 2;
            }
     }
     
     public function calculaPesoExperiencia($experiencia, $experienciaBase){
          if($experiencia == $experienciaBase){
                return 1;
            }
            else{
                return 2;
            }
     }
     
      public function calculaPesoHabilidadComputadoras($habilidadComputadoras, $generoBase){
          if($genero == $generoBase){
                return 1;
            }
            else if($genero == 'NA'){
                return 1.5;
            }
            else{
                return 2;
            }
     }
}
