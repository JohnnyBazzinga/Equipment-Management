const renderBotoes = async () => {

  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/servicos`)
  const servicos = await response.json()
  let strHtml = ``
 
  if (servicos[0].numElements > 0) {
    var cores=new Array ("bg-danger","bg-success","bg-info","bg-dark", "bg-secondary", "bg-warning")
    var i=0 
    for (const servico of servicos) {
      if (servico.Ativo==1){
        strHtml += `
                    <button type="button" onclick="window.location.href = 'http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/botoneira/confirma?s=${servico.id_LS}';" class="${cores[i]} btn-lg btn-danger btn-lg btn-block">
                      <h1>${servico.Nome}</h1>
                    </button>
                   `      
         i++
      if(i>5){
        i=0
      }
    }
    strHtml += ``

  }
  document.getElementById("botoes").innerHTML = strHtml

}
}
  
var n = `x01`

const lePedido = async (px,id_LS) => {

     // ProximoNumero(id_LS)
      //px=document.getElementById("px").innerHTML
  //sleep(2000);
      //console.log("aqui");
      //console.log(px);
      const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/add`, {
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                    },
                method: "POST",
                body: `numero=${px}&id_LS=${id_LS}`
            })
            //console.log(response);
 }

const ProximoNumero = async (id) => {
  // console.log("aaaa");


  const response = await fetch(`http://galeria.esmonserrate.org/finalista/2019/PAPsistemaTickets/public/pedido/${id}/numeroPedido`)
  const servicos = await response.json()
  // alert(id)
  n="x00";
  if (servicos[0].numElements > 0) {
    for (const servico of servicos) {
        n= `${servico.numPedido}`
    }
  }
  //console.log(n);
  document.getElementById("px").innerHTML = n
  lePedido(n,id)
}



        

