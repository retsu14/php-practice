<?php 
    require_once("../object/student.php");
    $name = isset($_POST['ngan']) ? $_POST['ngan'] : '';
    $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $score = isset($_POST['score']) ? $_POST['score'] : '';

    $bogophp = array(
        "name" => $name,
        "subject" => $subject,
        "date" => $date,
        "score" => $score
     );
    $batiphp = new Student();
    $batiphp->saveAssigns($bogophp);