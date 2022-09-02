<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addComment(CommentRequest $request)
    {
        Comment::create([
            'film_id' => $request->filmid,
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'comment' => $request->comment,
        ]);

        return response()->json(['data'=> 'Comment Added'], 200);
        
    }
    

}
