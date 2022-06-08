<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
    　<h1>Blog Name</h1>
        <p class='create'>[<a href='/posts/create'>create</a>]</p>
        <form>
        <div class='posts'>
            @foreach ($posts as $post)
            
                <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <p class='body'>{{ $post->body }}</p>
                </div>
        </form>
        <a href="categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
            @endforeach
        </div>
         <div class='paginate'>
            {{ $posts->links() }}
        </div>
    </body>
    <div class="footer">
            <a href="/">戻る</a>
    </div>
</html>
