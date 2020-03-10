<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;

class CommentsLikesController extends Controller
{
    public function store(Comment $comment){
        $comment->likes()->create([
            'user_id' => auth()->id(),
        ]);

//        Like::create([
//            'user_id' => auth()->id(),
//            'likeable_id' => $comment->id,
//            'likeable_type' => get_class($comment)
//        ]);
    }

    public function destroy(Comment $comment){
        $comment->likes()->where([
            'user_id' => auth()->id(),
        ])->delete();

//        Like::where([
//            'user_id' => auth()->id(),
//            'likeable_id' => $comment->id,
//            'likeable_type' => get_class($comment)
//        ])->delete();
    }
}
