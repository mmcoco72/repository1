<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use App\Category;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index(Post $post)
    {
        //クライアントインスタンス生成生成
        $client = new \GuzzleHttp\Client();
        //GET通信のURL
        $url = 'https://teratail.com/api/v1/questions';
        
        //リクエスト送信と返却データの取得
        //Bearerトークンにアクセストークンを指定、認証
        $response = $client->request(
            'GET',
            $url,
            ['Bearer' => config('services.teratail.token')]
            );
            
        //API通信で取得したデータはjson形式→PHPファイル適応の連想配列に
        $questions = json_decode($response->getBody(), true);
        
        //index bladeに渡す
        return view('posts/index')->with([
            'posts' => $post->getPaginateByLimit(),
            'questions' => $questions['questions'],
            ]);
    }  
    /**
 * 特定IDのpostを表示する
 *
 * @params Object Post // 引数の$postはid=1のPostインスタンス
 * @return Reposnse post view
 */
    public function show(Post $post)
    {
        return view('posts/show')->with(['post' => $post]); //該当idのpostインスタンスをviewに
    }
    
    public function create(Category $category)
    {
        return view('posts/create')->with(['categories' => $category->get()]);;
    }   //create.phpにある'categories'定義
    
    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('posts/edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}


  