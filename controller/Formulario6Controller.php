<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Formulario6Controller
 *
 * @author melma
 */
include '/opt/lampp/htdocs/estudiantes/Tarea2B03675/model/Formulario6Model.php';

class Formulario6Controller {
    private $model;
    
     public function __construct() {
        $this->model = new model\Formulario6Model();
    }
    
     public function invoke() {

        if (isset($_GET['formulario6'])) {

            if (($_GET['formulario6']) == "calcular") {
                
                $resultados = $this->model->calcularClasificacionBayesiana($_POST['networkReliability'] , $_POST['numberLinks'], 
                        $_POST['networkCapacity'], $_POST['networkCost']);
               
            }//if formulario
            
             include '/opt/lampp/htdocs/estudiantes/Tarea2B03675/view/Formulario6View.php';
        }
    }
}
?>