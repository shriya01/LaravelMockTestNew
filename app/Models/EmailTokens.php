<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EmailTokens extends Authenticatable
{
    use Notifiable;

    /** @var String $primaryKey
    *  This protected member contains talbe primary key
    */
    protected $table = 'email_tokens';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_token','email_type', 'status'
    ];
}