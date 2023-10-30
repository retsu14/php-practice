<?php 
    require_once("../object/student.php");
    if(isset($_GET["deleteid"])){
        $id = $_GET["deleteid"];

        $student = new Student();
        $student->deleteStudent($id);
        
    }
    if(isset($_GET["deleteidd"])){
        $id = $_GET["deleteidd"];

        $student = new Student();
        $student->deleteAssignment($id);
        
    }
    if(isset($_GET["deleteiddd"])){
        $id = $_GET["deleteiddd"];

        $student = new Student();
        $student->deleteAssign($id);
        
    }