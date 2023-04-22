<?php
@session_start();
if(!isset($_SESSION["email"])){
  header("Location: /admin/login/login.php");
}

require $_SERVER['DOCUMENT_ROOT']."/template/dashboard/includes/BDi.php"
?>
