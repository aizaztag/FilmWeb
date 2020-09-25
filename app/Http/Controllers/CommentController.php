<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Film;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $film = Film::where('slug' , $request->input('slug'))->first()->toArray();
        $comments = Comment::where('film_id'  , $film['id'])->orderBy('id', 'DESC')->get();
        return response()->json($comments);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*store new comment*/
        $film = Film::where('slug' , $request->input('slug'))->first()->toArray();
        $comment = new Comment([
            'comment' => $request->input('comment'),
            'film_id' => $film['id']
        ]);
        $comment->save();
        /*get related comments on film detail page*/
        $comments = Comment::where('film_id'  , $film['id'])->orderBy('id', 'DESC')->get();
        return response()->json($comments);

    }

}
