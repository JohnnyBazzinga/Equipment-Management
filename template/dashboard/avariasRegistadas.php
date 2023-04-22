<!DOCTYPE html>
<html>

<head>
  <?php include 'includes/header.php';?>
</head>

<body>
  <?php include 'includes/sidebar.php';?>

  <!-- Header -->
  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Avarias Registadas</h6>
          </div>
        </div>
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
            <h3 class="mb-0">&nbsp;</h3>
            <button data-toggle="modal" data-target="#addAvaria" style='margin-right: 1.5rem; margin-top: -30px; float: right;' type='button' class='btn btn-success'><i class="fas fa-plus"></i></button> </div>


          <table id="avarias" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Data da Avaria</th>
                <th>Designação</th>
                <th>Escola</th>
                <th>Sala</th>
                <th style="display:none">Nome</th>
                <th style="display:none">Email</th>
                <th style="display:none">Problema</th>
                <th style="display:none">dataRegistoAvaria</th>
                <th style="display:none">idUserReparacao</th>
                <th style="display:none">EmailTecnico</th>
                <th style="display:none">reparacao</th>
                <th style="display:none">dataReparacao</th>
                <th style="display:none">dataReparacao</th>
                <th>Estado</th>
                <th>Reparado por</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
                   require 'template/dashboard/includes/BDi.php';
                   $stmt = $DB->prepare("SELECT numero,dataRegistoAvaria, numeroProduto,designacao,escola,numeroSala,nome,emailRegisto,problemasComuns,problema,estadoReparacao, dataRegistoAvaria, 
                                          idUserReparacao, emailTecnico, reparacao, dataReparacao FROM `reparacoes` ORDER BY estadoReparacao ASC");
                   $stmt->execute(); 

                   $stmt->bind_result($numero,$dataRegistoAvaria, $numeroProduto, $designacao, $escola,$numeroSala, $nome, $email,$problemasComuns,$problema, $estadoReparacao, $dataRegistoAvaria, $idUserReparacao, $emailTecnico, $reparacao, $dataReparacao);
                   while ($stmt->fetch())

                     if ($estadoReparacao == 0) { // Equipamento por ser reparado
                     echo "
                        <tr data-id='$numero'>
                          <td>$dataRegistoAvaria</td>
                          <td>$designacao</td>
                          <td>$escola</td>
                          <td>$numeroSala</td>
                          <td style='display:none;'>$nome</td>
                          <td style='display:none;'>$email</td>
                          <td style='display:none;'>$problema</td>
                          <td style='display:none;'>$dataRegistoAvaria</td>
                          <td style='display:none;'>$dataReparacao</td>
                          <td style='display:none;'>$idUserReparacao</td>
                          <td style='display:none;'>$emailTecnico</td>
                          <td style='display:none;'>$reparacao</td>
                          <td style='display:none;'>$problemasComuns</td>
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
                          <td>$escola</td>
                          <td>$numeroSala</td>
                          <td style='display:none;'>$nome</td>
                          <td style='display:none;'>$email</td>
                          <td style='display:none;'>$problema</td>
                          <td style='display:none;'>$dataReparacao</td>
                          <td style='display:none;'>$dataRegistoAvaria</td>
                          <td style='display:none;'>$idUserReparacao</td>
                          <td style='display:none;'>$emailTecnico</td>
                          <td style='display:none;'>$reparacao</td>
                          <td style='display:none;'>$problemasComuns</td>
                          <td style='color:blue'>Equipamento reparado com sucesso</td>
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
        </div>
        </form>
      </div>
    </div>
    </form>
    <!---------------------------- Footer ----------------------------------->
    <?php include 'template/dashboard/includes/footer.php';?>
  </div>


  <!-- ---------------------------------------Modais----------------------------------------------------------- -->

  <!---  Modal adicionar Avaria --->
  <div class="modal fade" id="addAvaria" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Adicionar Avaria</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <form action="/template/dashboard/phpcodes/avarias.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="form-control-label"><b>Escola</b></label>
                    <input type="hidden" name="escolaSTR" id="escolaSTR"/>
                    <select name="escolas" id="escolas" value="escolas" class="custom-select sources" placeholder="My Categories" required>
                    <option value=''>Selecione a Escola</option>
                      <?php
                         require "includes/BDi.php";
                         $stmt = $DB->prepare("SELECT id,escola FROM escolas WHERE 1");
                         $stmt->execute(); 
                         $stmt->bind_result($id,$escola);
                         while ($stmt->fetch())
                            echo "<option name='$id' id='$id' value='$id'>$escola</option>";
                         $stmt->free_result();
                             ?>
                   </select>
                  </div>
            <div class="form-group">
              <h4 class=""><b>Sala</b></h4>
              <select name="sala" class="form-control cortextoform" id="sala" required="">
                    <option disabled="" value="-1" selected="">- Selecione a sala -</option>
                      <?php
                         $stmt = $DB->prepare("SELECT DISTINCT numeroSala FROM salas ORDER BY numeroSala");
                         $stmt->execute(); 
                         $stmt->bind_result($numeroSala);
                         while ($stmt->fetch())
                            echo "<option value='$numeroSala'>$numeroSala</option>";
                         $stmt->free_result();
                        ?>
                  </select>
            </div>
            <div class="form-group">
              <h4 class=""><b>Equipamento</b></h4>
              <select name="NumeroProduto" class="form-control cortextoform" id="NumeroProduto" required="">
										<option disabled="" value="" data-sala="-1" selected="">- Selecione o equipamento -</option>
                      <?php
                         $stmt = $DB->prepare("SELECT numeroProduto,`designacao`,`serie`,numeroSala FROM `produto` WHERE composto=0 ORDER BY `designacao`");
                         $stmt->execute(); 
                         $stmt->bind_result($numeroProduto,$designacao,$serie,$sala);
                         while ($stmt->fetch())
                            echo "
                            <option data-sala='$sala' value='$numeroProduto|$designacao'>$designacao</option>";
                         $stmt->free_result();
                        ?>
										</select>
            </div>
            <h4 class=""><b>Problemas Comuns</b></h4>
                            <div class="form-group">
                      <ul class="list-unstyled row">
                          <li class="col-md-6 col-xs-6"><label><input  id="problemaComum1" name="problemaComum1" type="checkbox" value="Pc nao liga"/> Pc nao liga</label></li>
                          <li class="col-md-6 col-xs-6"><label><input  id="problemaComum2" name="problemaComum2" type="checkbox" value="Falha no HDD"/> Falha no HDD</label></li>
                      </ul>
                       <ul class="list-unstyled row">
                          <li class="col-md-6 col-xs-6"><label><input  id="problemaComum3" name="problemaComum3" type="checkbox" value="Problema de Bips"/> Problema de Bips</label></li>
                          <li class="col-md-6 col-xs-6"><label><input  id="problemaComum4" name="problemaComum4" type="checkbox" value="Problemas de Internet"/> Problemas de Internet</label></li>
                      </ul>
                       <ul class="list-unstyled row">
                          <li class="col-md-6 col-xs-6"><label><input  id="problemaComum5" name="problemaComum5" type="checkbox" value="Portas USB nao reconhecidas"/> Portas USB nao reconhecidas</label></li>
                          <li class="col-md-6 col-xs-6"><label><input  id="problemaComum6" name="problemaComum6" type="checkbox" value="Outras"/> Outras</label></li>
                      </ul>
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
                      <h4 class=""><b>Problemas Comuns</b></h4>
                            <div class="form-group">
                      <ul class="list-unstyled row">
                          <li class="col-md-6 col-xs-6"><label><input  disabled="disabled" id="problemaComum1" name="problemaComum1" type="checkbox" value="Pc nao liga"/> Pc nao liga</label></li>
                          <li class="col-md-6 col-xs-6"><label><input  disabled="disabled" id="problemaComum2" name="problemaComum2" type="checkbox" value="Falha no HDD"/> Falha no HDD</label></li>
                      </ul>
                       <ul class="list-unstyled row">
                          <li class="col-md-6 col-xs-6"><label><input  disabled="disabled" id="problemaComum3" name="problemaComum3" type="checkbox" value="Problema de Bips"/> Problema de Bips</label></li>
                          <li class="col-md-6 col-xs-6"><label><input  disabled="disabled" id="problemaComum4" name="problemaComum4" type="checkbox" value="Problemas de Internet"/> Problemas de Internet</label></li>
                      </ul>
                       <ul class="list-unstyled row">
                          <li class="col-md-6 col-xs-6"><label><input  disabled="disabled" id="problemaComum5" name="problemaComum5" type="checkbox" value="Portas USB nao reconhecidas"/> Portas USB nao reconhecidas</label></li>
                          <li class="col-md-6 col-xs-6"><label><input  disabled="disabled" id="problemaComum6" name="problemaComum6" type="checkbox" value="Outras"/> Outras</label></li>
                      </ul>
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
                  <h4 class=""><b>Soluções Comuns</b></h4>
                <div class="form-group">
                      <ul class="list-unstyled row">
                          <li class="col-md-6 col-xs-6"><label><input type="checkbox"/> Reinstalar o SO</label></li>
                          <li class="col-md-6 col-xs-6"><label><input type="checkbox"/> RAM mal encaixada</label></li>
                      </ul>
                                        <ul class="list-unstyled row">
                          <li class="col-md-6 col-xs-6"><label><input type="checkbox"/> Trocar algum componente</label></li>
                          <li class="col-md-6 col-xs-6"><label><input type="checkbox"/> Reset à BIOS</label></li>
                      </ul>
                                        <ul class="list-unstyled row">
                          <li class="col-md-6 col-xs-6"><label><input type="checkbox"/> Limpeza</label></li>
                          <li class="col-md-6 col-xs-6"><label><input type="checkbox"/> Outras</label></li>
                      </ul>
                  </div>
          <div class="form-group">
            <h4 class=""><b>Diagnóstico da Reparação</b></h4>
            <textarea style="resize: none;" name="diagnosticoReparacao" class="form-control" id="diagnosticoReparacao" required="" rows="5"></textarea>
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


</body>

<!---------------------------- Scripts ------------------------------------>
<?php include 'template/dashboard/includes/scripts.php';?>
                <?php if(isset($_SESSION['adicionarAvaria'])) {
  echo "<script>Swal.fire(
  'Avaria adicionada com sucesso!',
  '',
  'success'
) </script>";
  unset($_SESSION['adicionarAvaria']);
}

  if(isset($_SESSION['adicionarReparacao'])) {
  echo "<script>Swal.fire(
  'Reparação registada com sucesso!',
  '',
  'success'
) </script>";
  unset($_SESSION['adicionarReparacao']);
}
        
  ?>
<script>
  
  // escolher salas de uma escola especifica-------------------------------
		var salas = new Array();
            salas[2] += "<?php 
                         $stmt = $DB->prepare("SELECT numeroSala FROM salas WHERE escola = 'Escola Secundária de Monserrate'");
                         $stmt->execute(); 
                         $stmt->bind_result($numeroSala);
                         while ($stmt->fetch())
                            echo "<option value='$numeroSala'>$numeroSala</option>";
                         $stmt->free_result(); ?>"
            salas[1] += "<?php 
                         $stmt = $DB->prepare("SELECT numeroSala FROM salas WHERE escola = 'Escola Pedro Barbosa'");
                         $stmt->execute(); 
                         $stmt->bind_result($numeroSala);
                         while ($stmt->fetch())
                            echo "<option value='$numeroSala'>$numeroSala</option>";
                         $stmt->free_result(); ?>"

function mostrasalas(){
	$("#sala").html('<option value="" disabled selected>Selecione a sala</option>' + 
		salas[$("#escolas").val()]);
}
      
	$(document).ready(function(){
		mostrasalas();
			$("#escolas").change(function(){
				$("#escolaSTR").val($("#escolas option:selected").text());
				mostrasalas();
			});
		});
//-----------------------------------------------------------------------------
  
  $(document).ready(function() {
    $('#avarias').DataTable({
      "language": {
        "ordering": false,
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
    $("#problemaComum1").val(linha.find("td").eq(12).html());
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
  
   /* $(".apagar").click(function() {
    var linha = $(this).closest("tr");
    $("#numeroApagar").val(linha.data("id"));

    $("#mdlApagarReparacao").modal("show");
  });*/
  
     $(document).ready(function() {
    $("#sala").change(function() {
      $("#NumeroProduto option[data-sala!='"+$(this).val()+"']").hide()
      $("#NumeroProduto option[data-sala='"+$(this).val()+"']").show()
    })  
   })
</script>

</html>