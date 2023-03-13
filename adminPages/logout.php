<?php
include "navbar.php";
session_start();
unset($_SESSION["adminID"]);

header("Location:../Opages/admin.php");
closeCon($conn);
?>