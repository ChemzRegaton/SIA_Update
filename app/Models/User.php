<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class User extends Model{
    protected $table = 'sia';
    // column sa table
    protected $fillable = [
    'username', 'password', 'email',
    ];

    public $timestamps = false;

    protected $primaryKey = 'userid';

    protected $hidden = [
        'password',  
    ];

    

}