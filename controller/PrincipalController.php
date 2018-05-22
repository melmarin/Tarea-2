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
    
     public function invoke() {
         
         if (isset($_GET['formulario1'])){
            require_once 'controller/Formulario1Controller.php';
            $this->controller = new Formulario1Controller();
            $this->controller->invoke();
            
         }//if formulario
         
         elseif (isset($_GET['formulario2'])){
             require_once 'controller/Formulario2Controller.php';
            $this->controller = new Formulario2Controller();
            $this->controller->invoke();
         }
         
          elseif (isset($_GET['formulario3'])){
             require_once 'controller/Formulario3Controller.php';
            $this->controller = new Formulario3Controller();
            $this->controller->invoke();
         }
         
          elseif (isset($_GET['formulario4'])){
             require_once 'controller/Formulario4Controller.php';
            $this->controller = new Formulario4Controller();
            $this->controller->invoke();
         }
         
         elseif (isset($_GET['formulario5'])){
            require_once 'controller/Formulario4Controller.php';
            $this->controller = new Formulario4Controller();
            $this->controller->invoke();
         }
         
         elseif (isset($_GET['inicio'])){
             include 'view/InicioView.php';
         }
         
         else{
             include 'view/IndexView.php';
         }
     }
}
