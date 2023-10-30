-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 04:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `im2_3c`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteAss` (IN `_id` INT(11))  SQL SECURITY INVOKER BEGIN
  DELETE
  FROM assignment where id = _id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteAssignment` (IN `_ass_id` INT(11))  SQL SECURITY INVOKER BEGIN
  DELETE
  FROM assignmentlist where ass_id = _ass_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteStudent` (IN `_stud_id` INT(11))  SQL SECURITY INVOKER BEGIN
  DELETE
  FROM stutdent where stud_id = _stud_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `logIn` (IN `_username` VARCHAR(255), IN `_passwordd` VARCHAR(255))  SQL SECURITY INVOKER BEGIN
  SELECT
    *
  FROM users
  WHERE username = _username AND password = _passwordd;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getAssignment` ()  SQL SECURITY INVOKER BEGIN
  SELECT * 
  FROM assignmentlist;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getStudent` ()  SQL SECURITY INVOKER BEGIN
  SELECT *
  FROM stutdent;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_hile` ()  SQL SECURITY INVOKER BEGIN
    DECLARE i int;
    SET i = 0;
   
    WHILE i <= 10 DO
      SELECT CONCAT('Current value of i is ',i);
      set i = i + 1;
    end while;

    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_if` (IN `_op` CHAR(1), `_num1` NUMERIC(10,2), `_num2` NUMERIC(10,2))  SQL SECURITY INVOKER BEGIN
     /* DECLARE result numeric(10,2);
      DECLARE label varchar(50);

      SET result = 0;
      IF _op = '+' THEN 
        set result = _num1 + _num2;
        set label = 'Addition';
      ELSEIF _op = '-' THEN 
        set result = _num1 - _num2;
        set label = 'Subtraction';
      ELSEIF _op = '*' THEN 
        set result = _num1 * _num2;
        set label = 'Multiplication';
     ELSEIF _op = '/' THEN 
        set result = _num1 / _num2;
        set label = 'Division';
     ELSE
      set result = 0;
        set label = 'Invalid character';
        set _num1 = 0;
        set _num2 = 0;
      End if; 

     select  concat('The Operation selected is ',
                   label,
                   ' ',_num1,
                   ' ',_op ,
                   ' ',_num2,' = ', result); */
       SELECT case _op
              when '+' THEN _num1 + _num2
              when '-' THEN _num1 - _num2
              when '*' THEN _num1 * _num2
              when '/' THEN _num1 / _num2
             else 0
        end as calculator;
  End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertFo` (IN `_name_id` INT(11), IN `_ass_id` INT(11), IN `_datee` VARCHAR(255), IN `_score` INT(11))  SQL SECURITY INVOKER BEGIN
  INSERT into assignment(stud_id, ass_id, ass_deadline, score)
  VALUES(_name_id, _ass_id, _datee, _score);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_assignmentlist` (IN `_ass_title` VARCHAR(255), IN `_total_score` INT(11), IN `_term` VARCHAR(255))  SQL SECURITY INVOKER BEGIN
  insert INTO assignmentlist(ass_title, total_score, term)
  VALUES(_ass_title, _total_score, _term);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_student` (IN `_fname` VARCHAR(25), IN `_lname` VARCHAR(25))  SQL SECURITY INVOKER BEGIN
  INSERT INTO stutdent(fname,lname)
  VALUES(_fname,_lname);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_leftjoin` ()  SQL SECURITY INVOKER BEGIN
  SELECT id, fname, lname, ass_title, ass_deadline,score, term
  FROM assignment as a JOIN stutdent as s on a.stud_id = s.stud_id JOIN assignmentlist as ass on a.ass_id = ass.ass_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_variables` (IN `_op` VARCHAR(1))  SQL SECURITY INVOKER BEGIN
    DECLARE num1 int;
    DECLARE num3 int;
    DECLARE operation varchar(50);

    DECLARE result numeric;
    
  --  set operation = '/';
    set num1 = 10;
    set num3 = 30;

   SELECT CASE _op
    WHEN '+' THEN num1 + num3
    WHEN '-' then num1 - num3
    WHEN '*' THEN num1 * num3
    WHEN '/' then num1 / num3
    WHEN '%' THEN num1 % num3
    else
        0
   END AS op;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateAssign` (IN `_id` INT(11), IN `_fname` VARCHAR(255), IN `_ass_title` VARCHAR(255), IN `_score` INT(11), IN `_ass_deadline` VARCHAR(255))  SQL SECURITY INVOKER BEGIN
  UPDATE assignment as a JOIN stutdent as s on a.stud_id = s.stud_id JOIN assignmentlist as ass on a.ass_id = ass.ass_id set fname = _fname, ass_title = _ass_title, 
  score = _score, ass_deadline = _ass_deadline where id = _id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateAssignment` (IN `id` INT(11), IN `_ass_title` VARCHAR(255), IN `_total_score` INT(11), IN `_term` VARCHAR(255))  SQL SECURITY INVOKER BEGIN
  UPDATE assignmentlist
  set ass_title = _ass_title, total_score = _total_score, term = _term
  WHERE ass_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateStudent` (IN `id` INT(11), IN `firstname` VARCHAR(255), IN `lastname` VARCHAR(255))  SQL SECURITY INVOKER BEGIN
  UPDATE stutdent
  SET lname = lastname, fname = firstname
  WHERE stud_id = id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `stud_id` int(11) DEFAULT NULL,
  `ass_id` int(11) DEFAULT NULL,
  `ass_deadline` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `assignmentlist`
--

CREATE TABLE `assignmentlist` (
  `ass_id` int(11) NOT NULL,
  `ass_title` varchar(255) DEFAULT NULL,
  `total_score` int(11) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stutdent`
--

CREATE TABLE `stutdent` (
  `stud_id` int(11) NOT NULL,
  `fname` varchar(25) DEFAULT '''NULL''',
  `lname` varchar(25) DEFAULT '''NULL'''
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user`) VALUES
(1, 'admin', 'admin', 'admin'),
(3, 'user', 'user', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_assignment_stutdent_stud_id` (`stud_id`),
  ADD KEY `FK_assignment_assignmentlist_ass_id` (`ass_id`);

--
-- Indexes for table `assignmentlist`
--
ALTER TABLE `assignmentlist`
  ADD PRIMARY KEY (`ass_id`);

--
-- Indexes for table `stutdent`
--
ALTER TABLE `stutdent`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `assignmentlist`
--
ALTER TABLE `assignmentlist`
  MODIFY `ass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `stutdent`
--
ALTER TABLE `stutdent`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `FK_assignment_assignmentlist_ass_id` FOREIGN KEY (`ass_id`) REFERENCES `assignmentlist` (`ass_id`),
  ADD CONSTRAINT `FK_assignment_stutdent_stud_id` FOREIGN KEY (`stud_id`) REFERENCES `stutdent` (`stud_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
