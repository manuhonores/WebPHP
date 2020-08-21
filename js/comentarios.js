"use strict";

document.addEventListener("DOMContentLoaded", function(){
    
    // event listeners
    
    let admin = document.getElementById("admin");

    let form = document.getElementById("form-comentarios");
        if (form != null){
            form.addEventListener('submit', addComentario);
        }
    // define la app Vue
    let app = new Vue({
        el: "#template-vue-comentarios",
        data: {
            subtitle: "Estas tareas se renderizan desde el cliente usando Vue.js",
            comentarios: [], 
            user: {},
            prom: [],
            auth: true
        },
        methods: {
            del: function(id_comentario){
                eliminar(id_comentario);
            }
          }
    });
    
    if(admin != null) {
        let aux = {
            "admin" : "true"
        }
        app.user = aux;
    }
    /**
     * Obtiene la lista de tareas de la API y las renderiza con Vue.
     */
    let idPeli = document.getElementById("cargaVerMas").value; //Obtengo el id de la pelicula
    
    function getComentarios(id) {
        console.log("entro get");
        let orden = document.getElementById("orden").value;
        fetch("../api/peliculas/" + id + "/comentarios/" + "?order=" + orden)
        // fetch("../api/comentarios/" + id + "?order=" + orden)
        .then(response => response.json())
        .then(comentarios => {
            app.comentarios = comentarios;
        })
        .catch(error => console.log(error));
    }

    let select = document.getElementById("orden");
    select.addEventListener("change", function(){
        console.log(select.value);
        getComentarios(idPeli);
    })

    function getPromedio(id) {
        fetch("../api/peliculas/" + id + "/promedio")
        .then(response => response.json())
        .then(promedio => {
            app.prom = promedio;
        })
        .catch(error => console.log(error));
    }

    /**
     * Inserta una tarea usando la API REST.
     */
    function addComentario(e) {
        e.preventDefault();
        
        let data = {
            comentario:  document.querySelector("textarea[name=comentario]").value,
            puntuacion:  document.querySelector("#selec option:checked").value,
            id_usuario:  document.querySelector("input[name=id_usuario]").value,
            id_pelicula:  document.querySelector("input[name=id_pelicula]").value
        }

        fetch('../api/comentarios', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},       
            body: JSON.stringify(data) 
        })
        .then(response => {
            getComentarios(idPeli);
            getPromedio(idPeli);
        })
        .catch(error => console.log(error));
    }

    

    function eliminar(id) {
        event.preventDefault();
        let idComent = id;
    
        fetch('../api/comentarios/' + idComent, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/json'},
        })
        .then(response => {
            getComentarios(idPeli);
            getPromedio(idPeli);
        })
        .catch(err => console.log(err));
    }


    
    
    // obtiene los comentarios al inicio
    getComentarios(idPeli);
    getPromedio(idPeli);
    console.log("despues del get");

})
