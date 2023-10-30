<?php 
require_once("../object/student.php");

    $assTitle = isset($_POST['asstitle']) ? $_POST['asstitle'] : '';
    $totalScore = isset($_POST['score']) ? $_POST['score'] : '';
    $term = isset($_POST['term']) ? $_POST['term'] : '';

    $ass = array(
        "assTitle" => $assTitle,
        "totalScore" => $totalScore,
        "term" => $term
    );

    $student = new Student();
    $student->saveAssignment($ass);