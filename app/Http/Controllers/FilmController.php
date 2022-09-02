<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmRequest;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( $request->ajax() ){
            $film = Film::with(['genres','comments'])->paginate(1);
            return response()->json($film);
        }
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::get();
        $countries = Country::get();
        return view('create_film',compact('genres', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilmRequest $request)
    {
        $fileName = time().'.'.$request->photo->extension();  
   
        $request->photo->move(public_path('img'), $fileName);
        $film = Film::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'rating' => $request->rating,
            'release_date' => $request->release_date,
            'country' => $request->country,
            'ticket' => $request->ticket,
            'photo' => $fileName,
        ]);

        $film->genres()->attach($request->genres);

       return redirect()->route('films.show',$film->slug)->with('message', 'Film saved Successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $film = Film::with(['genres'])->where('slug',$slug)->first();
        return view('film_detail',compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getComments(Request $request){
        $comments = Comment::where('film_id',$request->filmid)->get();
        return response()->json($comments);
    }
}
