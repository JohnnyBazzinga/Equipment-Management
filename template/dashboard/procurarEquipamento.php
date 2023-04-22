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
            <h6 class="h2 text-white d-inline-block mb-0">Procurar Equipamento</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <form action="../equipamentos/listartodos" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col">
          <div class="card border-0 tabela">
            <div class="map-canvas" style="height:100%;">
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
                    <select name="codTipoProduto" id="codTipoProduto" value="codTipoProduto" class="custom-select sources" placeholder="My Categories">
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
                    <label class="form-control-label">Sala</label>
                    <select name="salas" id="salas" class="custom-select sources" placeholder="My Categories">
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="form-control-label" id="serie" name="serie">Nº Série</label>
                    <div class="popup" onclick="myFunction()"><i class="fas fa-question-circle"></i>
                     <span class="popuptext" id="myPopup">Preencher na falta do QR Code</span></div>
                    <input type="text" class="form-control" placeholder="Nº Série">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <button type="submit" name="submitEquipamentos" id="submitEquipamentos" class="btn btn-primary">Procurar</button>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Listar todos Equipamentos</button>
                  </div>
                </div>
              </div>
    </form>
    </div>
    </div>
    <!-- Footer -->
    <?php include 'includes/footer.php';?>
    </div>

    <!-- Scripts -->
    <?php include 'includes/scripts.php';?>
<script>
// When the user clicks on div, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>
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
      $(document).ready(function() {
        $("#piso").change(function() {
          $("#sala option").attr("disabled", false).show()
          //$("#sala option[data-piso!='"+$(this).val()+"']").hide()
          $("#sala option[data-piso!='" + $(this).val() + "']").attr("disabled", "disabled").hide()
          //$("#sala option:selected").prop("selected", false);
          $("#sala option:not([disabled]):first").prop("selected", "selected");
          //$('#sala').removeAttr('selected').find('option:first').attr('selected', 'selected');
        })
      })
    </script>

</html>