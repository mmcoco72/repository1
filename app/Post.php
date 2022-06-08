<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use SoftDeletes;
    
    
     protected $fillable = [
        'title',
        'body',
        'category_id'
        ];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    public function getPaginateByLimit(int $limit_count = 5)
    {
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
   
    //Categoryに対するリレーション
    //「1対多」の関係なので単数系
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}


