<!--En esta vista se muestra una tabla con los datos del post y dos botones para actualizar o eliminar el post-->
<table>
    <tr>
        <td><p><strong>Post #<?php echo $post->id; ?></strong></p></td>
    </tr>
    <tr>
        <td><p><strong>Title: </strong><?php echo $post->title; ?></p></td>
    </tr>
    <tr>
        <td><p><strong>Autor: </strong><?php echo $post->author; ?></p></td>
    </tr>
    <tr>
        <td><p><strong>Post: </strong><?php echo $post->content; ?></p></td>
    </tr>
    <tr>
        <td><p><strong>Created: </strong><?php echo $post->created; ?></p></td>
    </tr>
    <tr>
        <td><p><strong>Modified: </strong><?php echo $post->modified; ?></p></td>
    </tr>
    <tr>
        <td><p><strong>Image: </strong><?php echo $post->image ? "<img src='uploads/{$post->image}' style='width:300px;' />" : "No image found."; ?></p></td>
    </tr>
</table>
<a href='?controller=posts&action=update&id=<?php echo $post->id; ?>'>Update</a>
<a href='?controller=posts&action=delete&id=<?php echo $post->id; ?>'>Delete</a>