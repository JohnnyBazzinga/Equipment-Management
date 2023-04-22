const renderArtigos = async (id) => {
  // console.log("aaaa");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/artigos/${id}/show`)
  const lj = await response.json()
  let strHtml = ` `
 
  if (lj[0].numElements > 0) {

    for (const artigo of lj) {
    
        strHtml += `
                    <h1>${artigo.titulo}</h1>
                    <p>${artigo.texto}</p>
                   `
 
      
      
    }
    strHtml += ``

  }
  //console.log(strHtml);
  document.getElementById("artigos").innerHTML = strHtml

}

const renderServicos = async () => {
  // console.log("aaaa");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/servicos`)
  const servicos = await response.json()
  let strHtml = ` `
 
  if (servicos[0].numElements > 0) {

    for (const servico of servicos) {
      if (servico.Ativo==1){
        strHtml += `<div class="row ">
                      <div class="col-sm-8 fundo " ><h2>${servico.Nome}</h2></div>
                      <div class="col-sm-2 fundo" ><h2 id="mesa${servico.id_LS}">Mesa2</h2></div>
                      <div class="col-sm-2 fundo" ><h2 id="senha${servico.id_LS}">C04</h2></div>
                    </div>`
      }
      
      
    }
    strHtml += ``

  }
  //console.log(strHtml);
  document.getElementById("servicos").innerHTML = strHtml

}

const renderMesas = async () => {
  // console.log("aaaa");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedidos/UltimoEmChamada`)
  const servicos = await response.json()
  console.log(servicos[0].Balcao)
  let strHtml = ` `
 
  if (servicos[0].numElements > 0) {
  console.log(servicos[0].numElements)
    for (const servico of servicos) {
      
        strHtml += `<div class="row ">
                      <div class="col-sm-8 fundo " ><h2>${servico.Servico}</h2></div>
                      <div class="col-sm-2 fundo" ><h2>${servico.Balcao}</h2></div>
                      <div class="col-sm-2 fundo" ><h2>${servico.Numero}</h2></div>
                    </div>`
      }
      
      
    
    strHtml += ``

  }
  //console.log(strHtml);
  document.getElementById("servicos").innerHTML = strHtml

}

const renderMesasOpt1 = async () => {
  // console.log("aaaa");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedidos/UltimoEmChamada`)
  const servicos = await response.json()
  //console.log(servicos[0].Balcao)
  let strHtml = ` `
 
  if (servicos[0].numElements > 0) {
    var cores=new Array ("bg-danger","bg-success","bg-info","bg-dark", "bg-secondary", "bg-warning")
    var i=0
  //console.log(servicos[0].numElements)
    for (const servico of servicos) {
      
        strHtml += `<div class="row ">
                      <div class="col-sm-6 alert ${cores[i]} text-right text-white pad " ><h2>${servico.Servico}</h2></div>
                      <div style="background-color:lavender;" class="col-sm-2 alert text-black text-center " ><h2>${servico.Balcao}</h2></div>
                      <div style="background-color:white;" class="col-sm-2 alert text-black text-center " ><h2>${servico.Numero}</h2></div>
                    </div>`
    i++
      if(i>5){
        i=0
      }
    }
      renderArtigos(3)
      
    
    strHtml += ``

  } else{
    renderArtigos(1)
  }
  //console.log(strHtml);
  document.getElementById("servicos").innerHTML = strHtml

}

const renderMesasOpt2 = async () => {
  // console.log("aaaa");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedidos/UltimoEmChamada`)
  const servicos = await response.json()
  console.log(servicos[0].Balcao)
  let strHtml = ` `
 
  if (servicos[0].numElements > 0) {
    var cores=new Array ("bg-info","bg-success")
    var i=0
  console.log(servicos[0].numElements)
    for (const servico of servicos) {
      
        strHtml += ` 
                      <div class="row ${cores[i]}"> 
                          <div class="col-sm-6" ><h4>Número</h4> </div>
                          <div class="col-sm-6" ><h4>Mesa</h4> </div>
                        </div>
                        <div class="row ${cores[i]}"> 
                          <div class="col-sm-6" ><h1>${servico.Numero}</h1></div>
                            <div class="col-sm-6" > <h1><span class="badge badge-pill badge-light">${servico.Balcao}</span> </h1> </div>
                        </div>
                   `    
        i++
      if(i>2){
        i=0
      }
      
      
      }
    
    strHtml += ``

  }
  //console.log(strHtml);
  document.getElementById("servicos").innerHTML = strHtml

}

const renderMesasOpt3 = async () => {
  // console.log("aaaa");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedidos/UltimoEmChamada`)
  const servicos = await response.json()
  console.log(servicos[0].Balcao)
  let strHtml = ` `
 
  if (servicos[0].numElements > 0) {
    var cores=new Array ("bg-dark","bg-primary")
    var i=0
  console.log(servicos[0].numElements)
    for (const servico of servicos) {
      
        strHtml += `  
                      <div class="row ${cores[i]} text-white" > 
                        <div class="col-sm-12" ><h1>${servico.Numero}</h1> <h4>${servico.Balcao}</h4> </div>
                      </div>
                      
                   `    
        
        i++
      if(i>2){
        i=0
      }
      
      
      }
    
    strHtml += ``

  }
  //console.log(strHtml);
  document.getElementById("servicos").innerHTML = strHtml

}







