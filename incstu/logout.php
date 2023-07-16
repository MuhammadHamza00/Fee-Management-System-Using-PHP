<?php
session_start();

unset($_SESSION['name']);
unset($_SESSION['rollno']);
unset($_SESSION['id']);

 // Or destroy the entire session
session_destroy();

header("Location: ../home.php");
exit;
?>