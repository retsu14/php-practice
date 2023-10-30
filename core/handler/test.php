<?php
    require_once("../object/student.php");
    //student
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';


    $stud = array(
        "fname" => $fname,
        "lname" => $lname
    );

    $student = new Student();
    $ret =  $student->saveStudent($stud);