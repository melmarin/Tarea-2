<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Formulario3Controller
 *
 * @author Usuario
 */
require_once '/opt/lampp/htdocs/estudiantes/Tarea2B03675/model/Formulario3Model.php';

class Formulario3Controller {
     private $model;

    public function __construct() {
        $this->model = new model\Formulario3Model();
    }

    public function invoke() {

        if (isset($_GET['formulario3'])) {

            if (($_GET['formulario3']) == "calcular") {
                
                $resultados = $this->model->calcularClasificacionBayesiana($_POST['estiloAprendizaje'], $_POST['promedio'], $_POST['recinto']);
               
            }//if formulario
            
             include '/opt/lampp/htdocs/estudiantes/Tarea2B03675/view/Formulario3View.php';
        }
    }
}
?>