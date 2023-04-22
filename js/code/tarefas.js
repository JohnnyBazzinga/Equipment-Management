const renderTarefas = async (idUser) => {

  const response = await fetch(`http://stock.alunos.esmonserrate.org/public/equipamentos/tarefas`)
  const servicos = await response.json()
  let strHtml = ``;


  if (servicos[0].numElements > 0) {
    for (const servico of servicos) {
       if(servico.realizado == 0 ){ 
         strHtml +=`
                        <tr data-id=${servico.id}><td></td>
                          <td>${servico.tarefa}</td>
                          
                          <td><a class="btn btn-lg info"> <i class="material-icons">delete</i></a></td>
                        </tr>
  
                   `
       }
    }

  }
  document.getElementById("tarefas").innerHTML = strHtml
  $(document).ready(function() {
    $(".info").click(function(){
      var linha= $(this).closest("tr");
      $("#idTarefa").val(linha.data("id"));
      $("#desc").html(linha.find("td").eq(1).html());
      $("#mdlTarefas").modal("show");
    });
  });
}

