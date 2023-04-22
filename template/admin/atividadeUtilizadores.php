<!DOCTYPE html>
<html>

<head>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/verificalogin.php';?>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/header.php';?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">

  
  </head>

<body>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/template/admin/includes/sidebar.php';?>
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
                        <table id="atividade" class="table table-striped table-bordered" style="width:100%">
                <thead class="bg-primary">
                  <tr>
                    <th>Data/Hora</th>
                    <th>Nome Utilizador</th>
                    <th>Tipo Atividade</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   require $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/BDi.php';
                  
                   $stmt = $DB->prepare("SELECT `nome`, `descricao` , `dataHora` FROM `log` WHERE 1");
                   $stmt->execute(); 

                   $stmt->bind_result($nome, $descricao, $dataHora);
                   while ($stmt->fetch())
                    echo "<tr>  
                          <td>$dataHora</td>  
                          <td>$nome</td>
                          <td>$descricao</td>
                          <td style='width:200px;'>
                          <button style='margin-top: 0px;' type='button' class='btn btn-primary addDescritivo'><i class='fas fa-edit'></i></button>
                          </td>
                          </tr>";
                      ?>
                </tbody>
            </table>
            
            
            
          </div>
        </div>
      </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/footer.php';?>
  </div>
  
  <!------------------------------------------------- Modal de ações da atividade do utilizador--------------------------------------------------------------------->
  <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Atividade do Utilizador</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <form action="/template/admin/phpcodes/gerirUtilizadoresEdita.php" method="post" enctype="multipart/form-data">
              <input class="form-control " id="idUser_Edita" name="idUser_Edita" type="hidden" placeholder="" readonly="">
              <h4 class=""><b>Atividade</b></h4>
              <input class="form-control" id="nome" name="nome" type="text" placeholder=" " readonly="">
          </div>
        </div>
        <div class="modal-footer ">
          <button type="submit" name="submitEditar" id="submitEditar" type="button" class="btn btn-primary btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Atualizar</button>
        </div>
      </div>
    </div>
  </div>

</body>

<!-- Scripts -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/template/dashboard/includes/scripts.php';?>
<script>
  $(document).ready(function() {
    $('#atividade').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
      },
    });
  });
</script>


</html>