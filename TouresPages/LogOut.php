<?php
include "navbar.php";
session_start();
unset($_SESSION["Fname"]);
unset($_SESSION["Lname"]);
unset($_SESSION["Email"]);
header("Location:../Opages/loginTourest.php");
closeCon($conn);
?>