<?php
// connection to Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "FMS";

$connect = mysqli_connect($servername, $username, $password, $database);

$sql = "CREATE TABLE IF NOT EXISTS `fms`.`admin` (`id` INT(5) NOT NULL AUTO_INCREMENT , `name` VARCHAR(30) NOT NULL , `pass` VARCHAR(10) NOT NULL , `cpass` VARCHAR(10) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
";
if (!mysqli_query($connect, $sql)) {
    echo "Error" . mysqli_error($connect);
}
$sql ="CREATE TABLE IF NOT EXISTS `fms`.`management` (`id` INT(10) NOT NULL AUTO_INCREMENT , `dname` VARCHAR(30) NOT NULL , `name` VARCHAR(30) NOT NULL , `pass` INT(10) NOT NULL , `cpass` INT(10) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

if (!mysqli_query($connect, $sql)) {
    echo "Error" . mysqli_error($connect);
} 

$sql = "CREATE TABLE `fms`.`students` (`id` INT(5) NULL , `name` VARCHAR(30) NOT NULL , `f_name` VARCHAR(30) NOT NULL , `session` INT(5) NOT NULL , `semester` INT(5) NOT NULL , `d_name` VARCHAR(40) NOT NULL , `p_name` VARCHAR(25) NOT NULL , `f_type` VARCHAR(10) NOT NULL , `status` INT(2) NOT NULL , `date` DATE NOT NULL , `s_r` INT(2) NOT NULL , `total` INT NOT NULL , `rollno` TEXT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`rollno`)) ENGINE = InnoDB;
";

if (!$connect) {
    echo "Unable to Connect with Database".$database;
}

?>
