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
            <h3 class="mb-0">Gerir Escolas</h3>
            <button data-toggle="modal" data-target="#addEscola" style='margin-right: 1.5rem; margin-top: -30px; float: right;' type='button' class='btn btn-success'><i class="fas fa-plus"></i></button>
          </div>
                        <table id="atividade" class="table table-striped table-bordered" style="width:100%">
                <thead class="thead-light">
                  <tr>
                    <th style="display:none;">Id</th>
                    <th>Escola</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   require 'template/dashboard/includes/BDi.php';
                  
                   $stmt = $DB->prepare("SELECT id,`escola` FROM `escolas` WHERE 1");
                   $stmt->execute(); 

                   $stmt->bind_result($id,$nome);
                   while ($stmt->fetch())
                    echo "<tr>  
                          <td style='display:none;'>$id</td>
                          <td>$nome</td>  
                          <td style='width:200px; text-align:center;'>
                          <button style='margin-top: 0px;' type='button' class='btn btn-primary editar'><i class='fas fa-edit'></i></button>
                          <button class='btn btn-danger delete'><i class='fas fa-trash-alt'></i></button>
                          </td>
                          </tr>";
                      ?>
                </tbody>
            </table>
            
            
            
          </div>
        </div>
      </div>
    <?php include 'template/dashboard/includes/footer.php';?>
  </div>
  
  <!------------------------------------------------- Modal de ações da atividade do utilizador--------------------------------------------------------------------->
  <div class="modal fade" id="mdlEditar" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Editar Escola</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <form action="/template/admin/phpcodes/gerirEscolas.php" method="post" enctype="multipart/form-data">
              <input class="form-control " id="idEscola" name="idEscola" type="hidden" placeholder="" readonly="">
              <h4 class=""><b>Escola</b></h4>
              <input class="form-control" id="nome" name="nome" type="text" placeholder=" ">
          </div>
        </div>
        <div class="modal-footer ">
          <button type="submit" name="submitEditar" id="submitEditar" type="button" class="btn btn-primary btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Atualizar</button>
        </div>
      </div>
    </div>
  </div>

    
          <!-- ---------------------------------------Modal Adicionar Utilizador----------------------------------------------------------- -->

      <div class="modal fade" id="addEscola" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Adicionar Escola</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <form action="/template/admin/phpcodes/gerirEscolas.php" method="post">
            <div class="form-group">
              <h4 class=""><b>Escola</b></h4>
              <input class="form-control " id="escolaNome" name="escolaNome" placeholder="" required>
            </div>
        </div>
        <div class="modal-footer ">
          <button type="submit" name="submitEscola" id="submitEscola" type="button" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Adicionar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
    
    <!-- ---------------------------------------Modal apagar Utilizador----------------------------------------------------------- -->

        <div class="modal fade" id="mdlDelete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"><b>Apagar Escola</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">

                <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Tem a certeza que pretende apagar esta escola?</div>
                <form action="/template/admin/phpcodes/gerirEscolas.php" method="post" >
                  <input class="form-control " id="idUser" name="idUser" type="hidden" placeholder="" readonly="">
              </div>
              <div class="modal-footer" style="padding: 1rem;">
                <button type="button" class="btn btn-secondary btn1" data-dismiss="modal" style="margin: 1.3125rem 6px;">Não</button>
                <input type="submit" name="submitApagar" id="submitApagar" class="btn btn-danger btn1" style="margin: 1.3125rem 6px;" value="Sim">
              </div>
              </form>
            </div>
          </div>
        </div>
    
</body>

<!-- Scripts -->
<?php include 'template/dashboard/includes/scripts.php';?>
<script>
  $(document).ready(function() {

    $(".editar").click(function() {
      var linha = $(this).closest("tr");
      $("#idUser").val(linha.data("id"));
      $("#idEscola").val(linha.find("td").eq(0).html());
      $("#nome").val(linha.find("td").eq(1).html());
      $("#mdlEditar").modal("show");
    });

    $(".delete").click(function() {
      var linha = $(this).closest("tr");
      $("#idUser").val(linha.data("id"));
      $("#idUser").val(linha.find("td").eq(0).html());
      $("#mdlDelete").modal("show");
    });
    
    $('#atividade').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
      },
    });
  });
</script>


</html>