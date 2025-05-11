<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>

<body>
    <div class="">
        <form action="/posts" method="POST">
            <h4>new post</h4>
            <textarea name="text" placeholder="post text"></textarea>
            <button>Upload</button>
        </form>
        <form action="/posts" method="GET">
            <h4>find post by id</h4>
            <input type="id" placeholder="post id" name="id">
            <button>find</button>
        </form>
    </div>
    <?php
    if (isset($post)) {
        echo "
        finded post $post->text
        ";
    }
    foreach ($posts as $post) {
        echo "
        <div>
        Post $post->id /" . addslashes($post->text) . "
        </div>
        ";
    }
    ?>
</body>

</html>