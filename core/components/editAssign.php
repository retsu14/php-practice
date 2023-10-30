<form method='POST' class="w-full">
    <?php 
        require "../config/dbconfig.php";
        $student = new Database();
        $dbConn = $student->getDb();

        if(isset($_GET["updateid"])){
            $id = $_GET["updateid"];
            
            $sql = "SELECT *
            FROM assignment as a JOIN stutdent as s on a.stud_id = s.stud_id JOIN assignmentlist as ass on a.ass_id = ass.ass_id where id = :id";
            $stmt = $dbConn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            
            $stud = $stmt->fetch(PDO::FETCH_ASSOC);
            $fname = $stud['fname'];
            $title = $stud["ass_title"];
            $lname = $stud["lname"];
            $deadline = $stud["ass_deadline"];
            $score = $stud["score"];
    }
    ?>
    <div class="p-6 space-y-6">

        <label for="underline_select" class="sr-only">Underline select</label>
        <select id="underline_select" name="ngan"
            class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
            <option><?php echo $fname ?></option>
            <?php 
                                        require_once("../config/dbconfig.php");
                                        $student = new Database();
                                        $student->getNames1();
                                    ?>
        </select>
        <label for="underline_select" class="sr-only">Underline select</label>
        <select id="underline_select" name="subject"
            class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
            <option><?php echo $title ?></option>
            <?php 
                                        require_once("../config/dbconfig.php");
                                        $assignment = new Database();
                                        $assignment->getAss1();
                                    ?>
        </select>
        <div class="flex justify-around items-center">
            <div class="relative max-w-sm w-50 flex-grow-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input datepicker datepicker-format="mm/dd/yyyy" type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select date" name="date" value="<?php echo $deadline; ?>">
            </div>
            <div class="flex-grow-1">
                <div class="relative z-0 w-full mb-6 group mt-5">
                    <input type="text" name="score" id="floating_email"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required value="<?php echo $score; ?>" />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Score</label>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal footer -->
    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
        <input type="submit" value='Update' name="updateAssign"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            id="save">

    </div>
    <?php 
    $id = $_GET["updateid"];
        if(isset($_POST['updateAssign'])){    
            $name = $_POST["ngan"];
            $subject = $_POST["subject"];
            $date = $_POST["date"];
            $score = $_POST["score"];

            $arr = [
                "id" => $id,
                "name" => $name,
                "subject" => $subject,
                "date" => $date,
                "score" => $score
            ];
            require_once("../object/student.php");
            $stud = new Student();
            $stud->updateAssign($arr);
        }
    ?>
</form>