<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id','post_name','post_description',
    ];

    public function getPosts()
    {
        return DB::table('posts')
               ->join('categories', 'posts.category_id', '=', 'categories.id')
               ->select('posts.category_id','post_name','category_name','categories.id')
               ->get();
    }
}
