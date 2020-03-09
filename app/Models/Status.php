<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function like(){
        // $this->likes()->create(['user_id' => auth()->id()]);
        $this->likes()->firstOrCreate(['user_id' => auth()->id()]);
    }
}
