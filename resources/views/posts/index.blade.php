<!DOCTYPE html>
@extends('layouts.app')

@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
      {{ Auth::user()->name }}
    　<h1>Blog Name</h1>
        <p class='create'>[<a href='/posts/create'>create</a>]</p>
        <form>
        <div class='posts'>
            @foreach ($posts as $post)
            
                <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                     <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                    <p class='body'>{{ $post->body }}</p>
                </div>
        </form>
        <form action="/posts/{{ $post->id }}" id="form_delete" method="post" style="display:inline">
            @csrf
            @method('DELETE')
            <input type="button" style="display:none">
            <p class='delete'><button type="button"  onclick="return buttonClick(this);" >delete</button></p>
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
        <div>
    　       @foreach($questions as $question)
    　           <div> 
    　               <a href ="http://teratail.com/questions/{{ $question['id'] }}">
    　                   {{ $question['title'] }}
    　               </a>
    　           </div>
    　      @endforeach
    　  </div>
    </body>
</html>

@endsection
