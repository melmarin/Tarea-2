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
    
     public function calcularDistanciaEuclides($estilo, $promedio, $recinto) {
         
        $this->sql = "SELECT Estilo, Promedio, Sexo, Recinto FROM EstiloSexoPromedioRecinto";
        
        $this->datos = $this->con->consultaRetorno($this->sql);
        while ($row = $this->datos->fetch(\PDO::FETCH_ASSOC)) {
            $array[] = $row;
        }
        
        $pesoRecinto=2;
        $pesoEstilo=2;
        $numTemp = 0;
        $numActual = 0;
        $filaFinal = "";
        
        foreach ($array as $fila) {
             //sea asigna un peso de forma binaria
            
            if($estilo == $fila['Estilo']){
                $pesoEstilo =1;
            }
            
            if($recinto == $fila['Recinto']){
                $pesoRecinto =1;
            }
            
            $numActual = sqrt(pow($fila['Promedio'] - (float)$promedio, 2) +
                         pow($pesoEstilo, 2) + pow($pesoRecinto, 2));

            if ($numTemp == 0) {
                $numTemp = $numActual;
                $filaFinal = $fila['Sexo']; // en caso que el primer resultado sea el correcto
            } else if ($numActual < $numTemp) {
                $numTemp = $numActual;
                $filaFinal = $fila['Sexo'];
            }
             // se reinician los valores
            $pesoRecinto=2;
            $pesoEstilo=2;
           
        }
        //para mostrar el resultado
        if($filaFinal == 'F'){
            $filaFinal = "Femenino";
        }
        else if ($filaFinal == 'M'){
             $filaFinal = "Masculino";
        }
         return "El Sexo es: " . $filaFinal;
         
     }
}
