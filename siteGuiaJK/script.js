function abrirModal(){
    const modal = document.getElementById('janela-modal')
    modal.classList.add('abrir')

    modal.addEventListener('click',(e) => {
        if(e.target.id == 'fechar' || e.target.id == 'janela-modal' ){
            modal.classList.remove('abrir')
        }
    }) 
}

function abrirModal2(){
    const modale = document.getElementById('janela-modal2')
    modale.classList.add('abrir2')

    modale.addEventListener('click',(e) => {
        if(e.target.id == 'fechar' || e.target.id == 'janela-modal' ){
            modale.classList.remove('abrir2')
        }
    }) 
}
//document.getElementById('bugado').addEventListener('click', function() {
   // alert('Você saiu da sua conta com sucesso.');

   // window.location.href= "telaHome.php";

//});




