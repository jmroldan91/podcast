window.onload=ini;

function ini(){
    var del = document.getElementById("del");
    if(del!==null){
        del.addEventListener('click', function(e){
            var r = confirm("¿Está seguro de borrar la cancion?");
            if (r !== true) {
                e.preventDefault();
            }         
        });
    }
    var audios = document.getElementsByTagName('audio');
    for(var i=0; i<audios.length;i++){
        audios[i].addEventListener('play', manejaPlay);
        audios[i].addEventListener('pause', manejaPause);
    }
}
function manejaPlay(e){    
    var fila = this.parentNode.parentNode;
    fila.classList.add('success');
    var nombre = fila.getElementsByTagName('td')[1].textContent;
    var imgClone = fila.getElementsByTagName('td')[0].getElementsByTagName('img')[0].cloneNode(true);
    imgClone.setAttribute('width','100%')
    var repro = document.getElementById("enCurso");
    repro.classList.add('text-center');
    repro.innerHTML='<h3> Reroduciendo...</h3><hr/><h5>'+nombre+'</h5><hr/>';
    repro.appendChild(imgClone);
}
function manejaPause(e){    
    var fila = this.parentNode.parentNode;
    fila.classList.remove('success');
    var repro = document.getElementById("enCurso");
    repro.innerHTML='';
}

