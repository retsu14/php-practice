<form method='POST'>
    <?php 
        require "../config/dbconfig.php";
        $student = new Database();
        $dbConn = $student->getDb();

        if(isset($_GET["updateid"])){
            $id = $_GET["updateid"];
            
            $sql = "SELECT * from assignmentlist WHERE ass_id = :id";
            $stmt = $dbConn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            
            $students = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $title = $students["ass_title"];
            $score = $students["total_score"];
            $term = $students["term"];
    }
?>
    <div class="p-6 space-y-6">

        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="title" id="floating_email"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="<?php echo $title ?>" />
            <label for="floating_email"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Assignment
                Title</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="score" id="floating_email"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="<?php echo $score ?>" />
            <label for="floating_email"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Total
                score</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="term" id="floating_password"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " value="<?php echo $term ?>" />
            <label for="floating_password"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Term</label>
        </div>
    </div>

    <!-- Modal footer -->
    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
        <input type="submit" value="Update" name="updateAss"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    </div>
    <?php 
    require_once "../object/student.php";
        $id = $_GET["updateid"];
        if(isset($_POST["updateAss"])){     
            $title = $_POST["title"];
            $score = $_POST["score"];
            $term = $_POST["term"];
    
            $stud = array(
                "id" => $id,
                "title" => $title,
                "score" => $score,
                "term" => $term,
            );
    
            $student = new Student();
            $student->updateAssignment($stud);
        }
    ?>
</form>