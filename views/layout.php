<!--En el layout importo los estilos y divido el header y el footer del contenido. Todo lo pongo bajo un div content para pdoer darle estilo-->
<DOCTYPE html>
    <html>
        <head>
            <style type="text/css" media="all">@import "/M07/blog_php_mvc/styles/style.css";</style>
            <title>BLOG IVAN</title>
        </head>
        <body>
            <div class="content">
                <?php require_once('header.php'); ?>
                <?php require_once('routes.php'); ?>
                <?php require_once('footer.php'); ?>
            </div>
        </body>
    </html>

