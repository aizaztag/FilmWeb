<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{

    /**
     * @return array
     */
    public function index()
    {
        // all films
        $films = Film::all()->toArray();
        return array_reverse($films);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        // store film
        $film = new Film([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'release_date' => $request->input('release_date'),
            'rating' => $request->input('rating'),
            'ticket_price' => $request->input('ticket_price'),
            'country' => $request->input('country'),
            'genre' => $request->input('genre'),
            'photo' => $request->input('image'),
        ]);
        $film->save();
        return response()->json('The film successfully added');
    }

    /**
     * @param $slug
     */
    public function edit($slug)
    {
        $data = array();
        $data['login'] = false;
        /*view film*/
        $film = Film::where('slug' , $slug)->first()->toArray();
        $data['item'] = $film;
        if(Auth::check())
        {
            $data['login'] = true; //user is logged-in
        }
        echo  json_encode($data);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        // update film
        $film = Film::find($id);
        $film->update($request->all());
        return response()->json('The film successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        // delete film
        $film = Film::find($id);
        $film->delete();
        return response()->json('The film successfully deleted');
    }

}
