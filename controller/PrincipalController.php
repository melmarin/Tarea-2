<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PrincipalController
 *
 * @author Usuario
 */
class PrincipalController {
    private $controller;
    private $model;
    private $ruta = '/opt/lampp/htdocs/estudiantes/Tarea2B03675/';
    
     public function invoke() {
         
         if (isset($_GET['formulario1'])){
             include($this->ruta.'controller/Formulario1Controller.php');
            $this->controller = new Formulario1Controller();
            $this->controller->invoke();
            
         }//if formulario
         
         elseif (isset($_GET['formulario2'])){
              include($this->ruta.'controller/Formulario2Controller.php');
            $this->controller = new Formulario2Controller();
            $this->controller->invoke();
         }
         
          elseif (isset($_GET['formulario3'])){
             include($this->ruta.'controller/Formulario3Controller.php');
            $this->controller = new Formulario3Controller();
            $this->controller->invoke();
         }
         
          elseif (isset($_GET['formulario4'])){
             include($this->ruta.'controller/Formulario4Controller.php');
            $this->controller = new Formulario4Controller();
            $this->controller->invoke();
         }
         
         elseif (isset($_GET['formulario5'])){
            include($this->ruta.'controller/Formulario5Controller.php');
            $this->controller = new Formulario5Controller();
            $this->controller->invoke();
         }
         
         else{
             include($this->ruta.'view/indexView.php');
         }
     }
}
?>