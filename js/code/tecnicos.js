const renderTecnicos = async () => {

  const response = await fetch(`http://stock.alunos.esmonserrate.org/public/equipamentos/listarTecnicos`)
  const servicos = await response.json()
  let strHtml = ``;


  if (servicos[0].numElements > 0) {
    for (const servico of servicos) {
         strHtml +=`
                      <tr data-id=${servico.idUser}>
                        <td>${servico.idUser}</td>
                        <td>${servico.nome}</td>
                        <td>${servico.reparacoes}</td>
                      </tr>
  
                   `
       }
    }
  document.getElementById("tecnicos").innerHTML = strHtml
}


const renderatribuirNiveis = async () => {

  const response = await fetch(`http://stock.alunos.esmonserrate.org/public/admin/atribuir/niveis`)
  const servicos = await response.json()
  let strHtml = ``;


  if (servicos[0].numElements > 0) {
    for (const servico of servicos) {
         strHtml +=`
                      <tr data-id=${servico.nivel}>
                        <td>${servico.idUser}</td>
                        <td>${servico.nome}</td>
                        <td>${servico.email}</td>
                        <td>${servico.nivel}</td>
                          <td><a class="btn btn-lg info"><i class="material-icons">add_chart</i></a></td>
                      </tr>
  
                   `
       }
    }
  document.getElementById("listarNiveis").innerHTML = strHtml
    $(document).ready(function() {
    $(".info").click(function(){
      var linha= $(this).closest("tr");
      $("#idNivel").val(linha.data("id"));
      $("#desc").html(linha.find("td").eq(1).html());
      $("#mdlniveis").modal("show");
    });
  });
}

