
const renderFuncionariasAtivas = async () => {
  // console.log("aaaa");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/fornecedor/funcionariasAtivas`)
  const fornecedores = await response.json()
  let strHtml = ` `
 
    for (const fornecedor of fornecedores) {
     
        strHtml += `
                      ${fornecedor.numFuncionarias}
                   `
      
      
      
    }
    strHtml += ``

  
  //console.log(strHtml);
  document.getElementById("funcionariasAtivas").innerHTML = strHtml

}

const renderPedidosResolvidos = async (dia) => {
  // console.log("aaaa");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedidos/${dia}/pedidosResolvidos`)
  const pedidos = await response.json()
  let strHtml = ` `
   if(pedidos[0].numElements>0){
    for (const pedido of pedidos) {
     
        strHtml += `
                      ${pedido.numPedidos}
                   `
      
      
      
    }
   
    strHtml += ``
} else {
  strHtml = `0`
}
        
  //console.log(strHtml);
  document.getElementById("pedidosResolvidos").innerHTML = strHtml

}


const renderServicosAtivos = async () => {
  // console.log("aaaa");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/servico/servicosAtivos`)
  const servicos = await response.json()
  let strHtml = ` `
 
    for (const servico of servicos) {
     
        strHtml += `
                      ${servico.numServicos}
                   `
      
      
      
    }
    strHtml += ``

  
  //console.log(strHtml);
  document.getElementById("servicosAtivos").innerHTML = strHtml

}

const renderPedidosEmEspera = async () => {
  // console.log("aaaa");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/EmEsperaGeral`)
  const pedidos = await response.json()
  let strHtml = ` `
 
    for (const pedido of pedidos) {
     
        strHtml += `
                      ${pedido.numPedidos}
                   `
      
      
      
    }
    strHtml += ``

  
  //console.log(strHtml);
  document.getElementById("pedidosEmEspera").innerHTML = strHtml

}



