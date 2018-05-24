<?php

Namespace model;

require_once 'core/Conexion.php';

class Formulario1Model {

    private $sql;
    private $datos;
    private $con;
    private $ec;
    private $or;
    private $ca;
    private $ea;
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
    const m = 4; //Cantidad de clases(eventos)
    const n = 4; //total de instancias por cada clase
    const probabilidadClase = 1 / 4; //la probabilidad de que ocurra cada clase

    public function __construct() {
        $this->con = new \core\Conexion();
    }

    public function calcularClasificacionBayesiana($arrayEC, $arrayOR, $arrayCA, $arrayEA) {

        //calcula los valores de las columnas código reciclado del javascript
        //Del resultado de las columnas se divide entre 4 y se obtiene la parte entera 
        //(ya que así se definió en la Base con los datos acomodados)
        //(VER) insertarDatosAcomodados() y la tabla datostarea1acomodados

        $this->ec = intdiv($arrayEC['c5'] + $arrayEC['c9'] + $arrayEC['c13'] +
                $arrayEC['c17'] + $arrayEC['c25'] + $arrayEC['c29'], 4);

        $this->or = intdiv($arrayOR['c2'] + $arrayOR['c10'] + $arrayOR['c22'] +
                $arrayOR['c26'] + $arrayOR['c30'] + $arrayOR['c34'], 4);

        $this->ca = intdiv($arrayCA['c7'] + $arrayCA['c11'] + $arrayCA['c15'] +
                $arrayCA['c19'] + $arrayCA['c31'] + $arrayCA['c35'], 4);

        $this->ea = intdiv($arrayEA['c4'] + $arrayEA['c12'] + $arrayEA['c24'] +
                $arrayEA['c28'] + $arrayEA['c32'] + $arrayEA['c36'], 4);

        //Se asignan las probabilidades de cada atributo
       array_push($this->arrayValores, $this->asignaProbabilida("CA"));
        array_push($this->arrayValores, $this->asignaProbabilida("EC"));
        array_push($this->arrayValores, $this->asignaProbabilida("EA"));
        array_push($this->arrayValores, $this->asignaProbabilida("ORR"));

        //Se asignan las frecuencias de cada atributo por clase
        //ACOMODADOR
        $this->asignaFrecuenciasClaseAcomodador("CA", $this->ca);
        $this->asignaFrecuenciasClaseAcomodador("EC", $this->ec);
        $this->asignaFrecuenciasClaseAcomodador("EA", $this->ea);
        $this->asignaFrecuenciasClaseAcomodador("ORR", $this->or);
        //DIVERGENTE
        $this->asignaFrecuenciasClaseDivergente("CA", $this->ca);
        $this->asignaFrecuenciasClaseDivergente("EC", $this->ec);
        $this->asignaFrecuenciasClaseDivergente("EA", $this->ea);
        $this->asignaFrecuenciasClaseDivergente("ORR", $this->or);
        //ASIMILADOR
        $this->asignaFrecuenciasClaseAsimilador("CA", $this->ca);
        $this->asignaFrecuenciasClaseAsimilador("EC", $this->ec);
        $this->asignaFrecuenciasClaseAsimilador("EA", $this->ea);
        $this->asignaFrecuenciasClaseAsimilador("ORR", $this->or);
        //CONVERGENTE
        $this->asignaFrecuenciasClaseConvergente("CA", $this->ca);
        $this->asignaFrecuenciasClaseConvergente("EC", $this->ec);
        $this->asignaFrecuenciasClaseConvergente("EA", $this->ea);
        $this->asignaFrecuenciasClaseConvergente("ORR", $this->or);

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
       /* $this->sql = "SELECT COUNT(DISTINCT " . $atributo . ") from datostarea1acomodados";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        $valor = intval($this->row[0]);*/
        // SE ASIGNA LA PROBABILIDAD
        $valor = 1 / 6;
        return $valor;
    }

    public function asignaFrecuenciasClaseAcomodador($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase ACOMODADOR para ese atributo
          //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from datostarea1acomodados where Estilo = 'ACOMODADOR' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayAcomodador, $this->row[0]);
    }

    public function asignaFrecuenciasClaseDivergente($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase DIVERGENTE para ese atributo
          //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from datostarea1acomodados where Estilo = 'DIVERGENTE' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayDivergente, $this->row[0]);
    }

    public function asignaFrecuenciasClaseAsimilador($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase ASIMILADOR para ese atributo
          //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from datostarea1acomodados where Estilo = 'ASIMILADOR' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayAsimilador, $this->row[0]);
    }

    public function asignaFrecuenciasClaseConvergente($atributo, $valor) {
        //Se cuenta la cantidad de veces que aparece el valor en la clase CONVERGENTE para ese atributo
          //fórmula SUMAR SI
        $this->sql = "SELECT COUNT(" . $atributo . ") from datostarea1acomodados where Estilo = 'CONVERGENTE' "
                . "AND " . $atributo . "= '$valor' ";
        $this->datos = $this->con->consultaRetorno($this->sql);
        $this->row = $this->datos->fetch(\PDO::FETCH_NUM);
        array_push($this->arrayConvergente, $this->row[0]);
    }

    public function asignaProbabilidadPorFrecuenciaAcomodador() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
        foreach ($this->arrayAcomodador as $atributo => $valor) {
            $result = $this->arrayAcomodador[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaAcomodador, $result);
        }
    }
    
     public function asignaProbabilidadPorFrecuenciaDivergente() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
        foreach ($this->arrayDivergente as $atributo => $valor) {
            $result = $this->arrayDivergente[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaDivergente, $result);
        }
    }
    
    public function asignaProbabilidadPorFrecuenciaAsimilador() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
        foreach ($this->arrayAsimilador as $atributo => $valor) {
            $result = $this->arrayAsimilador[$atributo] + self::m * $this->arrayValores[$atributo];
            $result = $result / ( self::n + self::m);
            array_push($this->arrayProbFrecuenciaAsimilador, $result);
        }
    }
    
    public function asignaProbabilidadPorFrecuenciaConvergente() {
        //Se aplica la fórmula (valor+m*p)/(n+m) para cada valor
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
               break;
           } 
        }
    }

    //Método utilizado para insertar una nueva tabla con los datos acomodados
    //Para las columnas el valor mínimo posible es 4 y el máximo es 6
    //Por lo tanto se crearon 4 grupos dividiendo cada valor entre 6 y tomando su parte entera
    public function insertarDatosAcomodados() {
        $this->sql = "SELECT * FROM DatosTarea1";
        $this->datos = $this->con->consultaRetorno($this->sql);
        while ($row = $this->datos->fetch(\PDO::FETCH_ASSOC)) {
            $array[] = $row;
        }

        foreach ($array as $fila) {
            $this->ca = intdiv(intval($fila['CA']), 4);
            $this->ec = intdiv(intval($fila['EC']), 4);
            $this->ea = intdiv(intval($fila['EA']), 4);
            $this->or = intdiv(intval($fila['ORR']), 4);
            $recinto = $fila['Recinto'];
            $ca_or = $fila['CA_EC'];
            $ea_or = $fila['EA_OR'];
            $estilo = $fila['Estilo'];

            $this->sql = "INSERT INTO datostarea1acomodados values ('$recinto', $this->ca, $this->ec, $this->ea, $this->or, $ca_or,"
                    . "$ea_or, '$estilo')";
            $this->con->consultaSimple($this->sql);
        }
    }

}

?>