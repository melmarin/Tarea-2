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
    
     public function calcularDistanciaEuclides($sexo, $promedio, $recinto) {
         
        $this->sql = "SELECT Estilo, Promedio, Sexo, Recinto FROM estilosexopromediorecinto";
        
        $this->datos = $this->con->consultaRetorno($this->sql);
        while ($row = $this->datos->fetch(\PDO::FETCH_ASSOC)) {
            $array[] = $row;
        }
        
        $pesoRecinto=2;
        $pesoSexo=2;
        $numTemp = 0;
        $numActual = 0;
        $filaFinal = "";
        
        foreach ($array as $fila) {
            
            if($sexo == $fila['Sexo']){
                $pesoSexo =1;
            }
            
            if($recinto == $fila['Recinto']){
                $pesoRecinto =1;
            }
            
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
}
