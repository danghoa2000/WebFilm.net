<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Support\Facades\Session;
use Config;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hero = Film::all()->random(3);
        $new_film = Film::join('episode','episode.id_film','=','film.id')
        ->select(
            'film.id',
            'film.name',
            'film.luot_xem',
            'film.img',
        )->orderBy('film.updated_at', 'DESC')->groupBy('film.id','film.name','film.luot_xem','film.img')->take(9)->get();
        return view('user.Home',['hero' => $hero, 'new_film' => $new_film]);
    }

    /**
     * Change language.
     *
     * @param String $language
     * @return \Illuminate\Http\Response
     */
    public function changeLanguage($language)
    {
        if ($language) {
            Session::put('language', $language);
        }
        return redirect() -> back();

    }

    /**
     * Get the language you are using.
     *
     * @return String
     */
    public function getLanguage()
    {
        return Config::get('app.locale');
    }

    public function search($value)
    {
        $data = Film::select(
            'id',
            'img',
            'name',
        )-> where('flag_delete', 1)
        ->where('name','like',"%$value%") ->take(5) -> get();
        return $data;
    }

}
