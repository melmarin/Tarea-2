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
        array_push($this->arrayValores, $this->asignaProbabilida("Sexo"));
        array_push($this->arrayValores, 1/10); //PARA EL PROMEDIO
        
         //Se asignan las frecuencias de cada atributo por clase
        //PARAISO
        $this->asignaFrecuenciasClaseParaiso("Estilo", $estilo);
        $this->asignaFrecuenciasClaseParaiso("Sexo", $sexo);
        $this->asignaFrecuenciasClaseParaiso("Promedio", $promedio);
        //TURRIALBA
        $this->asignaFrecuenciasClaseTurrialba("Estilo", $estilo);
        $this->asignaFrecuenciasClaseTurrialba("Sexo", $sexo);
        $this->asignaFrecuenciasClaseTurrialba("Promedio", $promedio);
        
         //Se asigana la probabilidad de cada cada frecuencia según la clase
        //PARAISO
        $this->asignaProbabilidadPorFrecuenciaParaiso();
        //TURRIALBA
        $this->asignaProbabilidadPorFrecuenciaTurrialba();
        
        //Se multiplican todas las frecuencias según la clase
        $this->frecuenciasParaiso = $this->productoFrecuencias($this->arrayProbFrecuenciaParaiso); 
        $this->frecuenciasTurrialba = $this->productoFrecuencias($this->arrayProbFrecuenciaTurrialba); 
        
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
    
    public function asignaFrecuenciasClaseParaiso($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase Paraiso para ese atributo
          //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from estilosexopromediorecintoacomodados where Recinto = 'Paraiso' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayParaiso, $this->row[0]);
    }
    
     public function asignaFrecuenciasClaseTurrialba($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase Turrialba para ese atributo
          //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from estilosexopromediorecintoacomodados where Recinto = 'Turrialba' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayTurrialba, $this->row[0]);
    }
    
     public function asignaProbabilidadPorFrecuenciaParaiso() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
        //Respetar el orden de los arreglos
        foreach ($this->arrayParaiso as $atributo => $valor) {
            $result = $this->arrayParaiso[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaParaiso, $result);
        }
    }
    
     public function asignaProbabilidadPorFrecuenciaTurrialba() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
        //Respetar el orden de los arreglos
        foreach ($this->arrayTurrialba as $atributo => $valor) {
            $result = $this->arrayTurrialba[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaTurrialba, $result);
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
         $resultadoParaiso = $this->frecuenciasParaiso * self::probabilidadClase;
         $resultadoTurrialba = $this->frecuenciasTurrialba * self::probabilidadClase;
         $resultados = ["Paraiso" => $resultadoParaiso, "Turrialba" => $resultadoTurrialba]; //asignan a un arreglo
      
         //se determina el mayor de los resultados y se retorna
         $mayor = max($resultados);
         foreach ($resultados as $atributo => $valor) {
           if($mayor ==  $resultados[$atributo]){
               return $atributo;
           } 
        }
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
