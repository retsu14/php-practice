<?php
require_once("../config/dbconfig.php");
    class Student{
        private $db;

        public function __construct(){
            $dbcon = new Database();
            $this->db = $dbcon->getDb();
        }
        public function getDb(){
            return $this->db;
        }   
        public function saveStudent($stud){
            try{
            $sql = "call sp_insert_student(:fname, :lname)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':fname',$stud['fname']);
            $stmt->bindParam(':lname',$stud['lname']);
            
                $stmt->execute();
                if($stmt){
                    header("Location: ../../studentni.php");
                    
                }else{
                    return 0;
                }
            }catch(Exception $ex){
                return -1;
            }
        }
        public function deleteStudent($id){
            try {
            $sql = "DELETE from stutdent where stud_id = $id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
                if($stmt){
                    header("Location: ../../studentni.php");
                    
                }
            } catch (Exception $e) {
                return -1;
            }
        }
        public function deleteAssignment($id){
            try {
            $sql = "DELETE from assignmentlist where ass_id = $id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
                if($stmt){
                    header("Location: ../../assignment.php");
                    
                }
            } catch (Exception $e) {
                return -1;
            }
        }
        public function saveAssignment($ass){
            try {
                $sql = "call sp_insert_assignmentlist(:asstitle, :score, :term)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":asstitle", $ass["assTitle"]);
                $stmt->bindParam(":score", $ass["totalScore"]);
                $stmt->bindParam(":term", $ass["term"]);
                $stmt->execute();
                if($stmt){
                    header("Location: ../../assignment.php");
                    
                }
            } catch (Exception $e) {
                return -1;
            }
            
        }
        public function saveAssigns($bogophp){
            try {
                $sql = "call sp_insertFo(:name_id, :ass_id, :datee, :score)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":name_id", $bogophp["name"]);
                $stmt->bindParam(":ass_id", $bogophp["subject"]);
                $stmt->bindParam(":datee", $bogophp["date"]);
                $stmt->bindParam(":score", $bogophp["score"]);
                $stmt->execute();
             if($stmt){
                    header("Location: ../../index.php");
                    
                }
            } catch (Exception $e) {
                return -1;
            }
            
        }
        public function updateStudent($student){
            try {
                $sql = "UPDATE stutdent set lname = :lname, fname = :fname where stud_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":id", $student["id"]);
                $stmt->bindParam(":fname", $student["fname"]);
                $stmt->bindParam(":lname", $student["lname"]);
                $stmt->execute();
                if($stmt){
                    echo "
                        <script>window.location.href='../../studentni.php';</script>
                    ";
                }
            } catch (Exception $e) {
                return -1;
            }
        }
        public function updateAssignment($student){
            try {
                $sql = "UPDATE assignmentlist set ass_title = :title, total_score = :score, term = :term where ass_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":id", $student["id"]);
                $stmt->bindParam(":title", $student["title"]);
                $stmt->bindParam(":score", $student["score"]);
                $stmt->bindParam(":term", $student["term"]);
                $stmt->execute();
                if($stmt){
                    echo "
                        <script>window.location.href='../../assignment.php';</script>
                    ";
                    
                }
            } catch (Exception $e) {
                return -1;
            }
        }
        public function deleteAssign($id){
            try {
                $sql = "DELETE from assignment where id=$id";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                if($stmt){
                    header("Location: ../../index.php");
                }

            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        public function updateAssign($student){
            $sql = "UPDATE assignment as a join stutdent as s on a.stud_id = s.stud_id JOIN assignmentlist as ass on a.ass_id = ass.ass_id set fname = :fname, ass_title = :ass_title, score = :score, ass_deadline = :deadline where id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id", $student["id"]);
            $stmt->bindParam(":fname", $student["name"]);
            $stmt->bindParam(":ass_title", $student["subject"]);
            $stmt->bindParam(":deadline", $student["date"]);
            $stmt->bindParam(":score", $student["score"]);
            $stmt->execute();
            if($stmt){
                echo "
                        <script>window.location.href='../../index.php';</script>
                    ";
            }

        }
        
    }