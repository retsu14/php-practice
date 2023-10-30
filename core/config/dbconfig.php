<?php
    class Database{
        private $server = 'localhost';
        private $username = 'root';
        private $pwrd = '';
        private $db_name = 'im2_3c';

        private $conn = null;
        private $state;
        private $errmsg;

        public function __construct(){
            try{
                $this->conn = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->db_name, $this->username, $this->pwrd);
                $this->conn->exec("set names utf8");
                $this->state = true;
            }catch(PDOException $exception){
                $this->errmsg =  "Connection error: " . $exception->getMessage();
                $this->state = false;
            }
        }
        
        public function getDb(){
            return $this->conn;
        }
        public function getState(){
                return $this->state;
        }
        public function getErrorMsg(){
            return $this->errmsg;
        }
        
        public function getStudent(){
            try {
                $sql = "call sp_getStudent()";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();

                while($student = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $id = $student["stud_id"];
                    $fname = $student["fname"];
                    $lname = $student["lname"];
                    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        '.$fname.'
                    </th>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        '.$lname.'
                    </td>
                    <td class="px-6 py-4 flex">
                        <a href="./core/handler/delete.php?deleteid='.$id.'">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                height="24" viewBox="0 -960 960 960" width="24">
                                <path
                                    d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                            </svg>
                        </a>
                        <a href="./core/handler/update.php?updateid='.$id.'"class="stayOnCurrentPage">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                            width="24">
                            <path
                                d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
                        </svg>
                        </a>
                    </td>
                </tr>';
                }
            } catch (Exception $e) {
                return -1;
            }
        }
        public function getAssignment(){
            try {
                $sql = "call sp_getAssignment()";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();

                while($assignment = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $id = $assignment["ass_id"];
                    $asstitle = $assignment["ass_title"];
                    $totalscore = $assignment["total_score"];
                    $term = $assignment["term"];
                    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        '.$asstitle.'
                    </th>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        '.$totalscore.'
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        '.$term.'
                    </td>
                    <td class="px-6 py-4 flex">
                        <a href="./core/handler/delete.php?deleteidd='.$id.'">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                height="24" viewBox="0 -960 960 960" width="24">
                                <path
                                    d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                            </svg>
                        </a>
                        <a href="./core/handler/updateAss.php?updateid='.$id.'">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                            width="24">
                            <path
                                d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
                        </svg>
                        </a> 
                    </td>
                </tr>';
                }
            } catch (Exception $e) {
                echo $e;
            }
        }
        public function getNames(){
            try {
                $sql = "call sp_getStudent()";
                $stmt = $this->conn->prepare($sql);
                 $stmt->execute();

            while($student = $stmt->fetch(PDO::FETCH_ASSOC)){
                $id = $student["stud_id"];
                $name = $student["fname"];
                echo '
                <option value="'.$id.'">'.$name.'</option>
                ';
            }
            } catch (Exception $e) {
                echo $e;
            }
            
        }public function getNames1(){
            try {
                $sql = "call sp_getStudent()";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();

            while($student = $stmt->fetch(PDO::FETCH_ASSOC)){
                $name = $student["fname"];
                echo '
                <option value="'.$name.'">'.$name.'</option>
                ';
            }
            } catch (Exception $e) {
                echo $e;
            }
            
        }
        public function getAss(){
            try {
                $sql = "call sp_getAssignment()";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                while($assignment = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $id = $assignment["ass_id"];
                    $asstitle = $assignment["ass_title"];
                    echo '
                    <option value="'.$id.'">'.$asstitle.'</option>
                    ';
                }
            } catch (Exception $e) {
                return -1;
            }
        }
        public function getAss1(){
            try {
                $sql = "call sp_getAssignment()";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                while($assignment = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $asstitle = $assignment["ass_title"];
                    echo '
                    <option value="'.$asstitle.'">'.$asstitle.'</option>
                    ';
                }
            } catch (Exception $e) {
                return -1;
            }
        }
        public function getAssign(){
            try {
                $sql = "call sp_leftjoin()";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                while($ok = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $id = $ok["id"];
                    $fname = $ok["fname"];
                    $lname = $ok["lname"];
                    $title = $ok["ass_title"];
                    $deadline = $ok["ass_deadline"];
                    $score = $ok["score"];
                    $term = $ok["term"];
                    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        '.$fname.'
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        '.$lname.'
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        '.$title.'
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        '.$deadline.'
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        '.$score.'
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        '.$term.'
                    </td>
                    <td class="px-6 py-4 flex">
                        <a href="./core/handler/delete.php?deleteiddd='.$id.'">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                height="24" viewBox="0 -960 960 960" width="24">
                                <path
                                    d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                            </svg>
                        </a>
                        <a href="./core/handler/updateAssign.php?updateid='.$id.'" class="stayOnCurrentPage">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                            width="24">
                            <path
                                d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
                        </svg>
                        </a>
                    </td>
                </tr>';

                }
            } catch (Exception $e) {
                return -1;
            }
        }
        public function logIn($username, $password){
            
            $sql = "SELECT * FROM users WHERE username = :user AND password = :pass";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":user", $username);
            $stmt->bindParam(":pass", $password);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user["user"] == "admin"){
                session_start();
                $_SESSION["user"] = $user["user"];
                $_SESSION["username"] = $user["username"];
                header('Location: ../dashboard.php'); 
            }
            if ($user["user"] == "user") {
                session_start();
                $_SESSION["user"] = $user["user"];
                $_SESSION["username"] = $user["username"];
                header("Location: ../userdashboard.php");
            }
            
            // if ($user && password_verify($password, $user['password'])) {
            //     $_SESSION['user_id'] = $user['id'];
            //         header('Location: ../../dashboard.php'); 
            // } 
            // else {
            // header("Location: ../index.php");
            // }
        }
        
    } // end of classs