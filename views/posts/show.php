<p><strong>Post #<?php echo $post->id; ?></strong></p>
<p><strong>Title: </strong><?php echo $post->title; ?></p>
<p><strong>Autor: </strong><?php echo $post->author; ?></p>
<p><strong>Post: </strong><?php echo $post->content; ?></p>
<p><strong>Created: </strong><?php echo $post->created; ?></p>
<p><strong>Modified: </strong><?php echo $post->modified; ?></p>
<p><strong>Image: </strong><?php echo $post->image ? "<img src='uploads/{$post->image}' style='width:300px;' />" : "No image found."; ?></p>
<a href='?controller=posts&action=update&id=<?php echo $post->id; ?>'>Update</a>
<a href='?controller=posts&action=delete&id=<?php echo $post->id; ?>'>Delete</a>