<form action="?controller=posts&action=create_post" method="post" enctype="multipart/form-data">
    
    <table>
        <tr>
            <td>Title</td>
            <td><input type='text' id='title' name='title'/></td>
        </tr>
        <tr>
            <td>Author</td>
            <td><input type='text' id='author' name='author'/></td>
        </tr>
 
        <tr>
            <td>Content</td>
            <td><textarea name='content' id='content'></textarea></td>
        </tr>
        <tr>
            <td>Image</td>
            <td><input type="file" name="image" /></td>
        </tr>
        <tr>
            <td>
                <br>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>  
</form>