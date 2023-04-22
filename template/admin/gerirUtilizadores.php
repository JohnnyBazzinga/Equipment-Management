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
            <h3 class="mb-0">Gerir Utilizadores</h3>
            <button data-toggle="modal" data-target="#addUtilizador" style='margin-right: 1.5rem; margin-top: -30px; float: right;' type='button' class='btn btn-success'><i class="fas fa-plus"></i></button>
          </div>
          <!-- Light table -->
          <table id="utilizadores" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead class="thead-light">
              <tr>
                <th style='display:none;'>IdUser</th>
                <th>Foto</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Nivel</th>
                <th style='display:none;'>NivelReal</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require 'template/dashboard/includes/BDi.php';
                  /* $stmt = $DB->prepare("SELECT idUser,`email`, `nome`, `nivel`, `foto` FROM `gestaoUtilizadores` WHERE 1");
                   $stmt->execute(); 

                   $stmt->bind_result($idUser, $email, $nome, $nivel, $foto);
                   while ($stmt->fetch())
                     if ($nivel == 1 && $foto == NULL) {
                     echo "
                        <tr data-id=$idUser>
                          <td style='display: none;'>$idUser</td>
                          <td><img class='img' src='https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png' style='border-radius: 50%;' width='50px'></td>
                          <td>$nome</td>
                          <td>$email</td>
                          <td style='display: none;'>$nivel</td>
                          <td>Técnico</td>
                          <td style='width:200px; text-align:center;'>
                          <button style='margin-top: 0px;' class='btn btn-primary editar' data-title='Edit' data-toggle='modal' data-target='#edit' ><i class='fas fa-edit'></i></button>
                          <button class='btn btn-danger delete' data-title='Delete' data-toggle='modal' data-target='#delete' ><i class='fas fa-trash-alt'></i></button>
                          </td>
                        </tr>";
                     } else if ($nivel == 1) {
                     echo "
                        <tr data-id=$idUser>
                          <td style='display: none;'>$idUser</td>
                          <td><img class='img' src='",$foto,"' style='border-radius: 50%;' width='50px'></td>                          
                          <td>$nome</td>
                          <td>$email</td>
                          <td style='display: none;'>$nivel</td>
                          <td>Técnico</td>
                          <td style='width:200px; text-align:center;'>
                          <button style='margin-top: 0px;' class='btn btn-primary editar' data-title='Edit' data-toggle='modal' data-target='#edit' ><i class='fas fa-edit'></i></button>
                          <button class='btn btn-danger delete' data-title='Delete' data-toggle='modal' data-target='#delete' ><i class='fas fa-trash-alt'></i></button>
                          </td>
                        </tr>";
                     } else if ($nivel == 2 && $foto == NULL){
                     echo "
                        <tr data-id=$idUser>
                          <td style='display: none;'>$idUser</td>
                          <td><img class='img' src='https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png' style='border-radius: 50%;' width='50px'></td>
                          <td>$nome</td>
                          <td>$email</td>
                          <td style='display: none;'>$nivel</td>
                          <td>Administrador</td>
                          <td style='width:200px; text-align:center;'>
                          <button style='margin-top: 0px;' class='btn btn-primary editar' data-title='Edit' data-toggle='modal' data-target='#edit' ><i class='fas fa-edit'></i></button>
                          <button class='btn btn-danger delete' data-title='Delete' data-toggle='modal' data-target='#delete' ><i class='fas fa-trash-alt'></i></button>
                          </td>
                        </tr>";
                     } else if ($nivel == 2){
                       echo "
                        <tr data-id=$idUser>
                        <td style='display: none;'>$idUser</td>
                          <td><img class='img' src='",$foto,"' style='border-radius: 50%;' width='50px'></td>
                          <td>$nome</td>
                          <td>$email</td>
                          <td style='display: none;'>$nivel</td>
                          <td>Administrador</td>
                          <td style='width:200px; text-align:center;'>
                          <button style='margin-top: 0px;' class='btn btn-primary editar' data-title='Edit' data-toggle='modal' data-target='#edit' ><i class='fas fa-edit'></i></button>
                          <button class='btn btn-danger delete' data-title='Delete' data-toggle='modal' data-target='#delete' ><i class='fas fa-trash-alt'></i></button>
                          </td>
                        </tr>";
                     } else if ($nivel == NULL && $foto == NULL) {
                     echo "
                        <tr data-id=$idUser>
                        <td style='display: none;'>$idUser</td>
                          <td><img class='img' src='https://digimedia.web.ua.pt/wp-content/uploads/2017/05/default-user-image.png' style='border-radius: 50%;' width='50px'></td>
                          <td>$nome</td>
                          <td>$email</td>
                          <td style='display: none;'>$nivel</td>
                          <td>Sem Nivel</td>
                          <td style='width:200px; text-align:center;'>
                          <button style='margin-top: 0px;' class='btn btn-primary editar' data-title='Edit' data-toggle='modal' data-target='#edit' ><i class='fas fa-edit'></i></button>
                          <button class='btn btn-danger delete' data-title='Delete' data-toggle='modal' data-target='#delete' ><i class='fas fa-trash-alt'></i></button>
                          </td>
                        </tr>";
                     } else if ($nivel == NULL) {
                     echo "
                        <tr data-id=$idUser>
                        <td style='display: none;'>$idUser</td>
                          <td><img class='img' src='",$foto,"' style='border-radius: 50%;' width='50px'></td>
                          <td>$nome</td>
                          <td>$email</td>
                          <td style='display: none;'>$nivel</td>
                          <td>Sem Nivel</td>
                          <td style='width:200px; text-align:center;'>
                          <button style='margin-top: 0px;' class='btn btn-primary editar' data-title='Edit' data-toggle='modal' data-target='#edit' ><i class='fas fa-edit'></i></button>
                          <button class='btn btn-danger delete' data-title='Delete' data-toggle='modal' data-target='#delete' ><i class='fas fa-trash-alt'></i></button>
                          </td>
                        </tr>";
                     }
                   $stmt->free_result();*/
                    ?>
            </tbody>
          </table>
        </div>

        
<!-- ---------------------------------------Modal apagar Utilizador----------------------------------------------------------- -->

        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"><b>Apagar o Utilizador</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">

                <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Tem a certeza que pretende apagar este utilizador?</div>
                <form action="/template/admin/phpcodes/gerirUtilizadores.php" method="post" >
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

 
      <!-- ---------------------------------------Modal Adicionar Utilizador----------------------------------------------------------- -->

      <div class="modal fade" id="addUtilizador" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Adicionar Utilizador</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <form action="/template/admin/phpcodes/gerirUtilizadores.php" method="post">
            <div class="form-group">
              <h4 class=""><b>Nome</b></h4>
              <input class="form-control " id="nomeAdd" name="nomeAdd" type="" placeholder="" required minlength="5">
            </div>
            <div class="form-group">
              <h4 class=""><b>Email</b></h4>
              <input class="form-control " id="emailAdd" name="emailAdd" type="email" placeholder="" required>
            </div>
          <div class="form-group">
            <h4 class=""><b>Nivel</b></h4>
            <select name="nivelAdd" id="nivelAdd" value="nivelAdd" class="custom-select sources" placeholder="My Categories" required>
                    <option value='1'>Técnico</option>
                    <option value='2'>Administrador</option>
                   </select>
          </div>
        </div>
        <div class="modal-footer ">
          <button type="submit" name="submitAdd" id="submitAdd" type="button" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Adicionar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
    
    
    <!-- ---------------------------------------Modal editar Informações do Utilizador----------------------------------------------------------- -->
  
  <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Informações do Utilizador</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <form action="/template/admin/phpcodes/gerirUtilizadores.php" method="post" enctype="multipart/form-data">
              <input class="form-control " id="idUser_Edita" name="idUser_Edita" type="hidden" placeholder="" readonly="">
              <h4 class=""><b>Nome</b></h4>
              <input class="form-control" id="nome" name="nome" type="text" placeholder=" " readonly="">

          </div>
          <div class="form-group">
            <h4 class=""><b>Email</b></h4>
            <input class="form-control " id="email" name="email" type="text" placeholder="" readonly="">
          </div>
          <div class="form-group">
            <h4 class=""><b>Nivel</b></h4>
            <select name="nivel" id="nivel" value="nivel" class="custom-select sources" placeholder="My Categories" required>
                    <option value='1'>Técnico</option>
                    <option value='2'>Administrador</option>
                   </select>
          </div>
        </div>
        <div class="modal-footer ">
          <button type="submit" name="submitEditar" id="submitEditar" type="button" class="btn btn-primary btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Atualizar</button>
        </div>
      </div>
    </div>
  </div>
    
    
</body>
        
<!-- Scripts -->
<?php include 'template/dashboard/includes/scripts.php';?>
                <?php if(isset($_SESSION['status'])) {
  echo "<script>Swal.fire(
  'Alterações feitas com sucesso!',
  '',
  'success'
) </script>";
  unset($_SESSION['status']);
}
if(isset($_SESSION['apagar'])) {
  echo "<script>Swal.fire(
  'Utilizador apagado com sucesso',
  '',
  'success'
) </script>";
  unset($_SESSION['apagar']);
}
if(isset($_SESSION['adicionar'])) {
  echo "<script>Swal.fire(
  'Utilizador adicionado com sucesso',
  '',
  'success'
) </script>";
  unset($_SESSION['adicionar']);
}
        
  ?>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function() {

    $(".editar").click(function() {
      var linha = $(this).closest("tr");
      $("#idUser").val(linha.data("id"));
      $("#idUser_Edita").val(linha.find("td").eq(0).html());
      $("#nome").val(linha.find("td").eq(2).html());
      $("#email").val(linha.find("td").eq(3).html());
      $("#nivel").val(linha.find("td").eq(4).html());
      $("#editar").modal("show");
    });

    $(".delete").click(function() {
      var linha = $(this).closest("tr");
      $("#idUser").val(linha.data("id"));
    });

    $('#utilizadores').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
      }
    });
  });
</script>

</html>