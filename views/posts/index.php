<a href='?controller=posts&action=create'>Crear post</a>
<p><strong>Listado de los posts:</strong></p>
<?php foreach ($posts as $post) { ?>
    <p>
        <?php echo $post->author; ?>
        <a href='?controller=posts&action=show&id=<?php echo $post->id; ?>'>Ver contenido</a>
    </p>
<?php }