const renderatribuirNiveis = async () => {

  const response = await fetch(`http://stock.alunos.esmonserrate.org/public/imei/listarClientes`)
  const servicos = await response.json()
  let strHtml = ``;


  if (servicos[0].numElements > 0) {
    for (const servico of servicos) {
         strHtml +=`
                      <tr>
                        <td>${servico.nif}</td>
                        <td>${servico.nome}</td>
                        <td>${servico.morada}</td>
                        <td>${servico.codPostal}</td>
                        <td>${servico.email}</td>
                        <td>${servico.contacto}</td>
                        <td>${servico.cidade}</td>
                        <td>${servico.empresa}</td>
                        <td>${servico.nacionalidade}</td>
                      </tr>
  
                   `
       }
    }
  document.getElementById("listarClientes").innerHTML = strHtml
}

const renderlistarObra = async () => {

  const response = await fetch(`http://stock.alunos.esmonserrate.org/public/imei/listarobra`)
  const servicos = await response.json()
  let strHtml = ``;


  if (servicos[0].numElements > 0) {
    for (const servico of servicos) {
         strHtml +=`
                      <tr>
                        <td>${servico.refObra}</td>
                        <td>${servico.idCliente}</td>
                        <td>${servico.descObra}</td>
                        <td>${servico.obs}</td>
                        <td>${servico.dataInicio}</td>
                        <td>${servico.dataPrevista}</td>
                        <td>${servico.dataFim}</td>
                          <td><a class="btn btn-lg info"><i class="material-icons">add_chart</i></a></td>
                      </tr>
  
                   `
       }
    }
  document.getElementById("listarObra").innerHTML = strHtml
      $(document).ready(function() {
    $(".info").click(function(){
      var linha= $(this).closest("tr");
      $("#idNivel").val(linha.data("id"));
      $("#desc").html(linha.find("td").eq(1).html());
      $("#mdlniveis").modal("show");
    });
  });
}

const renderListaMaterial = async () => {

  const response = await fetch(`http://stock.alunos.esmonserrate.org/public/imei/listarmaterial`)
  const servicos = await response.json()
  let strHtml = ``;


  if (servicos[0].numElements > 0) {
    for (const servico of servicos) {
         strHtml +=`
                      <tr data-id=${servico.produto}>
                        <td>${servico.produto}</td>
                        <td>${servico.referencia}</td>
                        <td>${servico.quantidade}</td>
                        <td>${servico.valorCompra}</td>
                        <td>${servico.valorVenda}</td>
                          <td><a class="btn btn-lg info"> <i class="material-icons">delete</i></a></td>
                      </tr>
  
                   `
       }
    }
  document.getElementById("listarMaterial").innerHTML = strHtml
  $(document).ready(function() {
    $(".info").click(function(){
      var linha= $(this).closest("tr");
      $("#idTarefa").val(linha.data("id"));
      $("#mdlTarefas").modal("show");
    });
  });
  
}

const renderListaOrcamento = async () => {

  const response = await fetch(`http://stock.alunos.esmonserrate.org/public/imei/listarorcamento`)
  const servicos = await response.json()
  let strHtml = ``;


  if (servicos[0].numElements > 0) {
    for (const servico of servicos) {
         strHtml +=`
                      <tr data-id=${servico.produto}>
                        <td>${servico.produto}</td>
                        <td>${servico.descProduto}</td>
                        <td>${servico.quantidade}</td>
                        <td>${servico.valorUnit}</td>
                        <td>${servico.valorTotal}</td>
                          <td><a class="btn btn-lg info"> <i class="material-icons">delete</i></a></td>
                      </tr>
  
                   `
       }
    }
  document.getElementById("listarOrcamento").innerHTML = strHtml
  $(document).ready(function() {
    $(".info").click(function(){
      var linha= $(this).closest("tr");
      $("#idTarefa").val(linha.data("id"));
      $("#mdlTarefas").modal("show");
    });
  });
  
}


