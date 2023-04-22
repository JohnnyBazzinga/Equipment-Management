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
        <div class="card " >
          <!-- Card header -->
          <div class="card-header border-0">
            <h3 class="mb-0">Gerir Salas</h3>
            <button data-toggle="modal" data-target="#addSala" style='margin-right: 1.5rem; margin-top: -30px; float: right;' type='button' class='btn btn-success'><i class="fas fa-plus"></i></button>
        </div>
          <!-- Light table -->
          <table id="salas" class="table table-striped table-bordered" style="width:100%">
            <thead class="thead-light">
              <tr>
                <th style="display:none;">Id</th>
                <th>Escola</th>
                <th>Sala</th>
                <th>Descritivo</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
                require 'template/dashboard/includes/BDi.php';
                   $stmt = $DB->prepare("SELECT id,`numeroSala`,escola, `descritivo` FROM `salas` WHERE 1");
                   $stmt->execute(); 

                   $stmt->bind_result($id,$numeroSala,$escola, $descritivo);
                   while ($stmt->fetch())
                    echo "<tr>  
                          <td style='display:none;'>$id</td>
                          <td>$escola</td>
                          <td>$numeroSala</td>  
                          <td>$descritivo</td>
                          <td style='width:200px; text-align:center;'>
                          <button style='margin-top: 0px;' type='button' class='btn btn-primary addDescritivo'><i class='fas fa-edit'></i></button>
                          <button style='margin-top: 0px;' type='button' class='btn btn-danger apagar'><i class='fas fa-trash-alt'></i></button>
                          </td>
                          </tr>";
                      ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <!-- ---------------------------------------Modal Adicionar Descritivo----------------------------------------------------------- -->

  
  <div class="modal fade" id="addDescritivo" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Editar Descritivo</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <form action="/template/admin/phpcodes/gerirSalas.php" method="post">
            <div class="form-group">
              <input class="form-control " id="idSala" name="idSala" type="hidden" placeholder="" readonly="">
              <h4 class=""><b>Sala</b></h4>
              <input class="form-control " id="numeroSalaAdd" name="numeroSalaAdd" type="" placeholder="" readonly="">
            </div>
            <div class="form-group">
              <h4 class=""><b>Descritivo</b></h4>
              <input class="form-control " id="descritivo" name="descritivo" type="" placeholder="">
            </div>
        </div>
        <div class="modal-footer ">
          <button type="submit" name="submit" id="submit" type="button" class="btn btn-primary btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Atualizar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  
  
    <!-- ---------------------------------------Modal Adicionar Sala----------------------------------------------------------- -->

  <div class="modal fade" id="addSala" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Adicionar Sala</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <form action="/template/admin/phpcodes/gerirSalas.php" method="post">
                  <div class="form-group">
                    <label class="form-control-label">Escola</label>
                    <select name="escolas" id="escolas" value="escolas" class="custom-select sources" placeholder="My Categories" required>
                    <option value=''>Selecione a Escola</option>
                      <?php
                         $stmt = $DB->prepare("SELECT id,escola FROM escolas WHERE 1");
                         $stmt->execute(); 
                         $stmt->bind_result($id,$escola);
                         while ($stmt->fetch())
                            echo "<option name='$id' id='$id' value='$escola'>$escola</option>";
                         $stmt->free_result();
                             ?>
                   </select>
                  </div>
            <div class="form-group">
              <h4 class=""><b>Sala</b></h4>
              <input class="form-control " id="numeroSala" name="numeroSala" type="" placeholder="">
            </div>
            <div class="form-group">
              <h4 class=""><b>Descritivo (Opcional)</b></h4>
              <input class="form-control " id="descritivoAdicionar" name="descritivoAdicionar" type="" placeholder="">
            </div>
        </div>
        <div class="modal-footer ">
          <button type="submit" name="submitAdd" id="submitAdd" type="button" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Adicionar</button>
        </div>
        </form>
      </div>
    </div>
  </div> 
  
  <!-- ---------------------------------------Modal apagar Sala----------------------------------------------------------- -->

        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"><b>Apagar a sala</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">

                <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Tem a certeza que pretende apagar esta sala?</div>
                <form action="/template/admin/phpcodes/gerirSalas.php" method="post" >
                  <input class="form-control " id="numeroSalaApagar" name="numeroSalaApagar" type="hidden" placeholder="" readonly="">
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function() {

    $(".addDescritivo").click(function() {
      var linha = $(this).closest("tr");
      $("#numeroSalaAdd").val(linha.data("id"));
      $("#idSala").val(linha.find("td").eq(0).html());
      $("#numeroSalaAdd").val(linha.find("td").eq(2).html());
      $("#descritivo").val(linha.find("td").eq(3).html());
      $("#addDescritivo").modal("show");
    });

        $(".apagar").click(function() {
      var linha = $(this).closest("tr");
      $("#numeroSalaApagar").val(linha.data("id"));
      $("#numeroSalaApagar").val(linha.find("td").eq(0).html());
          $("#delete").modal("show");
    });
    
    $('#salas').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
      }
    });

  });
</script>

</html>