<?php
session_start();
   require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/BDi.php';

// Submit Avaria
if(isset($_POST["submitAvaria"])){
  
  $nome= $_SESSION["nome"];
  $email = $_SESSION["email"];
  $info = $_POST['NumeroProduto'];
  $escola = $_POST['escolas'];
  $numeroSala= $_POST['sala'];
  $problema = $_POST['diagnostico'];
  $problemaComum1 = $_POST['problemaComum1'];
  $problemaComum2 = $_POST['problemaComum2'];
  $problemaComum3 = $_POST['problemaComum3'];
  $problemaComum4 = $_POST['problemaComum4'];
  $problemaComum5 = $_POST['problemaComum5'];
  $problemaComum6 = $_POST['problemaComum6'];
  
  $problemaGeral = "$problemaComum1 | $problemaComum2 | $problemaComum3 | $problemaComum4 | $problemaComum5 | $problemaComum6 | $problema";
  
   $result_explode = explode('|', $info);
   $numeroProduto = $result_explode[0];
   $designacao = $result_explode[1];

  
        $stmt = $DB->prepare("INSERT INTO reparacoes (nome,emailRegisto,numeroProduto,designacao,escola,numeroSala,problema,problemasComuns) VALUES (?,?,?,?,?,?,?,?)");
      $stmt->bind_param('ssssssss', $nome, $email, $numeroProduto,$designacao,$escola,$numeroSala,$problema,$problemaGeral);
        $stmt->execute();

             //atividade utilizador Submit Avaria
    $stmt = $DB->prepare("INSERT INTO log (idUtilizador, foto,nome, descricao) VALUES (?,?,?,'Reportou uma Avaria')");
          $stmt->bind_param('sss',$_SESSION['idUser'], $_SESSION['foto'], $_SESSION['nome']);
    $stmt->execute();

  $_SESSION['adicionarAvaria'] = 'teste';
  
}

// Submit Reparação
if(isset($_POST["submitReparacao"])){
      
      $numeroProduto = $_POST['numeroRegistarReparacao'];
      $idUserReparacao = $_SESSION['nome'];
      $emailTecnico = $_SESSION['email'];
      $reparacao = $_POST['diagnosticoReparacao'];

      
  
       $stmt = $DB->prepare("UPDATE `reparacoes` SET `idUserReparacao`=?,emailTecnico=?, reparacao=?, estadoReparacao='1' WHERE numero=?");
        $stmt->bind_param('ssss',$idUserReparacao,$emailTecnico, $reparacao,$numeroProduto);
        $stmt->execute();

           //atividade utilizador Submit Reparacao
    $stmt = $DB->prepare("INSERT INTO log (idUtilizador, foto,nome, descricao) VALUES (?,?,?,'Fez uma reparação')");
          $stmt->bind_param('sss',$_SESSION['idUser'], $_SESSION['foto'], $_SESSION['nome']);
    $stmt->execute();
  
  $_SESSION['adicionarReparacao'] = 'teste1';
}

// Editar Diagnostico da reparação
if(isset($_POST["submitEditarReparacao"])){
      
      $numeroProduto = $_POST['numero'];
      $reparacao = $_POST['reparacao'];
      
  
       $stmt = $DB->prepare("UPDATE `reparacoes` SET reparacao=? WHERE numero=?");
        $stmt->bind_param('ss',$reparacao,$numeroProduto);
        $stmt->execute();

           //atividade utilizador Editou uma reparacao
    $stmt = $DB->prepare("INSERT INTO log (idUtilizador, foto,nome, descricao) VALUES (?,?,?,'Editou uma reparação')");
          $stmt->bind_param('sss',$_SESSION['idUser'], $_SESSION['foto'], $_SESSION['nome']);
    $stmt->execute();
}

// Apagar Avaria
if(isset($_POST["submitApagar"])){
  
    $idAvaria = $_POST['numero'];
   
        $stmt = $DB->prepare("DELETE FROM `reparacoes` WHERE `numero`=?");
    $stmt->bind_param('s', $idAvaria);
        $stmt->execute();
  
  

}

$nivel = $_SESSION['nivel'];

if($nivel != 2) {
    
     header("Location: /public/admin/gerir/avarias");
} else {
  
    header("Location: /public/equipamentos/registar/avarias");
}

?>