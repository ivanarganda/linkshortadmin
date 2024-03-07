<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Redirect;

class Url extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
     protected $fillable = [
        'url',
        'short',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function redirects(){
        return $this->hasMany(Redirect::class);
    }

}
