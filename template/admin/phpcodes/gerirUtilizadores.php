<?php
session_start();
   require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/BDi.php';

if(isset($_POST["submitAdd"])){
  
  $nome = $_POST['nomeAdd'];
  $email = $_POST['emailAdd'];
  $nivel = $_POST['nivelAdd'];
  
        
  $stmt = $DB->prepare("INSERT INTO `gestaoUtilizadores`(nome,email,nivel) VALUES (?,?,?)");
    $stmt->bind_param('sss', $nome,$email,$nivel);
        $stmt->execute();
  $_SESSION['adicionar'] = 'teste';
}

if(isset($_POST["submitApagar"])){
  
    $idUser = $_POST['idUser'];
   
        $stmt = $DB->prepare("DELETE FROM `gestaoUtilizadores` WHERE `idUser`=?");
    $stmt->bind_param('s', $idUser);
        $stmt->execute();
  
    $_SESSION['apagar'] = 'teste';
}

if(isset($_POST["submitEditar"])){
  
    $idUser = $_POST['idUser_Edita'];
    $nivel = $_POST['nivel'];
  
        $stmt = $DB->prepare("UPDATE `gestaoUtilizadores` SET `nivel`=? WHERE `idUser`=?");
      $stmt->bind_param('ss', $nivel, $idUser);
        $stmt->execute();
    $_SESSION['status'] = 'teste';
}

      header("Location: http://stock.alunos.esmonserrate.org/public/admin/atribuir/niveis");

?>

