<?php
           header("Access-Control-Allow-Origin: *");
           // header("Content-Type: application/json; charset=UTF-8");
           header("Access-Control-Allow-Methods: POST");
           header("Access-Control-Max-Age: 3600");
           header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
          
           session_start();
           require_once("../objects/student.php");
       
          
           $method = isset($_POST['method']) ? $_POST['method'] : exit();

           if(function_exists($method)){
            call_user_func($method);
            }else{
                exit();
            }