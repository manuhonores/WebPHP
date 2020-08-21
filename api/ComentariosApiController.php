<?php
    require_once("./models/comentariosModel.php");
    require_once("./api/ApiController.php");
    require_once("./api/JSONView.php");

    class ComentariosApiController extends ApiController{
    
        public function getComentarios($params = null) {
            $comentarios = $this->model->getComentarios();
            $this->view->response($comentarios, 200);
        }

        public function getComentariosPelicula($params = null) {
            $id = $params[':ID'];
            $order = $_GET['order'];
            $comentarios = $this->model->getComentariosPelicula($id, $order);
            $this->view->response($comentarios, 200);
        }
        
        public function deleteComentarioIdPeli($params = null){
            $id = $params[':ID'];
            $comentarios = $this->model->deleteComentarioPeli($id);
            $this->view->response($comentarios, 200);
        }

        public function getComentario($params = null) {
            // obtiene el parametro de la ruta
            $id = $params[':ID'];
            
            $comentario = $this->model->getComentarioId($id);
            
            if ($comentario) {
                $this->view->response($comentario, 200);   
            } else {
                $this->view->response("No existe el comentario con el id={$id}", 404);
            }
        }

        public function deleteComentario($params = []) {
            $comentario_id = $params[':ID'];

            $comentario = $this->model->getComentarioId($comentario_id);

            if ($comentario) {
                $this->model->borrarComentario($comentario_id);
                $this->view->response("comentario id=$comentario_id eliminada con éxito", 200);
            }
            else 
                $this->view->response("comentario id=$comentario_id not found", 404);
        }

        public function addComentario($params = []) {     
            $comentario = $this->getData(); // la obtengo del body

            // inserta la comentario
            $comentarioId = $this->model->insertarComentario($comentario->id_usuario, $comentario->id_pelicula, $comentario->comentario, $comentario->puntuacion);

            // obtengo la recien creada
            $comentarioNuevo = $this->model->getComentarioId($comentarioId);
            
            if ($comentarioNuevo)
                $this->view->response($comentarioNuevo, 200);
            else
                $this->view->response("Error al insertar comentario", 500);

        }

        public function getPromedio($params = null) {
            $id = $params[':ID'];
            $prom = $this->model->getPromedio($id);
            $this->view->response($prom, 200);
        }
}

