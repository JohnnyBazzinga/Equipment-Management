<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/BDi.php';

if(isset($_POST["submitAvaria"])){
  
  $numeroProduto = $_POST['numeroProdutoComposto'];
  $designacao = $_POST['designacaoComposto'];
  $numeroSala = $_POST['numeroSala'];
  $dataComposto = $_POST['dataComposto'];
  $problema = $_POST['problema'];
  $nome = $_SESSION['nome'];
  $email = $_SESSION['email'];
  
  
  
        $stmt = $DB->prepare("INSERT INTO reparacoes (nome,emailRegisto,numeroProduto,designacao,numeroSala,problema) VALUES (?,?,?,?,?,?)");
      $stmt->bind_param('ssssss', $nome, $email, $numeroProduto,$designacao,$numeroSala,$problema);
        $stmt->execute();
  
  
            //atividade utilizador Adicionar Avaria
    $stmt = $DB->prepare("INSERT INTO log (idUtilizador, foto,nome, descricao) VALUES (?,?,?,'Adicionou uma avaria')");
          $stmt->bind_param('ss',$_SESSION['idUser'], $_SESSION['foto'], $_SESSION['nome']);
    $stmt->execute();
}
     header("Location: /template/dashboard/listarEquipamentos.php");

?>
