<?php
session_start();
if(!isset($_POST['submit'])) {
  header("Location: /public/equipamentos/adicionar");
  exit(0);
}

require $_SERVER['DOCUMENT_ROOT']."/template/dashboard/includes/BDi.php";
  $target_dir = $_SERVER['DOCUMENT_ROOT']."/template/dashboard/recolhaInformacao/ficheiros/";
  $target_file = $target_dir ."recolhaInformacao.txt";
  include ('qrcodeComposer/qrlib.php');
  error_reporting(0);



//Se o produto nao for 3(Computador) só faz a inserção do produto em si
if($_POST['codTipoProduto'] != 3 ) {
  
    function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} 
     $serie = generateRandomString(10);
  
     $stmt = $DB->prepare("INSERT INTO produto (designacao,composto,codTipoProduto,numeroSala,escola,serie) 
                  VALUES (?,0,?,?,?,?)");
    $stmt->bind_param('sssss',$_POST["designacao"],$_POST["codTipoProduto"],$_POST["salas"],$_POST["escolas"],$serie);
    $stmt->execute();
    $id_composicaoNaoComposto = $stmt->insert_id;
  
     $pasta = 'qrcodes/';
    
      $conteudo = 'http://stock.alunos.esmonserrate.org/template/dashboard/phpcodes/equipamentos.php?numeroProduto='.$id_composicaoNaoComposto.'&serie='.$serie.'&info=';
    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $nomeFicheiro = '005_file_'.md5($conteudo).'.png';
   
    $caminhoAbsoluto = $pasta.$nomeFicheiro;
    $caminhoRelativo = $pasta.$nomeFicheiro;
    $urlQrCodee = 'http://stock.alunos.esmonserrate.org/template/dashboard/phpcodes/'.$caminhoRelativo;

        // generating
    if (!file_exists($caminhoAbsoluto)) {
        QRcode::png($conteudo, $caminhoAbsoluto);
    } else {
      echo 'erro';
    }
      
      
            $stmt = $DB->prepare("UPDATE `produto` SET qrCode=? WHERE numeroProduto=?");
        $stmt->bind_param('ss',$urlQrCodee, $id_composicaoNaoComposto);
        $stmt->execute();
  
    $log_Add = 'Foi adicionado um equipamento na sala '.$_POST['salas'].' por '.$_SESSION['nome'].'.';
            //atividade utilizador Adicionar Equipamento
    $stmt = $DB->prepare("INSERT INTO log (idUtilizador, foto,nome,tipo, descricao) VALUES (?,?,?,'Adicionou um Equipamento',?)");
          $stmt->bind_param('ssss',$_SESSION['idUser'], $_SESSION['foto'], $_SESSION['nome'], $log_Add);
    $stmt->execute();
    
    $_SESSION['adicionarEquipamento'] = 'teste';
    header("Location: http://stock.alunos.esmonserrate.org/public/equipamentos/adicionar");
 
} // É um computador
else {
  
  if (move_uploaded_file($_FILES["ficheiro"]["tmp_name"], $target_file)) {

  }


  $nome = $_SESSION['nome'];
  
  
$ficheiro = fopen($target_file,"r");
$texto = fread($ficheiro,filesize($target_file));

$partes = explode("-------------------------------------------------------------------------",$texto);


$p = explode("Name", $partes[6]);
$p = explode("Codename", $p[1]);

$processador['marca'] = trim($p[0]);


$p = explode("Specification", $partes[6]);
$p = explode("Package", $p[1]);

$processador['designacao'] = trim($p[0]);

$p = explode("Package", $partes[6]);
$p = explode("CPUID", $p[1]);

$processador['Socket'] = trim($p[0]);


$p = explode("TDP Limit", $partes[6]);
$p = explode("Watts", $p[1]);

$processador['TDP'] = trim($p[0]);


$p = explode("Stock frequency", $partes[6]);
$p = explode("MHz", $p[1]);

$processador['Stock'] = trim($p[0]);

$processador['obs'] = trim('Socket' . ":" . $processador['Socket'] . "|" . 'TDP' . ":" .  $processador['TDP']  . "|" . 'Stock' . ":" . $processador['Stock']);


/*echo "Processador <br><br>";
print_r($processador);

echo "<br><br><br><br>";*/


//////////

$p = explode("BIOS Vendor", $partes[8]);
$p = explode("BIOS MSG", $p[1]);

$bios['marca'] = trim("Bios" . $p[0]);

  
/*echo "BIOS <br><br>";
print_r($bios);

echo "<br><br><br><br>";*/

//////////

$p = explode("Manufacturer(ID)", $partes[10]);
$p = explode(" (", $p[1]);

$chipset['marca'] = trim($p[0]);

$p = explode("Memory Type", $partes[9]);
$p = explode("Memory Size", $p[1]);

$chipset['designacao'] = trim($p[0]);
  
  

$p = explode("Memory Size", $partes[9]);
$p = explode("Channels", $p[1]);

$chipset['Memory Size'] = trim($p[0]);


$p = explode("Channels", $partes[9]);
$p = explode("Memory Frequency", $p[1]);

$chipset['Channels'] = trim($p[0]);

$chipset['obs'] = trim('Memory Size' . ":" . $chipset['Memory Size'] . "|" . 'Channels' . ":" .  $chipset['Channels']);

/*echo "Chipset <br><br>";
print_r($chipset);

echo "<br><br><br><br>";*/

//////////

$p = explode("Mainboard Model", $partes[11]);
$p = explode("(", $p[1]);

$Board['designacao'] = trim($p[0]);

/*echo "Board <br><br>";
print_r($Board);

echo "<br><br><br><br>";*/

//////////

$p = explode("DMI Baseboard", $partes[15]);
$p = explode("UUID", $p[0]);
$p = explode("SKU", $p[1]);



$DMI['serie'] = trim($p[0]);

/*echo "DMI <br><br>";
print_r($DMI);

echo "<br><br><br><br>";*/


//////////

$p = explode("Name", $partes[16]);
$p = explode("Revision", $p[1]);

$storage['marca'] = trim($p[0]);

$p = explode("Type", $partes[16]);
$p = explode("Bus", $p[1]);

$storage['designacao'] = trim($p[0]);
  
$p = explode("Capacity", $partes[16]);
$p = explode("Type", $p[1]);

$storage['Capacidade'] = trim($p[0]);

$storage['obs'] = trim('Capacidade' . ":" . $storage['Capacidade']);


/*echo "Storage <br><br>";
print_r($storage);

echo "<br><br><br><br>";*/

//////////

//print_r($partes[20]);

$p = explode("Name", $partes[20]);
$p = explode("Board Manufacturer", $p[1]);

$display['marca'] = trim($p[0]);


$p = explode(" nm", $partes[20]);
$p = explode("Cores", $p[0]);
$p = explode("Technology", $p[1]);

$display['Tecnologia'] = trim($p[1] . " nm");

//if (strpos($partes[20], "Memory type")) {
  
  

$p = explode("Memory type", $partes[20]);
  
  $p = explode("Memory", $p[1]);

$display['designacao'] = trim($p[0]);
  //}

$p = explode("Monitor 0", $partes[20]);
$p = explode("ID", $p[1]);

$display['Monitor'] = trim($p[0]);

$display['obs'] = trim('Tecnologia' . ":" . $display['Tecnologia'] . "|" . 'Monitor' . ":" .  $display['Monitor']);


/*echo "Display Adapters <br><br>";
print_r($display);

echo "<br><br><br><br>";*/

//////////

$p = explode("Windows Version", $partes[21]);
$p = explode("DirectX Version", $p[1]);

$software['marca'] = trim($p[0]);

$p = explode("DirectX Version", $partes[21]);
$p = explode("Register Spaces", $p[1]);

$software['designacao'] = trim($p[0]);

/*echo "Software <br><br><pre> ";
print_r($software);*/



 
try{
    $DB->autocommit(FALSE);
    
    $stmt = $DB->prepare("SELECT numeroProduto FROM produto WHERE serie=?");
    $stmt->bind_param('s', $DMI["serie"]);
    $stmt->bind_result($numeroProduto);
    $stmt->execute();
  
    if ($stmt->fetch() ) { // Este produto já existe
      $produtoNovo = false;
      $stmt->free_result();
      
      //Processador
      $stmt = $DB->prepare("SELECT designacao,marca,obs,codTipoProduto FROM produto WHERE composto=?");
      $stmt->bind_param('d',$numeroProduto);
      $stmt->bind_result($designacao,$marca,$obs,$codTipoProduto);
      $stmt->execute();
      
      $dados= array();
      
      while ($stmt->fetch()) {
        $dados[$codTipoProduto] = [$designacao,$marca,$obs];
      }
      $stmt->free_result();
      
      //print_r($dados);
      
    } else { // Produto novo
      $produtoNovo = true;
      
      
      

      
            $stmt = $DB->prepare("INSERT INTO produto (designacao,marca,composto,codTipoProduto,numeroSala,escola,serie,obs) 
                  VALUES (?,?,0,?,?,?,?,?)");
    $stmt->bind_param('sssssss',$_POST["designacao"],$_POST["marca"],$_POST["codTipoProduto"],$_POST["salas"],$_POST['escolas'],$DMI["serie"],$_POST["obs"]);
    $stmt->execute();
    $id_composicao = $stmt->insert_id;
      
       /*$tempDir = 'qrcodes/';
      
      $codeContents = 'http://stock.alunos.esmonserrate.org/template/dashboard/phpcodes/equipamentos.php?numeroProduto='.$id_composicao.'&serie='.$DMI["serie"].'&info=';
        // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = 'gestaoequipamentos'.md5($codeContents).'.png';
      $fileName = $DMI["serie"].'.png';
    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;
    $urlQrCode = 'http://stock.alunos.esmonserrate.org/template/dashboard/phpcodes/'.$urlRelativeFilePath;
     $texto = str_replace("{", "", $DMI["serie"]); 
      $textoo = str_replace("}", "", $texto);
      echo $urlQrCode;
      QRcode::png($textoo, $urlRelativeFilePath, 'L', 4, 2);    */
      
            
            $tempDir = 'qrcodes/';
    
      $codeContents = 'http://stock.alunos.esmonserrate.org/template/dashboard/phpcodes/equipamentos.php?numeroProduto='.$id_composicao.'&serie='.$DMI["serie"].'&info=';
    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = '005_file_'.md5($codeContents).'.png';
    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;
    $urlQrCode = 'http://stock.alunos.esmonserrate.org/template/dashboard/phpcodes/'.$urlRelativeFilePath;

        // generating
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);
    } else {
        echo 'Erro';
    }
      
      
            $stmt = $DB->prepare("UPDATE `produto` SET qrCode=? WHERE numeroProduto=?");
        $stmt->bind_param('ss',$urlQrCode, $id_composicao);
        $stmt->execute();
      
     
      //Processador
    $stmt = $DB->prepare("INSERT INTO produto (designacao,marca,composto,codTipoProduto,numeroSala,obs) 
                          VALUES (?,?,?,6,?,?)");
    $stmt->bind_param('ssdss',$processador['designacao'], $processador['marca'], $id_composicao, $_POST["salas"],$processador['obs']);
    $stmt->execute();
  
    //BIOS
    $stmt = $DB->prepare("INSERT INTO produto (marca,composto,codTipoProduto,numeroSala)
                          VALUES (?,?,7,?)");
    $stmt->bind_param('sds',$bios['marca'], $id_composicao, $_POST["salas"]);
    $stmt->execute();
  
  


    //RAM
    $stmt = $DB->prepare("INSERT INTO produto (designacao,marca,composto,codTipoProduto,numeroSala,obs) 
                          VALUES (?,?,?,11,?,?)");
    $stmt->bind_param('ssdss',$chipset['designacao'], $chipset['marca'],$id_composicao,$_POST["salas"],$chipset['obs']);
    $stmt->execute();
  
  //MotherBoard
    $stmt = $DB->prepare("INSERT INTO produto (designacao,composto,codTipoProduto,numeroSala) 
                          VALUES (?,?,5,?)");
    $stmt->bind_param('sds',$Board['designacao'],$id_composicao,$_POST["salas"]);
    $stmt->execute();
  
      //Storage
    $stmt = $DB->prepare("INSERT INTO produto (designacao,marca,composto,codTipoProduto,numeroSala,obs) 
                          VALUES (?,?,?,8,?,?)");
    $stmt->bind_param('ssdss',$storage['designacao'], $storage['marca'],$id_composicao,$_POST["salas"], $storage['obs']);
    $stmt->execute();
  
      //display
    $stmt = $DB->prepare("INSERT INTO produto (designacao,marca,composto,codTipoProduto,numeroSala,obs) 
                          VALUES (?,?,?,9,?,?)");
    $stmt->bind_param('ssdss',$display['designacao'], $display['marca'],$id_composicao,$_POST["salas"], $display['obs']);
    $stmt->execute(); 
  
  
        //software
    $stmt = $DB->prepare("INSERT INTO produto (designacao,marca,composto,codTipoProduto,numeroSala,obs) 
                          VALUES (?,?,?,10,?,?)");
    $stmt->bind_param('ssdss',$software['designacao'], $software['marca'],$id_composicao, $_POST["salas"], $software["obs"]);
    $stmt->execute();
      
      $logAddComposto = 'Foi adicionado um computador na sala '.$_POST['salas'].' por '.$_SESSION['nome'].'.';
      
      
        //atividade utilizador Adicionar Equipamento
    $stmt = $DB->prepare("INSERT INTO log (idUtilizador, foto,nome, tipo,descricao) VALUES (?,?,?,'Adicionou um Computador',?)");
          $stmt->bind_param('ssss',$_SESSION['idUser'], $_SESSION['foto'], $_SESSION['nome'], $logAddComposto);
    $stmt->execute();
      
      $_SESSION['adicionarComputador'] = 'teste1';
        header("Location: http://stock.alunos.esmonserrate.org/public/equipamentos/adicionar");
      
    }
    $DB->autocommit(TRUE);
}
  catch(Exception $e){
    echo "Erro ao gravar", $e;
  }
}
?>

  <!DOCTYPE html>
  <html>

  <head>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/verificalogin.php';?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/header.php';?>

    <style>
      * {
        box-sizing: border-box;
      }

      .row {
        margin-left: -5px;
        margin-right: -5px;
      }

      .column {
        float: left;
        width: 50%;
        padding: 5px;
      }

      table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
      }

      th,
      td {
        text-align: left;
        padding: 16px;
      }

      tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      /* Responsive layout - makes the two columns stack on top of each other instead of next to each other on screens that are smaller than 600 px */

      @media screen and (max-width: 600px) {
        .column {
          width: 100%;
        }
      }
    </style>
  </head>

  <body onload="">

    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Comparar Componentes</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <pre><?php //print_r($dados); echo empty($dados[7][0]);?></pre>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card border-0">
            <div class="map-canvas" style="height:100%;">
              <div class="column">
                <form action="http://stock.alunos.esmonserrate.org/template/dashboard/phpcodes/editarComponentes.php" method="post">
                  <div class="form-group">
                    <h4 class=""><b>Novo Ficheiro</b></h4>
                    <table>
                      <tr>
                        <th>Tipo de Produto</th>
                        <th>Marca</th>
                        <th>Designação</th>
                        <th>Observações</th>
                      </tr>
                      <tr>
                        <td>Processador</td>
                        <input type="hidden" name="numero_Produto" id="numero_Produto" value="<?php echo $numeroProduto?>">

                        <input type="hidden" name="processador_Marca" id="processador_Marca" value="<?php echo $processador['marca'] ?>">
                        <input type="hidden" name="processador_Designacao" id="processador_Designacao" value="<?php echo $processador['designacao'] ?>">
                        <input type="hidden" name="processador_Obs" id="processador_Obs" value="<?php echo $processador['obs'] ?>">


                        <input type="hidden" name="bios_Marca" id="bios_Marca" value="<?php echo $bios['marca'] ?>">
                        <input type="hidden" name="bios_Designacao" id="bios_Designacao" value="<?php echo $bios['designacao'] ?>">
                        <input type="hidden" name="bios_Obs" id="bios_Obs" value="<?php echo $bios['obs'] ?>">

                        <input type="hidden" name="chipset_Marca" id="chipset_Marca" value="<?php echo $chipset['marca'] ?>">
                        <input type="hidden" name="chipset_Designacao" id="chipset_Designacao" value="<?php echo $chipset['designacao'] ?>">
                        <input type="hidden" name="chipset_Obs" id="chipset_Obs" value="<?php echo $chipset['obs'] ?>">

                        <input type="hidden" name="board_Marca" id="board_Marca" value="<?php echo $Board['marca'] ?>">
                        <input type="hidden" name="board_Designacao" id="board_Designacao" value="<?php echo $Board['designacao'] ?>">
                        <input type="hidden" name="board_Obs" id="board_Obs" value="<?php echo $Board['obs'] ?>">

                        <input type="hidden" name="storage_Marca" id="storage_Marca" value="<?php echo $storage['marca'] ?>">
                        <input type="hidden" name="storage_Designacao" id="storage_Designacao" value="<?php echo $storage['designacao'] ?>">
                        <input type="hidden" name="storage_Obs" id="storage_Obs" value="<?php echo $storage['obs'] ?>">

                        <input type="hidden" name="display_Marca" id="display_Marca" value="<?php echo $display['marca'] ?>">
                        <input type="hidden" name="display_Designacao" id="display_Designacao" value="<?php echo $display['designacao'] ?>">
                        <input type="hidden" name="display_Obs" id="display_Obs" value="<?php echo $display['obs'] ?>">

                        <input type="hidden" name="software_Marca" id="software_Marca" value="<?php echo $software['marca'] ?>">
                        <input type="hidden" name="software_Designacao" id="software_Designacao" value="<?php echo $software['designacao'] ?>">
                        <input type="hidden" name="software_Obs" id="software_Obs" value="<?php echo $software['marca'] ?>">
                        <td <?php if($processador['marca']== $dados[6][1]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $processador['marca']; ?>
                        </td>
                        <td <?php if($processador['designacao']== $dados[6][0]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $processador['designacao']; ?>
                        </td>
                        <td <?php if($processador['obs']== $dados[6][2]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $processador['obs']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td>BIOS</td>
                        <td <?php if($bios['marca']== $dados[7][1]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $bios['marca']; ?>
                        </td>
                        <td <?php if(!empty($dados[7][0]) && !empty($bios['designacao']) && $bios['designacao']!= $dados[7][0]){ echo "style=' color: red;'"; } ?>>
                          <?php echo (empty($bios['designacao'])?"": $bios['designacao']); ?>
                        </td>
                        <td <?php if(!empty($dados[7][2]) && !empty($bios['obs']) && $bios['obs']!= $dados[7][2]){  echo "style=' color: red;'"; } ?>>
                          <?php echo (empty($bios['obs'])? "": $bios['obs']); ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Chipset</td>
                        <td <?php if(!empty($dados[11][1]) && !empty($chipset['marca']) && $chipset['marca']!= $dados[11][1]){ echo "style=' color: red;'"; } ?>>
                          <?php echo (empty($chipset['marca'])? "": $chipset['marca']); ?>
                        </td>
                        <td <?php if($chipset['designacao']== $dados[11][0]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $chipset['designacao']; ?>
                        </td>
                        <td <?php if($chipset['obs']== $dados[11][2]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $chipset['obs']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td>MotherBoard</td>
                        <td <?php if(!empty($Board[5][1]) && !empty($Board['marca'] && $Board['marca']) != $dados[5][1]){ echo "style=' color: red;'"; } ?>>
                          <?php echo (empty($Board['marca'])? "": $Board['marca']); ?>
                        </td>
                        <td <?php if($Board['designacao']== $dados[5][0]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $Board['designacao']; ?>
                        </td>
                        <td <?php if(!empty($Board[5][2]) && !empty($Board['obs'] && $Board['obs']) != $dados[5][2]){ echo "style=' color: red;'"; } ?>>
                          <?php echo (empty($Board['obs'])? "": $Board['marca']); ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Storage</td>
                        <td <?php if($storage['marca']== $dados[8][1]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $storage['marca']; ?>
                        </td>
                        <td <?php if($storage['designacao']== $dados[8][0]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $storage['designacao']; ?>
                        </td>
                        <td <?php if($storage['obs']== $dados[8][2]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $storage['obs']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Display Adapters</td>
                        <td <?php if($display['marca']== $dados[9][1]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $display['marca']; ?>
                        </td>
                        <td <?php if($display['designacao']== $dados[9][0]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $display['designacao']; ?>
                        </td>
                        <td <?php if($display['obs']== $dados[9][2]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $display['obs']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Software</td>
                        <td <?php if($software['marca']== $dados[10][1]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $software['marca']; ?>
                        </td>
                        <td <?php if($software['designacao']== $dados[10][0]){ } else { echo "style=' color: red;'"; } ?>>
                          <?php echo $software['designacao']; ?>
                        </td>
                        <td <?php if(!empty($software[10][2]) && !empty($software['obs'] && $software['obs']) != $dados[10][2]){ echo "style=' color: red;'"; } ?>>
                          <?php echo (empty($software['obs'])? "": $software['obs']); ?>
                        </td>
                      </tr>
                    </table>
                  </div>
              </div>
              <div class="column">
                <div class="form-group">
                  <h4 class=""><b>Ficheiro Existente</b></h4>
                  <table>
                    <tr>
                      <th>Tipo de Produto</th>
                      <th>Marca</th>
                      <th>Designação</th>
                      <th>Observações</th>
                    </tr>
                    <tr>
                      <td>Processador</td>
                      <td <?php if($processador['marca']== $dados[6][1]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[6][1]?>
                      </td>
                      <td <?php if($processador['designacao']== $dados[6][0]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[6][0]?>
                      </td>
                      <td <?php if($processador['obs']== $dados[6][2]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[6][2]?>
                      </td>
                    </tr>
                    <tr>
                      <td>BIOS</td>
                      <td <?php if($bios['marca']== $dados[7][1]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[7][1]?>
                      </td>
                      <td <?php if($bios['designacao']== $dados[7][0]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[7][0]?>
                      </td>
                      <td <?php if($bios['obs']== $dados[7][2]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[7][2]?>
                      </td>
                    </tr>
                    <tr>
                      <td>Chipset</td>
                      <td <?php if($chipset['marca']== $dados[11][1]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[11][1]?>
                      </td>
                      <td <?php if($chipset['designacao']== $dados[11][0]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[11][0]?>
                      </td>
                      <td <?php if($chipset['obs']== $dados[11][2]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[11][2]?>
                      </td>
                    </tr>
                    <tr>
                      <td>Motherboard</td>
                      <td <?php if($Board['marca']== $dados[5][1]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[5][1]?>
                      </td>
                      <td <?php if($Board['designacao']== $dados[5][0]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[5][0]?>
                      </td>
                      <td <?php if($Board['obs']== $dados[5][2]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[5][2]?>
                      </td>
                    </tr>
                    <tr>
                      <td>Storage</td>
                      <td <?php if($storage['marca']== $dados[8][1]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[8][1]?>
                      </td>
                      <td <?php if($storage['designacao']== $dados[8][0]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[8][0]?>
                      </td>
                      <td <?php if($storage['obs']== $dados[8][2]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[8][2]?>
                      </td>
                    </tr>
                    <tr>
                      <td>Display Adapters</td>
                      <td <?php if($display['marca']== $dados[9][1]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[9][1]?>
                      </td>
                      <td <?php if($display['designacao']== $dados[9][0]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[9][0]?>
                      </td>
                      <td <?php if($display['obs']== $dados[9][2]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[9][2]?>
                      </td>
                    </tr>
                    <tr>
                      <td>Software</td>
                      <td <?php if($software['marca']== $dados[10][1]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[10][1]?>
                      </td>
                      <td <?php if($software['designacao']== $dados[10][0]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[10][0]?>
                      </td>
                      <td <?php if($software['obs']== $dados[10][2]){ } else { echo "style=' color: red;'"; } ?>>
                        <?=$dados[10][2]?>
                      </td>
                    </tr>
                </div>
              </div>
              </table>
              <div class="row">
                <div class="col-sm">
                </div>
                <div class="col-1">
                </div>
                <button type="submit" id="submit" name="submit" class="btn btn-primary" style="margin-top: 2%;">Atualizar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/footer.php';?>
    </div>
    </div>
  </body>