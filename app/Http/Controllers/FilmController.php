<?php

namespace App\Http\Controllers;

use App\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{
    // all films
    public function index()
    {
        $films = Film::all()->toArray();
        return array_reverse($films);
    }

    // add film
    public function add(Request $request)
    {

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

    // edit film
    public function edit($slug)
    {

        $data = array();
        $data['login'] = false;
        $film = Film::where('slug' , $slug)->first()->toArray();
        $data['item'] = $film;
        if(Auth::check())
        {
            $data['login'] = true;
        }
        echo  json_encode($data);
    }

    // update film
    public function update($id, Request $request)
    {
        $film = Film::find($id);
        $film->update($request->all());

        return response()->json('The film successfully updated');
    }

    // delete film
    public function delete($id)
    {
        $film = Film::find($id);
        $film->delete();

        return response()->json('The film successfully deleted');
    }

    public function comment()
    {
            echo '<pre>' ; print_r('fddf'); die;
    }
}
