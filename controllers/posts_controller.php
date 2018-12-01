<?php

class PostsController {

    public function index() {
        // Guardamos todos los posts en una variable y vamos al index de los posts
        $posts = Post::all();
        require_once('views/posts/index.php');
    }

    public function show() {
        // esperamos una url del tipo ?controller=posts&action=show&id=x
        // si no nos pasan el id redirecionamos hacia la pagina de error, el id
        //tenemos que buscarlo en la BBDD
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        // utilizamos el id para obtener el post correspondiente
        $post = Post::find($_GET['id']);
        require_once('views/posts/show.php');
    }
    
    //Esta función lleva a la vista update donde tendremos un formulario con los campos del post con ese id
    public function update(){
        $post = Post::find($_GET['id']);
        require_once('views/posts/update.php');
    }
    
    //Esta función ejecuta la función update_post de Post donde actualiza los datos en la BBDD
    public function update_post(){
        Post::update();
    }
    
    //Esta función nos lleva al formulario para crear un nuevo post
    public function create(){
        require_once('views/posts/create.php');
    }
    
    //Esta función ejecuta la función create de Post que hace un insert en la BBDD
    public function create_post(){
        Post::create();
    }
    
    //Esta función ejecuta la función delete de Post que elimina un post
    public function delete(){
        Post::delete();
    }
}
?>