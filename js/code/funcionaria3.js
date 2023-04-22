const renderEspera2 = async (servico,id_F) => {
  // console.log("aaaa");
  //alert(id_F)
  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/${servico}/EmEspera`)
  const pedidos = await response.json()
  let strHtml = ` `   
  document.getElementById("utAguardar").innerHTML = pedidos[0].numElements
  if (pedidos[0].numElements > 0) {
  let linha=0
  let primeiro=""
    for (const pedido of pedidos) {
      if ((pedido.Resolvido==0)&&(pedido.id_F==1)){
        if (primeiro==""){
          primeiro=pedido.id_P
        }
        strHtml += `
                   ${pedido.Numero}<br>
                `   
      linha++
        if (linha==2){
          linha=0
           strHtml += ``
        }
     }  
   //console.log(strHtml);   
   document.getElementById("espera").innerHTML = strHtml 
      
   }    
    
 document.getElementById("chamar").setAttribute("onclick", "chamarPedido2("+primeiro+","+id_F+","+servico+",)" )
    
 }else{
   document.getElementById("espera").innerHTML = "Não há utentes à espera"
 }
 
}

const renderEspera = async (servico,id_F) => {
  // console.log("aaaa");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/${servico}/EmEspera`)
  const pedidos = await response.json()
  let strHtml = ` `   
  document.getElementById("utAguardar").innerHTML = pedidos[0].numElements
  if (pedidos[0].numElements > 0) {
  let linha=0
  let primeiro=""
    for (const pedido of pedidos) {
      if ((pedido.Resolvido==0)&&(pedido.id_F==1)){
        if (primeiro==""){
          primeiro=pedido.id_P
        }
        strHtml += `
                <h1><p class="bg-danger text-white">${pedido.Numero}</p></h1>
                `   
      linha++
        if (linha==2){
          linha=0
           strHtml += ``
        }
      }  
  //console.log(strHtml);
      
   document.getElementById("espera").innerHTML = strHtml 
    }
    
    document.getElementById("chamar").setAttribute("onclick", "chamarPedido("+primeiro+","+id_F+","+servico+",)" )
      
  } else{
    document.getElementById("espera").innerHTML = "Não há utentes à espera"
  }
}

const renderASerAtendido = async (funcionaria,id_LS) => {
  // console.log("aaaa");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/${funcionaria}/AtribuidosPorResolver`)
  const pedidos = await response.json()
  let strHtml = ``
 
  if (pedidos[0].numElements > 0) {
    for (const pedido of pedidos) {  
     document.getElementById("seratendido").innerHTML  = `
                                                              ${pedido.Numero}      
                                                          `
     document.getElementById("atendido").setAttribute("onclick", "encerrarPedido("+pedido.id_P+","+funcionaria+","+id_LS+")" )
    }    
    
  } else { 
      document.getElementById("seratendido").innerHTML  = `-`
      document.getElementById("atendido").setAttribute("onclick", "" )
    
  }       
     
  
}

const renderASerAtendido2 = async (funcionaria,id_LS) => {
  // console.log("aaaa");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/${funcionaria}/AtribuidosPorResolver`)
  const pedidos = await response.json()
  let strHtml = ``
 
  if (pedidos[0].numElements > 0) {
    for (const pedido of pedidos) {  
     document.getElementById("seratendido").innerHTML  = `
                                                              ${pedido.Numero}      
                                                          `
     document.getElementById("atendido").setAttribute("onclick", "encerrarPedido2("+pedido.id_P+","+funcionaria+","+id_LS+")" )
     document.getElementById("chamar").setAttribute("onclick", "" )
    }    
    
  } else { 
      document.getElementById("seratendido").innerHTML  = `-`
      document.getElementById("atendido").setAttribute("onclick", "" )
    
  }       
     
  
}

const renderResolvidos = async (funcionaria) => {
 //console.log("funcionaria");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/${funcionaria}/resolvidosDia`)
  const pedidos = await response.json()
  let strHtml = ` `
 
  if (pedidos[0].numElements > 0) {  
    for (const pedido of pedidos) {    
      console.log(pedido.Numero)
     strHtml += `<h1><p class="bg-success text-white">${pedido.Numero}</p></h1> `   
        }
      }   
   document.getElementById("resolvidos").innerHTML=strHtml
}

const renderResolvidos2 = async (funcionaria) => {
 //console.log("funcionaria");

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/${funcionaria}/resolvidosDia`)
  const pedidos = await response.json()
  let strHtml = ` `
  document.getElementById("resolvidosDia").innerHTML = pedidos[0].numElements
  if (pedidos[0].numElements > 0) {  
    for (const pedido of pedidos) {    
      //console.log(pedido.Numero)
     strHtml += `      
                ${pedido.Numero}<br> 
                `   
        }
      }   
   document.getElementById("resolvidos").innerHTML=strHtml
}

const encerrarPedido = async (id,id_F,id_LS) => {

     
      const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/${id}/encerrar`, {
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                    },
                method: "POST",
                body: `id=${id}`
            })
            //console.log(response);
      renderASerAtendido(id_F,id_LS)
      renderResolvidos(id_F)
      renderEspera(id_LS,id_F)
 }

const encerrarPedido2 = async (id,id_F,id_LS) => {

     
      const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/${id}/encerrar`, {
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                    },
                method: "POST",
                body: `id=${id}`
            })
            //console.log(response);
      renderASerAtendido2(id_F,id_LS)
      renderResolvidos2(id_F)
      renderEspera2(id_LS,id_F)
 }

const chamarPedido = async (id,id_F,id_LS) => {

     
      const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/${id}/chamar`, {
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                    },
                method: "POST",
                body: `id=${id}&id_F=${id_F}`
            })
            renderEspera(id_LS,id_F)
    	      renderASerAtendido(id_F,id_LS)
 }

const chamarPedido2 = async (id,id_F,id_LS) => {


      const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/${id}/chamar`, {
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                    },
                method: "POST",
                body: `id=${id}&id_F=${id_F}`
            })
            document.getElementById("chamar").setAttribute("onclick", "" )
            renderEspera2(id_LS,id_F)
    	      renderASerAtendido2(id_F,id_LS)
  
 }

