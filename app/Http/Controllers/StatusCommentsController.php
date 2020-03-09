<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource;
use App\Models\Comment;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusCommentsController extends Controller
{

    public function store(Status $status){

        $status = Comment::create([
            'user_id' => auth()->id(),
            'status_id' => $status->id,
            'body' => request('body')
        ]);

    }
}
