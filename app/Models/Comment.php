<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
}