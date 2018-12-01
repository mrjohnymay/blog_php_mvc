<?php

class Post {

    // definimos tres atributos
    // los declaramos como públicos para acceder directamente $post->author
    public $id;
    public $title;
    public $author;
    public $content;
    public $created;
    public $modified;
    //public $image

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

        // creamos una lista de objectos post y recorremos la respuesta de la
        //consulta
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
        return new Post($post['id'], $post['title'], $post['author'], $post['content'], $post['created'], $post['modified'], $post['image']);
    }
    
    public static function update() {
        $id=$_POST['id'];
        $title=$_POST['title'];
        $author=$_POST['author'];
        $content=$_POST['content'];
        $image=$_POST['image'];

        $db = Db::getInstance();
        $image=htmlspecialchars(strip_tags($_FILES['image']['tmp_name'])); 
     
        $image=!empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";

        $req = $db->prepare("Update posts set title = :title, author = :author, content = :content, modified = CURRENT_TIMESTAMP(), image = :image where id=:id");
        $req->bindParam(':id', $id);
        $req->bindParam(':title', $title);
        $req->bindParam(':author', $author);
        $req->bindParam(':content', $content);
        $req->bindParam(':image', $image);
        
        if($req->execute()){
            echo "<br>Post actualizado";
                // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        //echo uploadPhoto();
        
        $result_message="";
 
        // now, if image is not empty, try to upload the image
        if($image){

            // sha1_file() function is used to make a unique file name
            $target_directory = "uploads/";
            $target_file = $target_directory . $image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

            // error message is empty
            $file_upload_error_messages="";
            // make sure that file is a real image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check!==false){
            // submitted file is an image
            }else{
                $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
            }

            // make sure certain file types are allowed
            $allowed_file_types=array("jpg", "jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }

            // make sure file does not exist
            if(file_exists($target_file)){
                $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
            }

            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['image']['size'] > (1024000)){
                $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
            }

            // make sure the 'uploads' folder exists
            // if not, create it
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }
                    // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="<div>Unable to upload photo.</div>";
                        $result_message.="<div>Update the record to upload photo.</div>";
                    $result_message.="</div>";
                }
            }

            // if $file_upload_error_messages is NOT empty
            else{
                // it means there are some errors, so show them to user
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
        $title=$_POST['title'];
        $author=$_POST['author'];
        $content=$_POST['content'];
        $image=!empty($_FILES["image"]["name"])

        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";

        $db = Db::getInstance();

        $req = $db->prepare("INSERT into posts(title, author, content, created, modified, image) VALUES (:title, :author, :content, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), :image)");
        $req->bindParam(':title', $title);
        $req->bindParam(':author', $author);
        $req->bindParam(':content', $content);
        $req->bindParam(':image', $image);
        
        if($req->execute()){
            echo "<br>Post creado";
            // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        //echo uploadPhoto();
        
        $result_message="";
 
        // now, if image is not empty, try to upload the image
        if($image){

            // sha1_file() function is used to make a unique file name
            $target_directory = "uploads/";
            $target_file = $target_directory . $image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

            // error message is empty
            $file_upload_error_messages="";
            // make sure that file is a real image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check!==false){
            // submitted file is an image
            }else{
                $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
            }

            // make sure certain file types are allowed
            $allowed_file_types=array("jpg", "jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }

            // make sure file does not exist
            if(file_exists($target_file)){
                $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
            }

            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['image']['size'] > (1024000)){
                $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
            }

            // make sure the 'uploads' folder exists
            // if not, create it
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }
                    // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="<div>Unable to upload photo.</div>";
                        $result_message.="<div>Update the record to upload photo.</div>";
                    $result_message.="</div>";
                }
            }

            // if $file_upload_error_messages is NOT empty
            else{
                // it means there are some errors, so show them to user
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
        $db = Db::getInstance();
        $req = $db->prepare('DELETE FROM posts WHERE id = '.$_GET['id']);
        if($req->execute()){
            echo "<br>Post eliminado";
        } else {
            echo "<br>No se ha podido eliminar el post";
        }
    }
}
?>