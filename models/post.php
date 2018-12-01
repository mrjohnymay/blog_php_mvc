<?php

class Post {

    // definimos los atributos
    // los declaramos como públicos para acceder directamente
    public $id;
    public $title;
    public $author;
    public $content;
    public $created;
    public $modified;
    
    //En este constructor, añadimos los atributos a la clase
    public function __construct($id, $title, $author, $content, $created, $modified, $image) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->content = $content;
        $this->created = $created;
        $this->modified = $modified;
        $this->image = $image;
    }

    public static function all() {
        $list = [];
        $db = Db::getInstance(); //devuelve la conexion a la base de datos
        $req = $db->query('SELECT * FROM posts');

        // creamos una lista de objectos post y recorremos la respuesta de la consulta
        foreach ($req->fetchAll() as $post) {
            $list[] = new Post($post['id'], $post['title'], $post['author'], $post['content'], $post['created'], $post['modified'], $post['image']);
        }
        return $list;
    }

    public static function find($id) {
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
        // preparamos la sentencia y reemplazamos :id con el valor de $id
        $req->execute(array('id' => $id));
        $post = $req->fetch();
        //devolvemos los datos de un post
        return new Post($post['id'], $post['title'], $post['author'], $post['content'], $post['created'], $post['modified'], $post['image']);
    }
    
    public static function update() {
        //recogemos los datos del formulario
        $id=$_POST['id'];
        $title=$_POST['title'];
        $author=$_POST['author'];
        $content=$_POST['content'];
        $image=$_POST['image'];

        $db = Db::getInstance();
        //preparamos la imagen
        $image=htmlspecialchars(strip_tags($_FILES['image']['tmp_name'])); 
     
        $image=!empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
        
        //Hacemos el update con los datos del form
        $req = $db->prepare("Update posts set title = :title, author = :author, content = :content, modified = CURRENT_TIMESTAMP(), image = :image where id=:id");
        $req->bindParam(':id', $id);
        $req->bindParam(':title', $title);
        $req->bindParam(':author', $author);
        $req->bindParam(':content', $content);
        $req->bindParam(':image', $image);
        
        if($req->execute()){
            echo "<div class='success'><br>Post actualizado</div>";
            
            //Esta parte esta extraida de la práctica anterior. Intenté hacerlo en un método a parte pero no pude pasar el valor de la imagen. Es por eso que esta en la función.
            $result_message="";
            if($image){
                $target_directory = "uploads/";
                $target_file = $target_directory . $image;
                $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

                $file_upload_error_messages="";
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check!==false){
                }else{
                    $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
                }

                $allowed_file_types=array("jpg", "jpeg", "png", "gif");
                if(!in_array($file_type, $allowed_file_types)){
                    $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
                }

                if(file_exists($target_file)){
                    $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
                }

                if($_FILES['image']['size'] > (1024000)){
                    $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
                }

                if(!is_dir($target_directory)){
                    mkdir($target_directory, 0777, true);
                }
                if(empty($file_upload_error_messages)){
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                    }else{
                        $result_message.="<div class='alert alert-danger'>";
                            $result_message.="<div>Unable to upload photo.</div>";
                            $result_message.="<div>Update the record to upload photo.</div>";
                        $result_message.="</div>";
                    }
                }

                else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="{$file_upload_error_messages}";
                        $result_message.="<div>Update the record to upload photo.</div>";
                    $result_message.="</div>";
                }
                    }

                    echo $result_message;
        } else {
            echo "<br>No se ha actualizado el post";
        }
    }
    
    public static function create() {
        //Se recogen los datos del formulario
        $title=$_POST['title'];
        $author=$_POST['author'];
        $content=$_POST['content'];
        //Se preparan los datos de la imagen para poder insertarla
        $image=!empty($_FILES["image"]["name"])

        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";

        $db = Db::getInstance();

        $req = $db->prepare("INSERT into posts(title, author, content, created, modified, image) VALUES (:title, :author, :content, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), :image)");
        $req->bindParam(':title', $title);
        $req->bindParam(':author', $author);
        $req->bindParam(':content', $content);
        $req->bindParam(':image', $image);
        
        if($req->execute()){
            echo "<div class='success'><br><h3>Post creado</h3></div>";
        //Esta parte esta extraida de la práctica anterior. Intenté hacerlo en un método a parte pero no pude pasar el valor de la imagen. Es por eso que esta en la función.
        $result_message="";
 
        if($image){

            $target_directory = "uploads/";
            $target_file = $target_directory . $image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

            $file_upload_error_messages="";
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check!==false){
            }else{
                $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
            }

            $allowed_file_types=array("jpg", "jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }

            if(file_exists($target_file)){
                $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
            }

            if($_FILES['image']['size'] > (1024000)){
                $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
            }

            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }
            if(empty($file_upload_error_messages)){
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                }else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="<div>Unable to upload photo.</div>";
                        $result_message.="<div>Update the record to upload photo.</div>";
                    $result_message.="</div>";
                }
            }

            else{
                $result_message.="<div class='alert alert-danger'>";
                    $result_message.="{$file_upload_error_messages}";
                    $result_message.="<div>Update the record to upload photo.</div>";
                $result_message.="</div>";
            }
                }
                echo $result_message;
        } else {
            echo "<br>No se ha creado el post";
        }
    }
    
     public static function delete() {
        //Eliminamos una entrada con el delete
        $db = Db::getInstance();
        $req = $db->prepare('DELETE FROM posts WHERE id = '.$_GET['id']);
        if($req->execute()){
            echo "<div class='success'><br>Post eliminado</div>";
        } else {
            echo "<br>No se ha podido eliminar el post";
        }
    }
}
?>