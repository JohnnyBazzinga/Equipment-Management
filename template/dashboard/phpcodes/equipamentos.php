<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/BDi.php';

if(isset($_POST["submitNaoComposto"])){ // Atualizar Informações de Equipamentos Não Compostos
  
    $numeroProduto = $_POST['numeroProdutoNaoComposto'];
    $designacao = $_POST['designacaoNaoComposto'];
    $numeroSala = $_POST['salaNaoComposto'];
  
  
      $stmt = $DB->prepare("UPDATE `produto` SET `designacao`=?, numeroSala=? WHERE `numeroProduto`=?");
      $stmt->bind_param('sss', $designacao, $numeroSala, $numeroProduto);
        $stmt->execute();
}

if(isset($_POST["submitComposto"])){ // Atualizar Informações de Equipamentos Não Compostos
  
    $numeroProduto = $_POST['numeroProdutoComposto'];
    $designacao = $_POST['designacaoComposto'];
    $numeroSala = $_POST['salaComposto'];
  
  
      $stmt = $DB->prepare("UPDATE `produto` SET `designacao`=?, numeroSala=? WHERE `numeroProduto`=?");
      $stmt->bind_param('sss', $designacao, $numeroSala, $numeroProduto);
        $stmt->execute();
}
?>

  <?php
  
  if($_SESSION["nivel"] == '2') {
?>
    <!DOCTYPE html>
    <html>

    <head>
      <?php require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/header.php';?>

      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
    </head>
  <style>
    .tabela {
      overflow-x: scroll;
    }

  </style>
    <body>

      <?php require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/sidebar.php';?>
      <div class="header bg-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Detalhes do Equipamento</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page content -->
      <div class="container-fluid mt--6">
        <div class="row">
          <div class="col-xl-12">
            <div class="card tabela">
              <div class="card-header border-0">
                <div class="row align-items-center">
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#detalhesEquipamento" data-toggle="tab">
                    <i class="material-icons">settings</i> Detalhes do Equipamento
                    <div class="ripple-container"></div>
                  </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#historicoAvarias" data-toggle="tab">
                    <i class="material-icons">build</i> Histórico de Avarias
                    <div class="ripple-container"></div>
                  </a>
                    </li>
                  </ul>
                </div>
              </div>
              <!--------------------- Tarefas por fazer ----------------------->
              <div class="card-body tarefas">
                
                <div class="tab-content">
                  <div class="tab-pane active" id="detalhesEquipamento">
                  <div class="row align-items-center" style="margin-left: 92%; margin-top: -3%; margin-bottom: -6%; margin-right: 0%;">
                  <h4 class=""><b>Código QR Code</b></h4>
                    <a href="<?php //Codigo Qr code
                          $stmt = $DB->prepare("SELECT qrCode FROM produto WHERE serie=?");
                          $stmt->bind_param("s", $_GET['serie']);

                          $stmt->execute(); 

                          $stmt->bind_result($qrCode);
                          while ($stmt->fetch())
                            
                           echo $qrCode;
                          $stmt->free_result();?>" download>
                    <img src="<?php echo $qrCode ?>" class="img-fluid" width="100%" height="20%">
                    </a>
                  </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">

                            <?php
                            $stmt = $DB->prepare("SELECT tipoProduto.tipo, `numeroProduto`, `designacao`, `marca`, `composto`, 
                                                              produto.`codTipoProduto`, `numeroSala`, `serie`, `obs`, data FROM `produto` 
                                                              INNER JOIN tipoProduto ON produto.codTipoProduto = tipoProduto.codTipoProduto 
                                                              WHERE serie=?");
                          $stmt->bind_param("s", $_GET['serie']);

                          $stmt->execute(); 

                          $stmt->bind_result($tipoProduto, $numeroProduto, $designacao, $marca, $composto, 
                                            $codTipoProduto, $numeroSala, $serie, $obs,$data);
                          while ($stmt->fetch())
 
                            echo "
                            <h4 class=''><b>Designação</b></h4>
                            <input class='form-control' id='numeroProdutoComposto' name='numeroProdutoComposto' type='hidden' value='' placeholder=''>
                            <input class='form-control text-center' type='text' id='designacaoComposto' name='designacaoComposto' value='$designacao' readonly=''>
                        </div>
                      </div>
                      <div class='col-md-3'>
                        <div class='form-group'>
                          <h4 class=''><b>Nº Série</b></h4>
                          <input class='form-control text-center' type='text' id='serieComposto' name='serieComposto' value='$serie' readonly=''>
                        </div>
                      </div>
                      <div class='col-md-2'>
                        <div class='form-group'>
                          <h4 class=''><b>Sala</b></h4>
                          <input class='form-control text-center' type='text' id='numeroSala' name='numeroSala' value='$numeroSala' readonly=''>
                        </div>
                      </div>
                      <div class='col-md-3'>
                        <div class='form-group'>
                          <h4 class=''><b>Data de registo</b></h4>
                          <input class='form-control text-center' id='dataComposto' name='dataComposto' type='' value='$data' placeholder='' readonly=''>
                        </div>
                      </div>";
                          $stmt->free_result();
                          ?>
                    </div>
                  <div class="form-group">
                    <h4 class=""><b>Componentes</b></h4>
                      </div>
                    <table class="table table-bordered table-hover small w-100" id="tblComponentes">
                      <thead class="thead-light">
                        <tr>
                          <th>Tipo de Produto</th>
                          <th>Marca</th>
                          <th>Designacao</th>
                          <th>Observações</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $stmt = $DB->prepare("SELECT tipoProduto.tipo, `numeroProduto`, `designacao`, `marca`, `composto`, 
                                                              produto.`codTipoProduto`, `numeroSala`, `serie`, `obs` FROM `produto` 
                                                              INNER JOIN tipoProduto ON produto.codTipoProduto = tipoProduto.codTipoProduto 
                                                              WHERE composto=?");
                          $stmt->bind_param("s", $_GET['numeroProduto']);

                          $stmt->execute(); 

                          $stmt->bind_result($tipoProduto, $numeroProduto, $designacao, $marca, $composto, 
                                            $codTipoProduto, $numeroSala, $serie, $obs);
                          while ($stmt->fetch())
                           echo "<tr data-id='$numeroProduto'>
                              <td>$tipoProduto</td>
                              <td title='$marca'>",$marca,"</td>
                              <td title='$designacao'>",substr($designacao,0,40),"</td>
                              <td title='$obs'>",substr($obs,0,40),"</td>
                              </tr>
                              ";
                          $stmt->free_result();

                          ?>
                      </tbody>

                    </table>
                    <div class="form-group">
                    </div>
                    <h4 class=""><b>Ficheiro CPU-Z</b></h4>
                      <input type="file" name="ficheiroComponentes" id="ficheiroComponentes" class="input-file" accept=".txt">
                      <div class="popup" onclick="myFunction()"><i class="fas fa-question-circle"></i>
                        <span class="popuptext" id="myPopup">Selecione um ficheiro do CPU-Z</span>
                      </div>
                    <div class="form-group">
                    </div>
                            <?php
                            $stmt = $DB->prepare("SELECT tipoProduto.tipo, `numeroProduto`, `designacao`, `marca`, `composto`, 
                                                              produto.`codTipoProduto`, `numeroSala`, `serie`, `obs`, data FROM `produto` 
                                                              INNER JOIN tipoProduto ON produto.codTipoProduto = tipoProduto.codTipoProduto 
                                                              WHERE serie=?");
                          $stmt->bind_param("s", $_GET['serie']);

                          $stmt->execute(); 

                          $stmt->bind_result($tipoProduto, $numeroProduto, $designacao, $marca, $composto, 
                                            $codTipoProduto, $numeroSala, $serie, $obs,$data);
                          while ($stmt->fetch())
 
                            echo "
                            <form action='/template/dashboard/listarEquipamentos.php' method='POST'>
                            <input type='hidden' name='sala' id='sala' value='$numeroSala'> 
                            <input type='hidden' name='codTipoProduto' id='codTipoProduto' value='$codTipoProduto'>
                            <button type='submit' name='submitEquipamentos' id='submitEquipamentos' class='btn btn-primary' style='margin-top: 0px;' >Voltar</button>
                            ";
                          $stmt->free_result();
                          ?>
                                              <button class='btn btn-primary'>Enviar ficheiro</button>
                        </form>
                  </div>
                  <!--------------------- Tarefas em Progresso ----------------------->
                  <div class="tab-pane" id="historicoAvarias">
                  <table id="avarias" class="table table-striped table-bordered w-100">
            <thead>
              <tr>
                <th>Data da Avaria</th>
                <th>Designação</th>
                <th>Sala</th>
                <th style="display:none">Nome</th>
                <th style="display:none">Email</th>
                <th style="display:none">Problema</th>
                <th style="display:none">dataRegistoAvaria</th>
                <th style="display:none">idUserReparacao</th>
                <th style="display:none">EmailTecnico</th>
                <th style="display:none">reparacao</th>
                <th style="display:none">dataReparacao</th>
                <th>Estado</th>
                <th>Reparado por</th>
                <th>Ações</th>
              </tr>
            </thead>
                      <tbody>
                        <?php
                   $stmt = $DB->prepare("SELECT numero,dataRegistoAvaria, numeroProduto,designacao,numeroSala,nome,emailRegisto,problema,estadoReparacao, dataRegistoAvaria, 
                                          idUserReparacao, emailTecnico, reparacao, dataReparacao FROM `reparacoes` WHERE numeroProduto=? ORDER BY estadoReparacao ASC");
  
                   $stmt->bind_param("s", $_POST['numeroProduto']);
  
                   $stmt->execute(); 

                   $stmt->bind_result($numero,$dataRegistoAvaria, $numeroProduto, $designacao, $numeroSala, $nome, $email,$problema, $estadoReparacao, $dataRegistoAvaria, $idUserReparacao, $emailTecnico, $reparacao, $dataReparacao);
                   while ($stmt->fetch())

                     if ($estadoReparacao == 0) { // Equipamento por ser reparado
                     echo "
                        <tr data-id='$numero'>
                          <td>$dataRegistoAvaria</td>
                          <td>$designacao</td>
                          <td>$numeroSala</td>
                          <td style='display:none;'>$nome</td>
                          <td style='display:none;'>$email</td>
                          <td style='display:none;'>$problema</td>
                          <td style='display:none;'>$dataRegistoAvaria</td>
                          <td style='display:none;'>$dataReparacao</td>
                          <td style='display:none;'>$idUserReparacao</td>
                          <td style='display:none;'>$emailTecnico</td>
                          <td style='display:none;'>$reparacao</td>
                          <td>Equipamento por ser Reparado</td>
                          <td>$emailTecnico</td>
                          <td style='width:200px; text-align: center;'>
                          <button style='margin-top: 0px;' type='button' class='btn btn-primary info'><i class='far fa-eye'></i></button>
                          <button style='margin-top: 0px;' type='button' class='btn btn-success reparacao'><i class='fas fa-wrench'></i></button>
                          </td>
                        </tr>";
                     } else if ($estadoReparacao == 1) { // Equipamento reparado com sucesso
                     echo "
                          <tr data-id='$numero'>    
                          <td>$dataRegistoAvaria</td>
                          <td>$designacao</td>
                          <td>$numeroSala</td>
                          <td style='display:none;'>$nome</td>
                          <td style='display:none;'>$email</td>
                          <td style='display:none;'>$problema</td>
                          <td style='display:none;'>$dataReparacao</td>
                          <td style='display:none;'>$dataRegistoAvaria</td>
                          <td style='display:none;'>$idUserReparacao</td>
                          <td style='display:none;'>$emailTecnico</td>
                          <td style='display:none;'>$reparacao</td>
                          <td style='color:blue'>Equipamento reparado com sucesso</td>
                          <td>$emailTecnico</td>
                          <td style='width:200px; text-align: center;'>
                          <button style='margin-top: 0px;' type='button' class='btn btn-primary info'><i class='far fa-eye'></i></button>
                          <button style='margin-top: 0px;' type='button' class='btn btn-primary infoReparacao'><i class='fas fa-wrench'></i></button>
                          </td>
                        </tr>";
                     } else if ($estadoReparacao == 2) { // Equipamento reparado sem sucesso
                     echo "
                          <tr data-id='$numero'>    
                          <td>$dataRegistoAvaria</td>
                          <td>$designacao</td>
                          <td>$numeroSala</td>
                          <td style='display:none;'>$nome</td>
                          <td style='display:none;'>$email</td>
                          <td style='display:none;'>$problema</td>
                          <td style='display:none;'>$dataReparacao</td>
                          <td style='display:none;'>$dataRegistoAvaria</td>
                          <td style='display:none;'>$idUserReparacao</td>
                          <td style='display:none;'>$emailTecnico</td>
                          <td style='display:none;'>$reparacao</td>
                          <td style='color:red'>Equipamento reparado sem sucesso</td>
                          <td>$emailTecnico</td>
                          <td style='width:200px; text-align: center;'>
                          <button style='margin-top: 0px;' type='button' class='btn btn-primary info'><i class='far fa-eye'></i></button>
                          <button style='margin-top: 0px;' type='button' class='btn btn-primary infoReparacao'><i class='fas fa-wrench'></i></button>
                          </td>
                        </tr>";
                     }
                   $stmt->free_result();
                    ?>

                      </tbody>
                    </table>
                    <div class="form-group">
                    </div>
                    <button onclick="goBack()" class='btn btn-primary'>Voltar</button>
                    <button class='btn btn-primary avaria'>Registar Avaria</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!---------------------------- Footer ----------------------------------->
        <?php include $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/footer.php';?>
      </div>


      <!-- ---------------------------------------Modais----------------------------------------------------------- -->


      <!---  Modal visualizar Avaria --->
      <div class="modal fade" id="mdlVisualizarAvaria" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">

          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Informações da Avaria</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <h4 class=""><b>Data</b></h4>
                <input class="form-control " id="dataAvaria" name="dataAvaria" type="" placeholder="" readonly="">
              </div>
              <div class="form-group">
                <h4 class=""><b>Sala</b></h4>
                <input class="form-control" type="text" id="salaAvaria" name="salaAvaria" value="" readonly="">
              </div>
              <div class="form-group">
                <h4 class=""><b>Nome do Professor</b></h4>
                <input class="form-control" type="text" id="nomeProf" name="nomeProf" value="" readonly="">
              </div>
              <div class="form-group">
                <h4 class=""><b>Email do Professor</b></h4>
                <input class="form-control" type="text" id="emailProf" name="emailProf" value="" readonly="">
              </div>
              <div class="form-group">
                <h4 class=""><b>Descrição do problema</b></h4>
                <textarea style="resize: none;" name="problema" class="form-control" id="problema" required="" placeholder="Descreva o problema" rows="5" readonly=""></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!---  Modal Registar reparacao --->
      <div class="modal fade" id="mdlRegistarReparacao" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">

          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Adicionar uma reparação</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <form action="/template/dashboard/phpcodes/avarias.php" method="post" enctype="multipart/form-data">
                <input class="form-control text-center" type="hidden" id="numeroRegistarReparacao" name="numeroRegistarReparacao" value="" readonly="">
                <div class="form-group">
                  <h4 class=""><b>Diagnóstico da Reparação</b></h4>
                  <textarea style="resize: none;" name="diagnosticoReparacao" class="form-control" id="diagnosticoReparacao" required="" rows="5"></textarea>
                </div>
                <div class="form-group">
                  <h4 class=""><b>Estado da Reparação </b></h4>
                  <select name="estado" id="estado" class="custom-select sources" placeholder="My Categories" required>
                  <option value=''>Selecione o Estado</option>
                    <option value='1'>Reparado com sucesso</option>
                    <option value='2'>Reparação falhada</option>
                   </select>
                </div>
            </div>
            <div class="modal-footer ">
              <button type="submitReparacao" name="submitReparacao" id="submitReparacao" type="button" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Registar Reparação</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <!---  Modal visualizar Reparações --->
      <div class="modal fade" id="mdlVisualizarReparacao" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">

          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Informações da Reparação</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <form action="/template/dashboard/phpcodes/avarias.php" method="post" enctype="multipart/form-data">
                <input class="form-control text-center" type="hidden" id="numero" name="numero" value="" readonly="">
                <div class="form-group">
                  <h4 class=""><b>Data</b></h4>
                  <input class="form-control " id="dataReparacao" name="dataReparacao" type="" placeholder="" readonly="">
                </div>
                <div class="form-group">
                  <h4 class=""><b>Sala</b></h4>
                  <input class="form-control" type="text" id="salaReparacao" name="salaReparacao" value="" readonly="">
                </div>
                <div class="form-group">
                  <h4 class=""><b>Nome do Técnico</b></h4>
                  <input class="form-control" type="text" id="nomeTecnico" name="nomeTecnico" value="" readonly="">
                </div>
                <div class="form-group">
                  <h4 class=""><b>Email do Técnico</b></h4>
                  <input class="form-control" type="text" id="emailTecnico" name="emailTecnico" value="" readonly="">
                </div>
                <div class="form-group">
                  <h4 class=""><b>Descrição do problema</b></h4>
                  <textarea style="resize: none;" name="reparacao" class="form-control" id="reparacao" required="" placeholder="Descreva o problema" rows="5"></textarea>
                </div>
            </div>
            <div class="modal-footer ">
              <button type="submitEditarReparacao" name="submitEditarReparacao" id="submitEditarReparacao" type="button" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Atualizar</button>
            </div>
            </form>
          </div>
        </div>
      </div>

        <style>
          
          .checkboxes ul, .checkboxes li {
    margin:0;
    padding:0;
    list-style:none;
}
.checkboxes li {
    display:inline-block;
    width:33.3333%;
}
        </style>
  <!-- ---Modal  Modal Registar Avarias ---- -->
  <div class="modal fade" id="mdlRegistarAvaria" tabindex="-1" data-backdrop="static">
    
    
        <div class="modal-dialog">

          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Adicionar Avaria</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <form action="/template/dashboard/phpcodes/avarias.php" method="post" enctype="multipart/form-data">
                
                  <h4 class=""><b>Problemas Comuns</b></h4>
                <div class="form-group">
                      <ul class="list-unstyled row">
                          <li class="col-md-6 col-xs-6"><label><input type="checkbox"/> Pc nao liga</label></li>
                          <li class="col-md-6 col-xs-6"><label><input type="checkbox"/> Falha no HDD</label></li>
                      </ul>
                                        <ul class="list-unstyled row">
                          <li class="col-md-6 col-xs-6"><label><input type="checkbox"/> Problema de Bips</label></li>
                          <li class="col-md-6 col-xs-6"><label><input type="checkbox"/> Problemas de Internet</label></li>
                      </ul>
                                        <ul class="list-unstyled row">
                          <li class="col-md-6 col-xs-6"><label><input type="checkbox"/> Portas USB nao reconhecidas</label></li>
                          <li class="col-md-6 col-xs-6"><label><input type="checkbox"/> Outras</label></li>
                      </ul>
                  </div>
                  <div class="form-group">
                  </div>
                <div class="form-group">
                  <h4 class=""><b>Descrição do problema</b></h4>
                  <textarea name="diagnostico" class="form-control cortextoform" id="diagnostico" required="" placeholder="Descreva o problema" rows="5"></textarea>
                </div>
            </div>
            <div class="modal-footer ">
              <button type="submit" name="submitAvaria" id="submitAvaria" type="button" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Adicionar</button>
            </div>
            </form>
          </div>
        </div>
  </div>


    </body>

    <!---------------------------- Scripts ------------------------------------>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/scripts.php';?>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript">
$(document).ready(function() {
    $('#submitComponentes').bind("click",function() 
    { 
        var imgVal = $('#ficheiroComponentes').val(); 
        if(imgVal=='') 
        { 
            alert("Selecione um ficheiro"); 
            return false; 
        } 


    }); 
});
</script>
        <script>
// When the user clicks on div, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>
    <script>
      function goBack() {
        window.history.back();
      }



      $(document).ready(function() {
        $('#avarias').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
          },
        });
      });

      $(".info").click(function() {
        var linha = $(this).closest("tr");
        $("#tipoProduto").val(linha.data("id"));

        $("#dataAvaria").val(linha.find("td").eq(0).html());
        $("#salaAvaria").val(linha.find("td").eq(2).html());
        $("#nomeProf").val(linha.find("td").eq(3).html());
        $("#emailProf").val(linha.find("td").eq(4).html());
        $("#problema").val(linha.find("td").eq(5).html());
        $("#mdlVisualizarAvaria").modal("show");
      });


      $(".infoReparacao").click(function() {
        var linha = $(this).closest("tr");
        $("#numero").val(linha.data("id"));
        $("#dataReparacao").val(linha.find("td").eq(6).html());
        $("#salaReparacao").val(linha.find("td").eq(2).html());
        $("#nomeTecnico").val(linha.find("td").eq(8).html());
        $("#emailTecnico").val(linha.find("td").eq(9).html());
        $("#reparacao").val(linha.find("td").eq(10).html());
        $("#mdlVisualizarReparacao").modal("show");
      });


      $(".reparacao").click(function() {
        var linha = $(this).closest("tr");
        $("#numeroRegistarReparacao").val(linha.data("id"));
        $("#n_Produto1").val(linha.find("td").eq(1).html());

        $("#mdlRegistarReparacao").modal("show");
      });
      
            $(".avaria").click(function() {
        var linha = $(this).closest("tr");
        $("#numeroRegistarReparacao").val(linha.data("id"));
        $("#n_Produto1").val(linha.find("td").eq(1).html());

        $("#mdlRegistarAvaria").modal("show");
      });

      /* $(".apagar").click(function() {
    var linha = $(this).closest("tr");
    $("#numeroApagar").val(linha.data("id"));

    $("#mdlApagarReparacao").modal("show");
  });*/

      $(document).ready(function() {
        $("#sala").change(function() {
          $("#NumeroProduto option[data-sala!='" + $(this).val() + "']").hide()
          $("#NumeroProduto option[data-sala='" + $(this).val() + "']").show()
        })
      })
    </script>

    </html>
    <?php 
} else {
    include $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/verificalogin.php';
    ?>
      
    <!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- UTF-8 -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Icon do separador -->
  <link href="../../template/dashboard/imagens/logo16x16.png" rel="icon" type="image/png">
  <title>Gestão de Equipamentos</title>
  <link rel="stylesheet" href="/template/registarAvarias/assets/style.css" type="text/css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <meta name="google-signin-client_id" content="543296497721-cosskaa6b096nc9clikp0hfljffdvjpj.apps.googleusercontent.com">
  </head>

<body>
  <div class="container">
         <img src="../../template/dashboard/imagens/logo.png" alt="logo" style="margin-left: 473px; margin-bottom: -39px; margin-top: 38px;">
      <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
    <div class="row main">
      <div class="main-login main-center">
        <div class="borderlargo" id="titulo_form">
          <h5>Registar Avarias <a class="h6 text-light" href="#" data-target="#ajudamodal" data-toggle="modal"><i class="fas fa-question-circle"></i></a></h5>
        </div>
        <form action="/template/dashboard/phpcodes/registarAvaria.php" method="post">
          <div class="form-group">
            <label class="cols-sm-2 control-label" for="name">Nome</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon corlabelform"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                <input name="nome" class="form-control cortextoform" id="nome" required="" value="<?php echo $_SESSION["nome"];?>" type="text" disabled readonly="" placeholder="Insira o seu Nome">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="cols-sm-2 control-label" for="name">Email</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon corlabelform"><i class="fa fa-at fa" aria-hidden="true"></i></span>
                <input name="email" class="form-control cortextoform" id="email" required="" type="email" value="<?php echo $_SESSION["email"];?>" disabled  readonly="" placeholder="Insira o seu Email">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label class="cols-sm-2 control-label" for="sala">Sala</label>
                <div class="input-group">
                  <span class="input-group-addon corlabelform"><i class="fas fa-door-open fa-lg" aria-hidden="true"></i></span>
                      <?php
                    require $_SERVER['DOCUMENT_ROOT']."/template/dashboard/includes/BDi.php";
                         $stmt = $DB->prepare("SELECT numeroSala FROM produto WHERE serie=?");
                        $stmt->bind_param("s", $_GET['serie']);
                         $stmt->execute(); 
                         $stmt->bind_result($numeroSala);
                         while ($stmt->fetch())
                            echo "<option class='form-control cortextoform' value='$numeroSala' disabled='' selected=''>$numeroSala</option>";
                         $stmt->free_result();
                        ?>
                </div>
              </div>
              <div class="col-xs-5 col-sm-6 col-lg-6">
                <label class="cols-sm-2 control-label" for="sala">Equipamento</label>
                <div class="input-group">
                  <span class="input-group-addon corlabelform"><i class="fas fa-desktop fa-lg" aria-hidden="true"></i></span>
                      <?php
                         $stmt = $DB->prepare("SELECT designacao FROM `produto` WHERE serie=?");
                          $stmt->bind_param("s", $_GET['serie']);
                         $stmt->execute(); 
                         $stmt->bind_result($designacao);
                         while ($stmt->fetch())
                            echo "
                            <option class='form-control cortextoform' value='$designacao' disabled='' selected=''>$designacao</option>";
                         $stmt->free_result();
                        ?>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="cols-sm-2 control-label" for="problema">Descrição do problema</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon corlabelform"><i class="fas fa-file-alt fa-lg" aria-hidden="true"></i></span>
                <textarea name="diagnostico" class="form-control cortextoform" id="diagnostico" required="" placeholder="Descreva o problema" rows="5"></textarea>

              </div>
            </div>
          </div>

          <div class="form-group ">
            <button onclick="myFunction()" class="btn btn-primary btn-lg btn-block login-button font-weight-bold" id="button" style="border-color: white; color: rgb(0, 110, 229);" type="submit" name="submit" id="submit">Enviar</button>
          </div>

        </form>
      </div>
    </div>
  </div>
  <div tabindex="-1" class="modal fade" id="ajudamodal" role="dialog" aria-hidden="true" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Precisa de Ajuda?</h3>


          <button class="close" aria-label="Close" type="button" data-dismiss="modal">
              <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <h6 class="text-left lead">1. <u>O que inserir.</u></h6>
          <p class="text-justify">Para preencher os campos do formulario pedimos que nos forneça <b class="text-primary">NOME</b> e <b class="text-primary">APELIDO</b>, o seu <b class="text-primary">EMAIL</b> de preferência aquele que mais utiliza, a <b class="text-primary">ESCOLA</b>            onde existe a avaria que vai reportar, a <b class="text-primary">SALA</b> da mesma, o <b class="text-primary">EQUIPAMENTO</b> que precisa de intervenção, e por fim uma descrição da <b class="text-primary">AVARIA</b>.</p>
          <h6 class="text-left lead">2. <u>Submeter avaria.</u></h6>
          <p class="text-justify">Para submeter uma avaria, depois de preencher os dados necessários, carregue em <b class="text-primary">ENVIAR</b> se tiver preenchido tudo corretamente irá aparecer uma pagina a dizer que enviou a avaria com sucesso.</p>
          <h6 class="text-left lead">3. <u>Quer submeter duas ou mais avarias.</u></h6>
          <p class="text-justify">Para submeter duas avarias, é seguir o ponto numero dois, e logo em seguido irá aparecer uma janela com um <b class="text-primary">BOTÃO</b> para inserir uma nova avaria, caso nao queira inserir a segunda avaria, é só fechar ou então será reencaminhada/o
            automáticamente para a página da <u><a href="http://esmonserrate.org" target="_blank">Escola Secundária de Monserrate.<a></a></u></p>
          <a>
            <h6 class="text-left lead">4. <u>O que acontece as avarias submetidas.</u></h6>
            <p class="text-justify">Todas as avarias submetidas com sucesso serão enviadas para a nossa plataforma, para podermos ver e ajudar o mais rápido possível.</p>
            <h6 class="text-left lead">5. <u>Como posso saber se uma avaria foi resolvida.</u></h6>
            <p class="text-justify">Depois de submeter a avaria irá receber um <b class="text-primary">EMAIL</b> automático, para o email que indicou no formulário. <br>Nesse email irá conter um <b class="text-primary">LINK</b> de acesso à avaria enviada, onde poderá ver o estado
              em que a mesma se encontra, e alguns comentários adicionados.</p>

            <p class="small text-center"><u>Se tem duvidas envie mensagem pelos contactos. Obrigado.</u></p>
          </a>
        </div>
        <a>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>

          </div>
        </a>
      </div><a>
      </a></div><a>
</a></div>
  <div tabindex="-1" class="modal fade" id="sobremodal" role="dialog" aria-hidden="true" aria-labelledby="exampleModalLabel"><a>
      </a>
    <div class="modal-dialog" role="document"><a>
        </a>
      <div class="modal-content">
        <a>
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Termos e Condições</h3>
            <button class="close" aria-label="Close" type="button" data-dismiss="modal">
              <span aria-hidden="true">×</span>
            </button>
          </div>
        </a>
        <div class="modal-body"><a>
                </a>
          <h4><a>Política de privacidade para <a href="http://avarias.esmonserrate.org">Avarias Esm</a></h4>
          <p>Todas as suas informações pessoais recolhidas, serão usadas para o ajudar a tornar a sua visita no nosso site o mais produtiva e agradável possível.</p>
          <p>A garantia da confidencialidade dos dados pessoais dos utilizadores do nosso site é importante para o Avarias Esm.</p>
          <p>Todas as informações pessoais relativas a membros, assinantes, clientes ou visitantes que usem o Avarias Esm serão tratadas em concordância com a Lei da Proteção de Dados Pessoais de 26 de outubro de 1998 (Lei n.º 67/98).</p>
          <p>A informação pessoal recolhida pode incluir o seu nome, e-mail, número de telefone e/ou telemóvel, morada, data de nascimento e/ou outros.</p>
          <p>O uso do Avarias Esm pressupõe a aceitação deste Acordo de privacidade. A equipa do Avarias Esm reserva-se ao direito de alterar este acordo sem aviso prévio. Deste modo, recomendamos que consulte a nossa política de privacidade com regularidade
            de forma a estar sempre atualizado.</p>
          <h4>Ligações a Sites de terceiros</h4>
          <p>O Avarias Esm possui ligações para outros sites, os quais, a nosso ver, podem conter informações / ferramentas úteis para os nossos visitantes. A nossa política de privacidade não é aplicada a sites de terceiros, pelo que, caso visite outro
            site a partir do nosso deverá ler a politica de privacidade do mesmo.</p>
          <p>Não nos responsabilizamos pela política de privacidade ou conteúdo presente nesses mesmos sites.</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>

        </div>
      </div>
    </div>
  </div>
    
  <div tabindex="-1" class="modal fade" id="contactosmodal" role="dialog" aria-hidden="true" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Contactos <i class="far fa-comment"></i></h3>
          <button class="close" aria-label="Close" type="button" data-dismiss="modal">
              <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <h5 class="text-center">Se tem duvidas, ou se encontrou algum tipo de erro, diga-nos.</h5>
          <div class="row m-1 p-1 teccards">
            <div class="col-md-12 mt-2">
              <i class="fas fa-file-alt"></i> Coloque a sua duvida
              <form id="formContacto" action="" method="post">
                <input name="duvidasnome" class="form-control mt-2 mb-1" id="duvidasnome" required="" type="text" placeholder="Nome">
                <input name="duvidasemail" class="form-control mb-1" id="duvidasemail" required="" type="email" placeholder="Email">
                <input name="duvidasassunto" class="form-control mb-1" id="duvidasassunto" required="" type="text" placeholder="Assunto">
                <textarea name="duvidasmensagem" class="w-100 form-control mb-2" id="duvidasmensagem" required="" placeholder="Coloque a sua duvida" rows="4" cols="30">Coloque a sua duvida</textarea>
                <button class="btn teccardbtn btn-block" type="submit"><i class="far fa-envelope"></i> <i class="fas fa-arrow-right"></i></button>
              </form>
            </div>
          </div>
          <div class="row m-1 mt-2 p-1 teccards ">
            <div class="col-md-6 mt-2 text-center">
              <p><i class="fas fa-user"></i> TESTE</p>
              <p class="small">TESTE</p>
              <p><i class="fas fa-phone"></i>TESTE</p>
            </div>
            <div class="col-md-6 mt-2 text-center">
              <p><i class="fas fa-user"></i>TESTE</p>
              <p class="small">TESTE</p>
              <p><i class="fas fa-phone"></i>TESTE</p>
            </div>
          </div>
          <p class="text-center mt-2"><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;tf=1&amp;to=TESTE@gmail.com" target="_blank">TESTE@gmail.com</a><br>Obrigado pelo seu contacto.</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- INDEX FOOTER -->
  <!-- INDEX FOOTER -->
  <div class="row ml-0 mr-0 p-2 border-top border-left border-right sticky-bottom indexfooter" style="margin-top: -72px;">
    
    <div class="col-12 col-md-2 p-1">
      <div class="dropup">
        <button class="btn btn-block btn-primary" type="button" data-toggle="dropdown">Mais <i class="fas fa-info-circle"></i>
		    </button>
        <ul class="dropdown-menu p-2 w-100">
          <li><a class="btn btn-block text-left mb-1 btninsidedropup" href="#" data-target="#ajudamodal" data-toggle="modal"><i class="fa fa-question-circle"></i> Ajuda</a></li>
          <li><a class="btn btn-block text-left mb-1 btninsidedropup" href="#" data-target="#contactosmodal" data-toggle="modal"><i class="fa fa-phone"></i> Contactos</a></li>
          <li><a class="btn btn-block text-left mb-1 btninsidedropup" href="http://stock.alunos.esmonserrate.org/public/equipamentos/inicio"><i class="fa fa-cogs"></i> Administração</a></li>
          <li><a class="btn btn-block text-left mb-1 btninsidedropup" onclick="signOut();"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
        </ul>
      </div>

    </div>
    <div class="col-12 col-md-8 text-center pt-2"><span>Copyright © 2021 <a href="#"></a>. Todos os direitos reservados.</span><br> <span class="small"><a class="text-muted" style="font-size: 10px;" href="#" data-target="#sobremodal" data-toggle="modal"> Termos e Condições</a></span></div>
    <div class="col-12 col-md-2 p-1 text-center">
      <a class="btn btn-primary" href="https://www.facebook.com/AgrupamentoEscolasMonserrate" target="_blank"><i class="fab fa-facebook"></i></a>
      <a class="btn btn-primary" href="http://moodle.esmonserrate.org" target="_blank"><i class="fa fa-graduation-cap"></i></a>
      <a class="btn btn-primary" href="http://www.esmonserrate.org" target="_blank"><i class="fa fa-school"></i></a>
    </div>
  </div>
    
  <!-- FIM INDEX FOOTER -->
  <!-- FIM INDEX FOOTER -->

  <!-- Script JQUERY-->
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <!-- Script POPPER-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <!-- Script BOOTSTRAP-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  <!-- Mensagem de Aviso -->  
  <script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function() {
      window.location = "http://stock.alunos.esmonserrate.org/admin/login/phpcodes/logout.php";
    });
  }

  function onLoad() {
    gapi.load('auth2', function() {
      gapi.auth2.init();
    });
  }
   $(document).ready(function() {
    $("#sala").change(function() {
      $("#NumeroProduto option[data-sala!='"+$(this).val()+"']").hide()
      $("#NumeroProduto option[data-sala='"+$(this).val()+"']").show()
    })  
   })
    
</script>
    
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

</html>
    <?php
  }
?>
     