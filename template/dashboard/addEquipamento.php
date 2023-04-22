<!DOCTYPE html>
<html>

<head>
  <?php include 'includes/header.php';?>
  <style>
      .tabela {
      overflow-x: scroll;
    }
  </style>
</head>

<body>
  <?php include 'includes/sidebar.php';?>

  <!-- Header -->
  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Adicionar Equipamento</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="card border-0 tabela">
          <div class="map-canvas" style="height:100%;">
            <!-- <form action="/template/dashboard/phpcodes/recolherInformacao.php" method="post" enctype="multipart/form-data"> -->
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="form-control-label">Escola</label>
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
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="form-control-label">Tipo de Equipamento</label>
                    <select name="codTipoProduto" id="codTipoProduto" value="codTipoProduto" class="custom-select sources" placeholder="My Categories" required>
                    <option value=''>Selecione o Equipamento</option>
                      <?php
                         $stmt = $DB->prepare("SELECT tipo,codTipoProduto FROM tipoProduto WHERE codTipoProduto in (1,2,3,4,5,6,7,8)");
                         $stmt->execute(); 
                         $stmt->bind_result($tipo, $codTipoProduto);
                         while ($stmt->fetch())
                            echo "<option name='$codTipoProduto' id='$codTipoProduto' value='$codTipoProduto'>$tipo</option>";
                         $stmt->free_result();
                             ?>
                   </select>
                  </div>
                </div>
              </div>
              <div class="row">
              <div class="col-md-3">      
                <div class="form-group">
                <label class="form-control-label" for="input-marca">Designação</label>
                <input type="text" class="form-control" name="designacao" id="designacao" placeholder="Designacao" required>
                </div>
              </div>
                </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label name="titulo2" id="titulo2" class="form-control-label">Sala</label>
                    <select name="salas" id="salas" required="true" class="custom-select sources" placeholder="My Categories" required>
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label name="titulo" id="titulo" class="form-control-label">Ficheiro CPU-Z</label>
                    <input type="file" name="ficheiro" id="ficheiro" class="input-file" accept=".txt">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-primary">Adicionar</button>
                  </div>
                </div>
              </div>
             </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <?php include 'includes/footer.php';?>
  </div>
</body>
<!-- Scripts -->
<?php include 'includes/scripts.php';?>
                <?php if(isset($_SESSION['adicionarEquipamento'])) {
  echo "<script>Swal.fire(
  'Equipamento adicionado com sucesso!',
  '',
  'success'
) </script>"; 
  unset($_SESSION['adicionarEquipamento']);
} 
  if(isset($_SESSION['adicionarComputador'])) {
  echo "<script>Swal.fire(
  'Computador adicionado com sucesso!',
  '',
  'success'
) </script>"; 
  unset($_SESSION['adicionarComputador']);
}
  if(isset($_SESSION['editarComponentes'])) {
  echo "<script>Swal.fire(
  'Componentes alterados com sucesso!',
  '',
  'success'
) </script>"; 
  unset($_SESSION['editarComponentes']);
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
	$("#salas").html('<option value="" disabled selected>Selecione a sala</option>' + 
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
	</script>
  
  
<script>
  
  $("#codTipoProduto").change(function() {
    var selected_option = $('#codTipoProduto').val();
    if (selected_option === '3') {
      $('#ficheiro').attr('pk', '1').show();
      $('#titulo').attr('pk', '1').show();
    }
    if (selected_option != '3') {
      $("#ficheiro").removeAttr('pk').hide();
      $("#titulo").removeAttr('pk').hide();
    }
  })
  
    $("#codTipoProduto").change(function() {
    var selected_option = $('#codTipoProduto').val();
    if (selected_option === '3') {
      $('#ficheiro').attr('required', 'required');
    }
    if (selected_option != '3') {
      $("#ficheiro").removeAttr('required');
    }
  })
  
</script>

</html>