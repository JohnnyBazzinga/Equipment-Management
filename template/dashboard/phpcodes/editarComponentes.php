<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/BDi.php';

if(isset($_POST['submit'])) {

  
    $id_composicao = $_POST['numero_Produto'];

    //Processador
    $stmt = $DB->prepare("UPDATE produto SET designacao=?, marca=?,obs=? WHERE composto=? and codTipoProduto = 6");
    $stmt->bind_param('sssd',$_POST['processador_Designacao'], $_POST['processador_Marca'] ,$_POST['processador_Obs'], $id_composicao);
    $stmt->execute();
  
  
      //BIOS
    $stmt = $DB->prepare("UPDATE produto SET marca=? WHERE composto=? and codTipoProduto = 7");
    $stmt->bind_param('sd',$_POST['bios_Marca'], $id_composicao);
    $stmt->execute();
  
      //RAM
    $stmt = $DB->prepare("UPDATE produto SET designacao=?, marca=?,obs=? WHERE composto=? and codTipoProduto = 11");
    $stmt->bind_param('sssd',$_POST['chipset_Designacao'], $_POST['chipset_Marca'], $_POST['chipset_Obs'], $id_composicao);
    $stmt->execute();
  
  
      //MotherBoard
    $stmt = $DB->prepare("UPDATE produto SET designacao=? WHERE composto=? and codTipoProduto = 5");
    $stmt->bind_param('sd',$_POST['board_Designacao'], $id_composicao);
    $stmt->execute();
 
    
    //Storage
    $stmt = $DB->prepare("UPDATE produto SET designacao=?, marca=?,obs=? WHERE composto=? and codTipoProduto = 8");
    $stmt->bind_param('sssd',$_POST['storage_Designacao'], $_POST['storage_Marca'],$_POST['storage_Obs'], $id_composicao);
    $stmt->execute();

  
      //display
    $stmt = $DB->prepare("UPDATE produto SET designacao=?, marca=?,obs=? WHERE composto=? and codTipoProduto = 9");
    $stmt->bind_param('sssd',$_POST['display_Designacao'], $_POST['display_Marca'] ,$_POST['display_Obs'], $id_composicao);
    $stmt->execute();

    //Software
    $stmt = $DB->prepare("UPDATE produto SET designacao=?, marca=? WHERE composto=? and codTipoProduto = 10");
    $stmt->bind_param('ssd',$_POST['software_Designacao'], $_POST['software_Marca'], $id_composicao);
    $stmt->execute();
  
}

      $_SESSION['editarComponentes'] = 'teste1';
        header("Location: http://stock.alunos.esmonserrate.org/public/equipamentos/adicionar");

?>