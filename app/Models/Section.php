<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_name','is_deleted'
    ];

     /**
     * Get the comments for the blog post.
     */
    public function mocktests()
    {
        return $this->hasMany('App\Models\MockTest');
    }
}
