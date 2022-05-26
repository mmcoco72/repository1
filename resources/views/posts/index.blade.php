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
        </form>
        <div class='posts'>
            @foreach ($posts as $post)
            
                <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <p class='body'>{{ $post->body }}</p>
                </div>
                
         
            
        <form action="/posts/{{ $post->id }}" id="form_delete" method="post" >
            @csrf
            @method('DELETE')
            <button type="submit" style="display:none">delete</button>
            
            <p class='delete'><button type="button"  onclick="return buttonClick(this);">delete</button></p>
            <script>
            function buttonClick() {
                'use strict';
                if (confirm('記事を削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById('form_delete').submit();
                }
            }        
            </script>
        </form>
            @endforeach
        </div>
         <div class='paginate'>
            {{ $posts->links() }}
        </div>
    </body>
</html>
