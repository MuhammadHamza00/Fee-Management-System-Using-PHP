<!-- CREATE TABLE `fms`.`admin` (`id` INT(5) NOT NULL AUTO_INCREMENT , `name` VARCHAR(30) NOT NULL , `pass` VARCHAR(10) NOT NULL , `cpass` VARCHAR(10) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


INSERT INTO `admin` (`id`, `name`, `pass`, `cpass`) VALUES (NULL, 'Admin', 'admin', 'admin');

INSERT INTO `management` (`id`, `dname`, `name`, `pass`, `cpass`) VALUES (NULL, 'Department of CS IT', 'Ahmed', '123', '123');

CREATE TABLE `fms`.`management` (`id` INT(10) NOT NULL AUTO_INCREMENT , `dname` VARCHAR(30) NOT NULL , `name` VARCHAR(30) NOT NULL , `pass` INT(10) NOT NULL , `cpass` INT(10) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;



CREATE TABLE `fms`.`students` (`id` INT(5) NULL , `name` VARCHAR(30) NOT NULL , `f_name` VARCHAR(30) NOT NULL , `session` INT(5) NOT NULL , `semester` INT(5) NOT NULL , `d_name` VARCHAR(40) NOT NULL , `p_name` VARCHAR(25) NOT NULL , `f_type` VARCHAR(10) NOT NULL , `status` INT(2) NOT NULL , `date` DATE NOT NULL , `s_r` INT(2) NOT NULL , `total` INT NOT NULL , `rollno` TEXT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`rollno`)) ENGINE = InnoDB;

 -->




<!-- 
 INSERT INTO `rules` (`id`, `dname`, `pname`, `bus`, `com`, `lab`, `tour`, `dev`, `exam`, `tuition`, `admin`, `total`) VALUES (NULL, 'Department of CS IT', 'BSCS', '100', '200', '100', '0', '100', '100', '8000', '3000', '11600'); -->






 <!-- ALTER TABLE `programs` ADD FOREIGN KEY (`dep_id`) REFERENCES `departments`(`dep_id`) ON DELETE RESTRICT ON UPDATE RESTRICT; -->


 <!-- INSERT INTO `programs` (`p_id`, `p_name`, `dep_id`) VALUES (NULL, 'BSCS', '1'); -->


 <!-- INSERT INTO `management` (`id`, `dep_id`, `name`, `pass`, `cpass`) VALUES (NULL, '3', 'Haris', '1122', '1122'); -->
<!-- 
 <?php
                                $sql = "SELECT * FROM rules";
                              
                                $result = mysqli_query($connect, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    for ($i=1; $i <= 8; $i++) { 
                                    while ($row = mysqli_fetch_assoc($result)) {
                                            if ($i != $row['sem']) {
                                                echo "<option>" . $i . "</option>";
                                            }
                                        }
                                    }
                                }
                                ?> -->