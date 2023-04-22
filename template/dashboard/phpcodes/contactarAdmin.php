<?php
session_start();
   require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/BDi.php';
if(isset($_POST["contactarAdminSubmit"])){
  
  $idUser = $_SESSION["idUser"];
  $nome= $_SESSION["nome"];
  $tipo = $_POST['tipo'];
  $msg = $_POST['contactarAdmin'];

    $diretorio = "http://stock.alunos.esmonserrate.org/template/dashboard/phpcodes/imagensSuporte/".$_FILES["uploadfile"]["name"];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
    $folder = "imagensSuporte/".$filename;
    
  
        $stmt = $DB->prepare("INSERT INTO mensagemAdmin (idUser,nome,tipo,mensagem,imagem) VALUES (?,?,?,?,?)");
        $stmt->bind_param('sssss', $idUser, $nome,$tipo, $msg, $diretorio);
        $stmt->execute();
  
          // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }
}
     //header("Location: /public/equipamentos/inicio");

?>