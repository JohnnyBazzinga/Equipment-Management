<?php
   require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/BDi.php';
if(isset($_POST["submitEditar"])){
  
    $idEscola = $_POST['idEscola'];
    $escola = $_POST['nome'];
  
        $stmt = $DB->prepare("UPDATE `escolas` SET `escola`=? WHERE `id`=?");
      $stmt->bind_param('ss', $escola, $idEscola);
        $stmt->execute();
}
if(isset($_POST["submitEscola"])){
  
    $escola = $_POST['escolaNome'];
  
        $stmt = $DB->prepare("INSERT INTO `escolas` (escola) VAlUES (?)");
      $stmt->bind_param('s', $escola);
        $stmt->execute();
}

if(isset($_POST["submitApagar"])){
  
    $id = $_POST['idUser'];
   
        $stmt = $DB->prepare("DELETE FROM `escolas` WHERE `id`=?");
    $stmt->bind_param('s', $id);
        $stmt->execute();

}
  header ("Location: http://stock.alunos.esmonserrate.org/public/admin/gerir/escolas")

?>