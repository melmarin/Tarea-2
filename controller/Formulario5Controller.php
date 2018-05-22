<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Formulario5Controller
 *
 * @author Usuario
 */
require_once 'model/Formulario5Model.php';

class Formulario5Controller {
    private $model;
    
     public function __construct() {
        $this->model = new model\Formulario5Model();
    }

    public function invoke() {

        if (isset($_GET['formulario5'])) {

            if (($_GET['formulario5']) == "calcular") {
                
                $resultados = $this->model->calcularDistanciaEuclides($_POST['age'] , $_POST['gender'], $_POST['course'], 
                        $_POST['discipline'], $_POST['computers'], $_POST['webBased'], $_POST['webSite']);
               
            }//if formulario
            
             include 'view/Formulario5View.php';
        }
    }
}
