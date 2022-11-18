var btnDis = document.querySelector('#btnDis');

btnDis.onclick = function() {

	var div = document.querySelector('#a2hs');
    div.style.display = 'none';

}

let deferredPrompt;
const a2hs = document.querySelector('#a2hs');
const btnAdd = document.querySelector('#btnAdd');

this.addEventListener('beforeinstallprompt', (e) => {
    
    console.log('beforeinstallprompt...');

    a2hs.style.display = 'block';
    e.preventDefault();
    deferredPrompt = e;

    btnAdd.addEventListener('click', (e) => {
        
        console.log("Clicado...");

        a2hs.style.display = 'none';

        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {

                //aqui vc pode enviar informações de aceite para uma URL ou Analytics
                console.log('Instalação aceita');
                
            } else {
                console.log('Instalação não aceita');
            }
            deferredPrompt = null;
        });
    });
});


//se esta instalado
window.addEventListener('appinstalled', (evt) => {
  console.log('a2hs instalado');
  a2hs.style.display = 'none';
});