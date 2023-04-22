<?php
session_start();
   require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/BDi.php';

// Adicionar Tarefa
if(isset($_POST["submitAdd"])){
  
  $realizado = 0;
  $tarefa = $_POST['descTarefa'];
  $numeroSala = $_POST['sala'];
  
      $stmt = $DB->prepare("INSERT INTO `tarefas`(`tarefa`,numeroSala, realizado) VALUES (?,?,?)");
    $stmt->bind_param('ssi', $tarefa, $numeroSala, $realizado);
        $stmt->execute();
  
          //atividade utilizador Adicionou tarefa
    $stmt = $DB->prepare("INSERT INTO log (idUtilizador, foto,nome, descricao) VALUES (?,?,?,'Adicionou uma tarefa')");
          $stmt->bind_param('sss',$_SESSION['idUser'], $_SESSION['foto'], $_SESSION['nome']);
    $stmt->execute();
}

// Fazer Tarefa
if(isset($_POST["submitFazerTarefa"])){
  
  $quemRealiza = $_SESSION['nome'];
  $idTarefa= $_POST["idTarefa"];
  $realizado = 1;
        $stmt = $DB->prepare("UPDATE `tarefas` SET `realizado`=?, quemRealiza=? WHERE `id`=?");
    $stmt->bind_param('dsd',$realizado,$quemRealiza, $idTarefa);
        $stmt->execute();
  
          //atividade utilizador Executou uma tarefa
    $stmt = $DB->prepare("INSERT INTO log (idUtilizador, foto,nome, descricao) VALUES (?,?,?,'Executou uma tarefa')");
          $stmt->bind_param('sss',$_SESSION['idUser'], $_SESSION['foto'], $_SESSION['nome']);
    $stmt->execute();
}

// Terminar Tarefa
if(isset($_POST["submitTerminar"])){
  
  $idTarefa = $_POST['idTarefaConcluir'];
  $terminado = 2;
  
      $stmt = $DB->prepare("UPDATE `tarefas` SET realizado=? WHERE id=?");
    $stmt->bind_param('ss', $terminado, $idTarefa);
        $stmt->execute();
  
           //atividade utilizador Terminou tarefa
    $stmt = $DB->prepare("INSERT INTO log (idUtilizador, foto,nome, descricao) VALUES (?,?,?,'Terminou uma tarefa')");
          $stmt->bind_param('sss',$_SESSION['idUser'], $_SESSION['foto'], $_SESSION['nome']);
    $stmt->execute();
}



      header("Location: /public/equipamentos/inicio");
?>