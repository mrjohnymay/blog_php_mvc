<!--Esta vista muestra un formulario con una tabla con los datos del post que se pueden modificar. Se oculta el id para que no se pueda modificar pero se pueda usar la variable-->
<form action="?controller=posts&action=update_post" method="post" enctype="multipart/form-data">
    <table>
        <input type="hidden" id="id" name="id" value= "<?php echo $post->id; ?>"> 
        <tr>
            <td>Title</td>
            <td><input type='text' id='title' name='title' value="<?php echo $post->title; ?>"/></td>
        </tr>
        <tr>
            <td>Author</td>
            <td><input type='text' id='author' name='author' value="<?php echo $post->author; ?>"/></td>
        </tr>
        <tr>
            <td>Content</td>
            <td><textarea name='content' id='content'><?php echo $post->content; ?></textarea></td>
        </tr>
        <tr>
            <td>Image</td>
            <td><?php echo $post->image ? "<img src='uploads/{$post->image}' style='width:300px;' />" : "No image found.";?></td>
            <td>New Image</td>

            <td><input type="file" name="image"/></td>
        </tr>
        <tr>
            <td>
                <br>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>  
</form>