<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Formulario1Controller
 *
 * @author Usuario
 */
require_once 'model/Formulario1Model.php';

class Formulario1Controller {

    private $model;

    public function __construct() {
        $this->model = new model\Formulario1Model();
    }

    public function invoke() {

        if (isset($_GET['formulario1'])) {

            if (($_GET['formulario1']) == "calcular") {
                $datosEC = array("c5" => $_POST['c5'], "c9" => $_POST['c9'], "c13" => $_POST['c13'],
                    "c17" => $_POST['c17'], "c25" => $_POST['c25'], "c29" => $_POST['c29']);

                $datosOR = array("c2" => $_POST['c2'], "c10" => $_POST['c10'], "c22" => $_POST['c22'],
                    "c26" => $_POST['c26'], "c30" => $_POST['c30'], "c34" => $_POST['c34']);

                $datosCA = array("c7" => $_POST['c7'], "c11" => $_POST['c11'], "c15" => $_POST['c15'],
                    "c19" => $_POST['c19'], "c31" => $_POST['c31'], "c35" => $_POST['c35']);

                $datosEA = array("c4" => $_POST['c4'], "c12" => $_POST['c12'], "c24" => $_POST['c24'],
                    "c28" => $_POST['c28'], "c32" => $_POST['c32'], "c36" => $_POST['c36']);

                $resultados = $this->model->calcularDistanciaEuclides($datosEC, $datosOR, $datosCA, $datosEA);
               
            }//if formulario
            
             include 'view/Formulario1View.php';
        }
    }

}
