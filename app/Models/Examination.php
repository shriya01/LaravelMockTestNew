<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Examination extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'examination_name','is_deleted'
    ];

     	/**
     * Get the comments for the blog post.
     */
    public function mocktests()
    {
        return $this->hasMany('App\Models\MockTest');
    }
}
