<!DOCTYPE html>
<html>

<head>
  <?php include 'template/dashboard/includes/header.php';?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
  
  
  </head>

<body>
  <?php include 'template/admin/includes/sidebar.php';?>
  <!-- Header -->
  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
      </div>
    </div>
  </div>
    <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <h3 class="mb-0">Gerir Equipamentos</h3>
          </div>
          <!-- Light table -->
          <table id="equipamentos" class="table table-striped table-bordered" style="width:100%">
            <thead class="thead-light">
              <tr>
                <th style='display: none'>numeroProduto</th>
                <th>Equipamento</th>
                <th>Nº Série</th>
                <th>Designação</th>
                <th>Sala</th>
                <th style="display: none;">Data</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require 'template/dashboard/includes/BDi.php';
              /*if(isset($_POST['submit'])) {
                         $stmt = $DB->prepare("SELECT tipoProduto.tipo, `numeroProduto`, `designacao`, `marca`, `composto`, 
                                                              produto.`codTipoProduto`, `numeroSala`, `serie`, `obs`, data FROM `produto` 
                                                              INNER JOIN tipoProduto ON produto.codTipoProduto = tipoProduto.codTipoProduto 
                                                              WHERE composto=0");
                      }else{                         $stmt = $DB->prepare("SELECT tipoProduto.tipo, `numeroProduto`, `designacao`, `marca`, `composto`, 
                                                              produto.`codTipoProduto`, `numeroSala`, `serie`, `obs`, data FROM `produto` 
                                                              INNER JOIN tipoProduto ON produto.codTipoProduto = tipoProduto.codTipoProduto 
                                                              WHERE composto=0");}
                         $stmt->execute();
                        
                         $stmt->bind_result($tipoProduto, $numeroProduto, $designacao, $marca, $composto, 
                                            $codTipoProduto, $numeroSala, $serie, $obs, $data);
                         while ($stmt->fetch())
                           if ($codTipoProduto == 3) {
                            echo "<tr data-id='$numeroProduto'>
                              <th scope='row'>
                                <div class='media align-items-center '>
                                  <a href='#' class='avatar rounded-circle mr-3'>
                                    <div style='font-size: 0.5rem;'>
                                      <i class='fas fa-desktop fa-3x'></i>
                                    </div>
                                  </a>
                                  <div class='media-body'>
                                    <span class='name mb-0 text-sm'>$tipoProduto</span>
                                  </div>
                                </div>
                              </th>
                              <form action='/template/dashboard/phpcodes/equipamentos.php' method='get'>
                              <td style='display: none;'><input type='hidden' class='form-control' name='numeroProduto' id='numeroProduto' placeholder='Designacao' value='$numeroProduto'></td>
                              <td><input type='hidden' class='form-control' name='serie' id='serie' placeholder='' value='$serie'>$serie</td>
                              <td>$designacao</td>
                              <td>$numeroSala</td>
                              <td style='display: none'>$data</td>
                              <td style='width:200px; text-align: center;'>
                                <button type='submit' id='info' name='info' style='margin-top: 0px;' class='btn btn-primary'><i class='fas fa-edit'></i></button>
                                <button type='submit' id='delete' name='delete' style='margin-top: 0px;' class='btn btn-danger'><i class='fas fa-trash'></i></button>
                              </td>
                           </tr>
                         </form>
                            "; 
                           } else if ($codTipoProduto == 2) {
                             echo "<tr data-id='$numeroProduto'>
                                      <th scope='row'>
                              <div class='media align-items-center '>
                                <a href='#' class='avatar rounded-circle mr-3'>
                                  <i class='fas fa-hdd' style='font-size:26px'></i>
                                </a>
                                  <div class='media-body'>
                                    <span class='name mb-0 text-sm'>$tipoProduto</span>
                                  </div>
                              </div>
                              </th>
                              <form action='/template/dashboard/phpcodes/equipamentos.php' method='post'>
                              <td style='display: none;'><input type='hidden' class='form-control' name='numeroProduto' id='numeroProduto' placeholder='Designacao' value='$numeroProduto'></td>
                              <td><input type='hidden' class='form-control' name='serie' id='serie' placeholder='' value='$serie'>$serie</td>
                              <td><input type='hidden' class='form-control' name='designacao' id='designacao' placeholder='' value='$designacao'>$designacao</td>
                              <td><input type='hidden' class='form-control' name='numeroSala' id='numeroSala' placeholder='' value='$numeroSala'>$numeroSala</td>
                              <td style='display: none'><input type='hidden' class='form-control' name='data' id='data' placeholder='' value='$data'>$data</td>
                              <td style='width:200px; text-align: center;'>
                                <button type='submit' id='infoNaoComposto' name='infoNaoComposto' style='margin-top: 0px;' class='btn btn-primary'><i class='fas fa-edit'></i></button>
                                <button type='submit' id='delete' name='delete' style='margin-top: 0px;' class='btn btn-danger'><i class='fas fa-trash'></i></button>
                              </td>
                           </tr>
                         </form>"; 
                           } else if ($codTipoProduto == 13) {
                             echo "<tr data-id='$numeroProduto'>
                                      <th scope='row'>
                              <div class='media align-items-center '>
                                <a href='#' class='avatar rounded-circle mr-3'>
                                <span class='iconify' data-icon='mdi-projector' data-inline='false' style='width: 40px; height: 40px; '></span>
                                </a>
                                  <div class='media-body'>
                                    <span class='name mb-0 text-sm'>$tipoProduto</span>
                                  </div>
                              </div>
                              </th>
                              <form action='/template/dashboard/phpcodes/equipamentos.php' method='post'>
                              <td style='display: none;'><input type='hidden' class='form-control' name='numeroProduto' id='numeroProduto' placeholder='Designacao' value='$numeroProduto'></td>
                              <td><input type='hidden' class='form-control' name='serie' id='serie' placeholder='' value='$serie'>$serie</td>
                              <td><input type='hidden' class='form-control' name='designacao' id='designacao' placeholder='' value='$designacao'>$designacao</td>
                              <td><input type='hidden' class='form-control' name='numeroSala' id='numeroSala' placeholder='' value='$numeroSala'>$numeroSala</td>
                              <td style='display: none'><input type='hidden' class='form-control' name='data' id='data' placeholder='' value='$data'>$data</td>
                              <td style='width:200px; text-align: center;'>
                                <button type='submit' id='infoNaoComposto' name='infoNaoComposto' style='margin-top: 0px;' class='btn btn-primary'><i class='fas fa-edit'></i></button>
                                <button type='submit' id='delete' name='delete' style='margin-top: 0px;' class='btn btn-danger'><i class='fas fa-trash'></i></button>
                              </td>
                           </tr>
                         </form>"; 
                           } else if ($codTipoProduto == 14) {
                             echo "<tr data-id='$numeroProduto'>
                                      <th scope='row'>
                              <div class='media align-items-center'>
                                <a href='#' class='avatar rounded-circle mr-3'>
                                  <div style='font-size: 24px;'>
                                  <i class='fas fa-server fas-5x'></i>
                                 </div>
                                 </a>
                                  <div class='media-body'>
                                    <span class='name mb-0 text-sm'>$tipoProduto</span>
                                  </div>
                              </div>
                              </th>
                              <form action='/template/dashboard/phpcodes/equipamentos.php' method='post'>
                              <td style='display: none;'><input type='hidden' class='form-control' name='numeroProduto' id='numeroProduto' placeholder='Designacao' value='$numeroProduto'></td>
                              <td><input type='hidden' class='form-control' name='serie' id='serie' placeholder='' value='$serie'>$serie</td>
                              <td><input type='hidden' class='form-control' name='designacao' id='designacao' placeholder='' value='$designacao'>$designacao</td>
                              <td><input type='hidden' class='form-control' name='numeroSala' id='numeroSala' placeholder='' value='$numeroSala'>$numeroSala</td>
                              <td style='display: none'><input type='hidden' class='form-control' name='data' id='data' placeholder='' value='$data'>$data</td>
                              <td style='width:200px; text-align: center;'>
                                <button type='submit' id='infoNaoComposto' name='infoNaoComposto' style='margin-top: 0px;' class='btn btn-primary'><i class='fas fa-edit'></i></button>
                                <button type='submit' id='delete' name='delete' style='margin-top: 0px;' class='btn btn-danger'><i class='fas fa-trash'></i></button>
                              </td>
                           </tr>
                         </form>"; 
                           } else if ($codTipoProduto == 15) {
                             echo "<tr data-id='$numeroProduto'>
                                      <th scope='row'>
                              <div class='media align-items-center '>
                                <a href='#' class='avatar rounded-circle mr-3'>
                                  <i class='material-icons' style='font-size:36px'>router</i>
                                </a>
                                  <div class='media-body'>
                                    <span class='name mb-0 text-sm'>$tipoProduto</span>
                                  </div>
                              </div>
                              </th>
                              <form action='/template/dashboard/phpcodes/equipamentos.php' method='post'>
                              <td style='display: none;'><input type='hidden' class='form-control' name='numeroProduto' id='numeroProduto' placeholder='Designacao' value='$numeroProduto'></td>
                              <td><input type='hidden' class='form-control' name='serie' id='serie' placeholder='' value='$serie'>$serie</td>
                              <td><input type='hidden' class='form-control' name='designacao' id='designacao' placeholder='' value='$designacao'>$designacao</td>
                              <td><input type='hidden' class='form-control' name='numeroSala' id='numeroSala' placeholder='' value='$numeroSala'>$numeroSala</td>
                              <td style='display: none'><input type='hidden' class='form-control' name='data' id='data' placeholder='' value='$data'>$data</td>
                              <td style='width:200px; text-align: center;'>
                                <button type='submit' id='infoNaoComposto' name='infoNaoComposto' style='margin-top: 0px;' class='btn btn-primary'><i class='fas fa-edit'></i></button>
                                <button type='submit' id='delete' name='delete' style='margin-top: 0px;' class='btn btn-danger'><i class='fas fa-trash'></i></button>
                              </td>
                           </tr>
                         </form>"; 
                           } else if ($codTipoProduto == 16) {
                             echo "
                            <tr data-id='$numeroProduto'>
                                      <th scope='row'>
                              <div class='media align-items-center '>
                                <a href='#' class='avatar rounded-circle mr-3'>
                                  <i class='material-icons' style='font-size:36px'>devices_other</i>
                                </a>
                                  <div class='media-body'>
                                    <span class='name mb-0 text-sm'>$tipoProduto</span>
                                  </div>
                              </div>
                              <form action='/template/dashboard/phpcodes/equipamentos.php' method='post'>
                              <td style='display: none;'><input type='hidden' class='form-control' name='numeroProduto' id='numeroProduto' placeholder='Designacao' value='$numeroProduto'></td>
                              <td><input type='hidden' class='form-control' name='serie' id='serie' placeholder='' value='$serie'>$serie</td>
                              <td><input type='hidden' class='form-control' name='designacao' id='designacao' placeholder='' value='$designacao'>$designacao</td>
                              <td><input type='hidden' class='form-control' name='numeroSala' id='numeroSala' placeholder='' value='$numeroSala'>$numeroSala</td>
                              <td style='display: none'><input type='hidden' class='form-control' name='data' id='data' placeholder='' value='$data'>$data</td>
                              <td style='width:200px; text-align: center;'>
                                <button type='submit' id='infoNaoComposto' name='infoNaoComposto' style='margin-top: 0px;' class='btn btn-primary'><i class='fas fa-edit'></i></button>
                                <button type='submit' id='delete' name='delete' style='margin-top: 0px;' class='btn btn-danger'><i class='fas fa-trash'></i></button>
                              </td>
                           </tr>
                         </form>"; 
                           }
                */
                      ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </div>

 <!-- ---------------------------------------Modal Adicionar Equipamento----------------------------------------------------------- -->


  <div class="modal fade" id="addEquipamento" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Adicionar Equipamento</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <form action="/template/admin/phpcodes/recebido.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <h4 class=""><b>Tipo de Equipamento</b></h4>
              <select name="codTipoProduto" id="codTipoProduto" value="codTipoProduto" class="custom-select sources" placeholder="My Categories" required>
                    <option value=''>Selecione o Equipamento</option>
                      <?php
                         $stmt = $DB->prepare("SELECT tipo,codTipoProduto FROM tipoProduto WHERE codTipoProduto in (2,3,13,14,15,16)");
                         $stmt->execute(); 
                         $stmt->bind_result($tipo, $codTipoProduto);
                         while ($stmt->fetch())
                            echo "<option name='$codTipoProduto' id='$codTipoProduto' value='$codTipoProduto'>$tipo</option>";
                         $stmt->free_result();
                             ?>
                   </select>
            </div>
            <div class="form-group">
              <h4 class=""><b>Designação</b></h4>
              <input type="text" class="form-control" name="designacao" id="designacao" placeholder="Designacao" required>
            </div>
            <div class="form-group">
              <h4 class=""><b>Marca</b></h4>
              <input type="text" class="form-control" name="marca" placeholder="Marca" required>
            </div>
            <div class="form-group">
              <h4 class=""><b>Piso</b></h4>
              <select name="piso" id="piso" required="true" class="custom-select sources" placeholder="My Categories" required>
                  <option value=''>Selecione o Piso</option>
                                          <?php
                         $stmt = $DB->prepare("SELECT DISTINCT numeroPiso FROM salas ORDER BY numeroPiso");
                         $stmt->execute(); 
                         $stmt->bind_result($numeroPiso);
                         while ($stmt->fetch())
                            echo "<option value='$numeroPiso'>$numeroPiso</option>";
                         $stmt->free_result();
                             ?>
                   </select>
            </div>
            <div class="form-group">
              <h4 class=""><b>Sala</b></h4>
              <select name="sala" id="sala" required="true" class="custom-select sources" placeholder="My Categories" required>
                                              <?php
                         $stmt = $DB->prepare("SELECT numeroPiso, numeroSala, descritivo FROM salas ORDER BY numeroSala");
                         $stmt->execute(); 
                         $stmt->bind_result($numeroPiso, $numeroSala, $descritivo);
                         while ($stmt->fetch())
                            echo "<option data-piso='$numeroPiso' value='$numeroSala'>$numeroSala</option>";
                         $stmt->free_result();
                             ?>
                      </select>
            </div>
            <input type="file" name="ficheiro" id="ficheiro" class="input-file" accept=".txt">

        </div>
        <div class="modal-footer ">
          <button type="submit" name="submit" id="submit" type="button" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Adicionar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- ---------------------------------------Modal  Informações não compostos----------------------------------------------------------- -->

  <div class="modal fade" id="infoNaoCompostos" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Editar Informações</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <form action="/template/dashboard/phpcodes/equipamentos.php" method="post">
            <div class="form-group">
              <h4 class=""><b>Designação</b></h4>
              <input class="form-control " id="designacaoNaoComposto" name="designacaoNaoComposto" type="" placeholder="">
              <input class="form-control " id="numeroProdutoNaoComposto" name="numeroProdutoNaoComposto" type="hidden" placeholder="">
            </div>
            <div class="form-group">
              <h4 class=""><b>Nº Série</b></h4>
              <input class="form-control " id="serieNaoComposto" name="serieNaoComposto" type="" placeholder="" readonly="">
            </div>
            <div class="form-group">
              <h4 class=""><b>Sala</b></h4>
              <select name="salaNaoComposto" id="salaNaoComposto" required="true" class="custom-select sources" placeholder="My Categories" required>
                 <?php
                 $stmt = $DB->prepare("SELECT numeroPiso, numeroSala, descritivo FROM salas ORDER BY numeroSala");
                 $stmt->execute(); 
                 $stmt->bind_result($numeroPiso, $numeroSala, $descritivo);
                 while ($stmt->fetch())
                    echo "<option data-piso='$numeroPiso' value='$numeroSala'>$numeroSala</option>";
                 $stmt->free_result();
                     ?>
              </select>
            </div>
            <div class="form-group">
              <h4 class=""><b>Data de registo</b></h4>
              <input class="form-control " id="dataNaoComposto" name="dataNaoComposto" type="" placeholder="" readonly="">
            </div>
        </div>
        <div class="modal-footer ">
          <button type="submit" name="submitNaoComposto" id="submitNaoComposto" type="button" class="btn btn-primary btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Atualizar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>


  <!-- ---------------------------------------Modal Informações Compostos----------------------------------------------------------- -->

<div class="modal fade" id="infoCompostos" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 771px;">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Editar Informações</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form action="/template/dashboard/phpcodes/equipamentos.php" method="post">
          <input class="form-control " id="numeroProdutoComposto" name="numeroProdutoComposto" type="hidden" placeholder="">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <h4 class=""><b>Designação</b></h4>
                <input class="form-control text-center" type="text" id="designacaoComposto" name="designacaoComposto" value="">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <h4 class=""><b>Nº Série</b></h4>
                <input class="form-control text-center" type="text" id="serieComposto" name="serieComposto" value="E7U4BWYS" readonly="">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <h4 class=""><b>Sala</b></h4>
                <select name="salaComposto" id="salaComposto" required="true" class="custom-select sources" placeholder="My Categories" required>
                 <?php
                 $stmt = $DB->prepare("SELECT numeroPiso, numeroSala, descritivo FROM salas ORDER BY numeroSala");
                 $stmt->execute(); 
                 $stmt->bind_result($numeroPiso, $numeroSala, $descritivo);
                 while ($stmt->fetch())
                    echo "<option data-piso='$numeroPiso' value='$numeroSala'>$numeroSala</option>";
                 $stmt->free_result();
                     ?>
              </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <h4 class=""><b>Data de registo</b></h4>
                <input class="form-control " id="dataComposto" name="dataComposto" type="" placeholder="" readonly="">
              </div>
            </div>
          </div>

          <label><strong>Componentes</strong></label>
          <table class="table table-bordered table-hover small w-100" id="tblComponentes">
          </table>
          <input type="file" name="ficheiroComponentes" id="ficheiroComponentes" class="input-file" accept=".txt">
          <div class="popup" onclick="myFunction()"><i class="fas fa-question-circle"></i>
            <span class="popuptext" id="myPopup">Selecione um ficheiro do CPU-Z</span>
          </div>
      </div>
      <div class="modal-footer" style="margin: auto;">
        <button style='margin-top: auto;' type="submit" name="submitComposto" id="submitComposto" type="button" class="btn btn-primary btn-lg">Atualizar Informações</button>
          <button type="submit" name="submitComponentes" id="submitComponentes" class="btn btn-primary btn-lg" style="margin-top: 5px;" data-toggle="modal">Atualizar Componentes</button>
          <button type="submit" name="registarAvaria" id="registarAvaria" class="btn btn-primary btn-lg registarAvaria" style="margin-top: 5px;">Registar Avaria</button>
      </div>
    </div>
      </form>
  </div>
</div>
</div>



  <!-- ---------------------------------------Modal  Modal Registar Avarias ----------------------------------------------------------- -->

  <div class="modal fade" id="mdlRegistarAvaria" tabindex="-1" data-backdrop="static">
    
    
    <div class="modal-dialog" style='max-width: 1109px;'>
     <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
        <div class="modal-header">
          <h4 class="modal-title"><b>Registar Avaria</b></h4>
          <button type="button" class="close" data-dismiss="modal" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
      <div class="modal-body">
            <div class="col-md-3">
              <div class="form-group">
                <h4 class=""><b>Designação</b></h4>
                <input class="form-control text-center" type="text" id="designacaoCompostoAvaria" name="designacaoCompostoAvaria" value="">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <h4 class=""><b>Nº Série</b></h4>
                <input class="form-control text-center" type="text" id="serieCompostoAvaria" name="serieCompostoAvaria" value="E7U4BWYS" readonly="">
              </div>
            </div>
        <input class="form-control text-center" type="hidden" id="numeroProdutoCompostoAvaria" name="numeroProdutoCompostoAvaria" value="">
          <table class="table table-striped table-bordered" id="avarias">
          </table>
      </div>
       <div class="modal-footer">
        </div>
     </div>
    </div>
  </div>




</body>
<!-- Scripts -->
<?php include 'template/dashboard/includes/scripts.php';?>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script>
// When the user clicks on div, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>
<script>
  $(document).ready(function() {
    $('#equipamentos').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
      },
    });


    $(".infoNaoCompostos").click(function() {
      var linha = $(this).closest("tr");
      $("#numeroProdutoNaoComposto").val(linha.data("id"));
      $("#numeroProdutoNaoComposto").val(linha.find("td").eq(0).html());
      $("#serieNaoComposto").val(linha.find("td").eq(1).html());
      $("#designacaoNaoComposto").val(linha.find("td").eq(2).html());
      $("#salaNaoComposto").val(linha.find("td").eq(3).html());
      $("#dataNaoComposto").val(linha.find("td").eq(4).html());
      $("#infoNaoCompostos").modal("show");
    });

    $(".infoCompostos").click(function() {
      var linha = $(this).closest("tr");
      $("#numeroProdutoComposto").val(linha.data("id"));
      $("#numeroProdutoComposto").val(linha.find("td").eq(0).html());
      $("#serieComposto").val(linha.find("td").eq(1).html());
      $("#designacaoComposto").val(linha.find("td").eq(2).html());
      $("#salaComposto").val(linha.find("td").eq(3).html());
      $("#dataComposto").val(linha.find("td").eq(4).html());
      $.post("/template/dashboard/phpcodes/componentes.php", {
        "produto": linha.data("id")
      }, function(data) {
        $("#tblComponentes").html(data)
        })
        $("#infoCompostos").modal("show");
      });
    
    
    
    /*$(".avariasHistorico").click(function() {
      var linha = $(this).closest("tr");
      $("#numeroProdutoCompostoAvaria").val(linha.data("id"));
      $("#numeroProdutoCompostoAvaria").val(linha.find("td").eq(0).html());
      $.post("/template/dashboard/listaAvarias.php", {
        "avariaLista": linha.data("id")
      }, function(data) {
        $("#avarias").html(data).dataTable({
          "language": {"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese.json"}
        })

                                      
    });
        $("#avariasHistorico").modal("show");
      });*/
    
  });
</script>
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
</html>