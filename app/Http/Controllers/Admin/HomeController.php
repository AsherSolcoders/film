<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Models\Comment;
use App\Models\Film;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $films = Film::with(['genres'])->get();
        return view('admin.home',compact('films'));
    }

    public function users()
    {
        $users = User::get();
        return view('admin.users',compact('users'));
    }

    public function genres()
    {
        $genres = Genre::get();
        return view('admin.genres',compact('genres'));
    }

    public function addGenres(GenreRequest $request)
    {
        
        Genre::create(['name'=>$request->name]);

        return redirect()->back()->with('status','Genre Added');
    }

    public function comments($filmid = ''){
        $comments = Comment::with('user');
        if( $filmid ){
           $comments= Comment::with(['user','film'])->where('film_id',$filmid)->get();
        }
        else{
            $comments= Comment::with(['user','film'])->get();
        }
        return view('admin.comments',compact('comments'));
    }
}
