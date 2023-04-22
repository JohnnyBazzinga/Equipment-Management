<?php
   require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/BDi.php';

if(isset($_POST["submitAdd"])){
  
  $escola = $_POST['escolas'];
  $sala = $_POST['numeroSala'];
  $descritivo = $_POST['descritivoAdicionar'];
  

        
 $stmt = $DB->prepare("INSERT INTO `salas`(numeroSala,escola,descritivo) VALUES (?,?,?)");
    $stmt->bind_param('sss', $sala,$escola,$descritivo);
        $stmt->execute();
}

if(isset($_POST["submit"])){
  
    $descritivo = $_POST['descritivo'];
    $id = $_POST['idSala'];
  
        $stmt = $DB->prepare("UPDATE `salas` SET `descritivo`=? WHERE `id`=?");
      $stmt->bind_param('ss', $descritivo, $id);
        $stmt->execute();
}

if(isset($_POST["submitApagar"])){
  
    $id = $_POST['numeroSalaApagar'];
   
        $stmt = $DB->prepare("DELETE FROM `salas` WHERE `id`=?");
    $stmt->bind_param('s', $id);
        $stmt->execute();

}
      header("Location: http://stock.alunos.esmonserrate.org/public/admin/gerir/salas");
?>