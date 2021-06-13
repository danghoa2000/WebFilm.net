<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Episode;
use App\Models\Film;
use Illuminate\Support\Facades\Session;
use Config;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hero = Film::select(
            'id',
            'img_background',
            'img',
            'name',
            'luot_xem'
        )->where('flag_delete', ACTIVE)->get()->random(5);

        $new_film = Film::select(
            'id',
            'name',
            'luot_xem',
            'img',
        )->where('flag_delete', ACTIVE)
        ->orderBy('updated_at', 'DESC')
        ->groupBy(
            'id',
            'name',
            'luot_xem',
            'img'
        )->take(9)->get();

        $comment = Comment::select(
            'id_film',
            DB::raw('COUNT(comment.id_film) as comment')
        )->groupBy('id_film')->get();

        $ep1 = Episode::select(
            'id_film',
            DB::raw("MAX(`updated_at`) as updated_at")
        )->groupBy('id_film')->get();

        $ep = [];
        foreach ($ep1 as $key ) {
            $ep2 = Episode::select(
                'id_film',
                'tap_so'
            )->where('id_film', $key->id_film)
            ->where('updated_at', $key->updated_at)
            ->first();

            $ep[$ep2->id_film] = $ep2->tap_so;
        }

        $appreciated = Film::select(
            'id',
            'name',
            'luot_xem',
            'img',
        )->where('flag_delete', ACTIVE)
        ->orderBy('IMDb', 'DESC')
        ->take(6)->get();

        return view('user.Home',
            [
                'hero' => $hero,
                'new_film' => $new_film,
                'comment' => $comment,
                'ep' => $ep,
                'appreciated' => $appreciated
            ]
        );
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

        return redirect()->back();
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
        )->where('flag_delete', ACTIVE)
        ->where('name', 'like', "%$value%")->take(5)->get();

        return $data;
    }
}
