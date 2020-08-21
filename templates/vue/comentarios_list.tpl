{literal}
    <label>Ordenar: </label>
    <select id="orden" name="opcion">
        <option value="default" name="default">Default</option>
        <option value="puntuacion" name="puntuacion">Puntuación</option>
        <option value="nombre" name="nombre">Nombre</option>
        <option value="id_comentario" name="fecha">Fecha</option>
    </select>
    <section id="template-vue-comentarios">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            <h2><span class="badge badge-secondary">Promedio: {{prom.promedio}}</span></h2>
                        </div>
                    </div>
                    <table class="table table-image" id="centrar">
                    <thead>
                        <tr>
                            <th scope="col">Usuario</th>
                            <th scope="col">Comentario</th>
                            <th scope="col">Puntaje</th>
                            <th v-if = "user.admin == 'true'" scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr v-for="comentario in comentarios">
                                <td>{{comentario.nombre}}</td>
                                <td>{{comentario.comentario}}</td>
                                <td>{{comentario.puntuacion}}</td>
                                <td v-if = "user.admin == 'true'">
                                    <a href="#" @click="del(comentario.id_comentario)">Eliminar</a>
                                </td> 
                                
                            </tr>
                    </tbody>
                    </table>   
                </div>
            </div>
        </div>
    </section>
{/literal}

