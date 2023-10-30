<?php
require_once("../config/dbocnfig.php");
class AssignmentList{
    private $db;

    public function __construct()
    {
        $dbConn = new Database();
        $this->db = $dbConn->getDb();
    }

    public function saveAssignmentList($assignments){
        
    }
}
?>