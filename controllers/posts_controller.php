<?php

class PostsController {

    public function index() {
        // Guardamos todos los posts en una variable
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
    
    public function update(){
        $post = Post::find($_GET['id']);
        require_once('views/posts/update.php');
    }
    
    public function update_post(){
        Post::update();
    }
    
    public function create(){
        require_once('views/posts/create.php');
    }
    
    public function create_post(){
        Post::create();
    }
    
    public function delete(){
        Post::delete();
    }
}
?>