let elim = document.querySelectorAll(".btn-eliminar");
    console.log(elim);
    if (elim!=null){
        for(let i = 0; i<elim.length; i++){
            elim[i].addEventListener("click", function(){
                let idPeli= elim[i].getAttribute("id");
                console.log(idPeli);
                fetch('api/pelicula/'+idPeli+'/comentarios',{
                    method: 'DELETE',
                    headers: {'Content-Type': 'application/json'},
                });
            })
        }
    }