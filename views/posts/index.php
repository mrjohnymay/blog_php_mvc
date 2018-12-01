<a href='?controller=posts&action=create'>Crear post</a>
<h2>Listado de los posts:</h2>
<?php foreach ($posts as $post) { ?>
    <div class="posts">
        <p class="post"><?php echo $post->author; ?>
            <a href='?controller=posts&action=show&id=<?php echo $post->id; ?>'>Ver contenido</a></p>
    </div>
<?php }