<!DOCTYPE html>
<html>

<head>
  <?php include 'includes/header.php';?>
  
</head>

<body>
  <?php include 'includes/sidebar.php';?>

  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Atividade dos Utilizadores</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="card border-0">
          <div class="map-canvas" style="height: 100%;">

              <table id="atividade" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>Data/Hora</th>
                    <th>Nome Utilizador</th>
                    <th>Tipo Atividade</th>
                    <th style='display:none;'>Tipo Atividade</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   require 'template/dashboard/includes/BDi.php';
                   
                  
                   /*$stmt = $DB->prepare("SELECT `nome`,tipo, `descricao` , `dataHora` FROM `log` WHERE 1");
                   $stmt->execute(); 

                   $stmt->bind_result($nome,$tipo, $descricao, $dataHora);
                   while ($stmt->fetch())
                    echo "<tr>  
                          <td>$dataHora</td>  
                          <td>$nome</td>
                          <td>$tipo</td>
                          <td style='display:none;'>$descricao</td>
                          <td style='width:200px; text-align:center;'>
                          <button style='margin-top: 0px;' type='button' class='btn btn-primary info'><i class='fas fa-eye'></i></button>
                          </td>
                          </tr>";*/
                      ?>
                </tbody>
            </table>
            
            
            
          </div>
        </div>
      </div>
    </div>
    <?php include 'includes/footer.php';?>
  </div>
  
  <!------------------------------------------------- Modal de ações da atividade do utilizador--------------------------------------------------------------------->
  <div class="modal fade" id="infoAtividade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Atividade do Utilizador</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <h4 class=""><b>Nome</b></h4>
              <input class="form-control" id="nome" name="nome" type="text" placeholder=" " readonly="">
          </div>
          <div class="form-group">
              <h4 class=""><b>Tipo de Atividade</b></h4>
              <input class="form-control" id="tipoAtividade" name="tipoAtividade" type="text" placeholder=" " readonly="">
          </div>
          <div class="form-group">
              <h4 class=""><b>Data</b></h4>
              <input class="form-control" id="data" name="data" type="text" placeholder=" " readonly="">
          </div>
          <div class="form-group">
            <h4 class=""><b>Detalhes da Atividade</b></h4>
            <textarea style="resize: none;" name="reparacao" class="form-control" id="Informacoes" required=""readonly="" rows="5"></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

<!-- Scripts -->
<?php include 'includes/scripts.php';?>
<script>
  $(document).ready(function() {
    $('#atividade').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
      },
    });
  });
  
    $(".info").click(function() {
    var linha = $(this).closest("tr");
    $("#numero").val(linha.data("id"));
    $("#nome").val(linha.find("td").eq(1).html());
    $("#tipoAtividade").val(linha.find("td").eq(2).html());
    $("#data").val(linha.find("td").eq(0).html());
    $("#Informacoes").val(linha.find("td").eq(3).html());
    $("#infoAtividade").modal("show");
  });
  
</script>


</html>