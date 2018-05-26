<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Formulario4Controller
 *
 * @author Usuario
 */
require_once '/opt/lampp/htdocs/estudiantes/Tarea2B03675/model/Formulario4Model.php';

class Formulario4Controller {
    private $model;

    public function __construct() {
        $this->model = new model\Formulario4Model();
    }

    public function invoke() {

        if (isset($_GET['formulario4'])) {

            if (($_GET['formulario4']) == "calcular") {
                
                $resultados = $this->model->calcularClasificacionBayesiana($_POST['sexo'], $_POST['promedio'], $_POST['recinto']);
               
            }//if formulario
            
             include '/opt/lampp/htdocs/estudiantes/Tarea2B03675/view/Formulario4View.php';
        }
    }
}
?>