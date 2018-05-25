<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;
require_once 'core/Conexion.php';

class Formulario2Model {
    
    private $sql;
    private $datos;
    private $con;
    
    //Bayes
    private $arrayValores = [];
    private $arrayParaiso = [];
    private $arrayTurrialba = [];
    private $arrayProbFrecuenciaParaiso = [];
    private $arrayProbFrecuenciaTurrialba = [];
    private $frecuenciasParaiso;
    private $frecuenciasTurrialba;

    //Constantes
    const m = 3; //Cantidad de clases(eventos)
    const n = 2; //total de instancias por cada clase
    const probabilidadClase = 1 / 2; //la probabilidad de que ocurra cada clase

    public function __construct() {
        $this->con = new \core\Conexion();
    }
    
     public function calcularClasificacionBayesiana($estilo, $promedio, $sexo) {
          //Se asignan las probabilidades de cada atributo
       array_push($this->arrayValores, $this->asignaProbabilida("Estilo"));
       $this->insertarDatosAcomodados();
         
     }
     
      //Este metodo asigna la probabilidad de cada característica
    //según los valores de cada característica
    public function asignaProbabilida($atributo) {
        // Se obtiene el valor para cada característica
       /* $this->sql = "SELECT COUNT(DISTINCT " . $atributo . ") from datostarea1acomodados";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        $valor = intval($this->row[0]);*/
        // SE ASIGNA LA PROBABILIDAD
        $valor = 1 / 6;
        return $valor;
    }

    //Método utilizado para insertar una nueva tabla con los datos acomodados
    //Para el promedio el valor mínimo posible es 1 y el máximo es 10
    //Por lo tanto se crearon 10 grupos dividiendo cada valor entre 1, tomando su parte entera
    public function insertarDatosAcomodados() {
        $this->sql = "SELECT Sexo, Recinto, Promedio, Estilo FROM estilosexopromediorecinto";
        $this->datos = $this->con->consultaRetorno($this->sql);
        while ($row = $this->datos->fetch(\PDO::FETCH_ASSOC)) {
            $array[] = $row;
        }

        foreach ($array as $fila) {
            $promedio = intdiv(intval($fila['Promedio']), 1);
            $recinto = $fila['Recinto'];
            $sexo = $fila['Sexo'];
            $estilo = $fila['Estilo'];

            $this->sql = "INSERT INTO estilosexopromediorecintoAcomodados values ('$sexo','$recinto', $promedio, '$estilo')";
            $this->con->consultaSimple($this->sql);
        }
    }
}
?>
