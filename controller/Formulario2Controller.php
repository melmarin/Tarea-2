<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Formulario2Controller
 *
 * @author Usuario
 */
require_once 'model/Formulario2Model.php';

class Formulario2Controller {
   private $model;

    public function __construct() {
        $this->model = new model\Formulario2Model();
    }

    public function invoke() {

        if (isset($_GET['formulario2'])) {

            if (($_GET['formulario2']) == "calcular") {
                
                $resultados = $this->model->calcularDistanciaEuclides($_POST['estiloAprendizaje'], $_POST['promedio'], $_POST['sexo']);
               
            }//if formulario
            
             include 'view/Formulario2View.php';
        }
    }
}
