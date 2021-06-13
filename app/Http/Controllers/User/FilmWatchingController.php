<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Episode;
use App\Models\Film;
use App\Models\ViewsFromTimeToTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilmWatchingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @param  int  $episode
     * @return \Illuminate\Http\Response
     */
    public function index($id, $episode)
    {
        $episode2 = Episode::select(
            'id',
            'link',
            'tap_so',
            'id_film'
        )->where('id_film', $id)
        ->get();

        $watching = Episode::select(
            'id',
            'link',
            'tap_so',
            'id_film'
        )->where('id_film', $id)
        ->where('tap_so', $episode)
        ->first();

        return view('user.FilmWatching',
            [
                'episode' => $episode2,
                'watching' => $watching
            ]
        );
    }

    /**
     * Increase view for film.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function watch(Request $request)
    {
        $film = Film::select(
            'id',
            'luot_xem',
            'updated_at'
        )->where('id', $request->id)->first();

        $film->luot_xem = $film->luot_xem + 1;
        $old = $film->updated_at;
        $film->save();
        $film->updated_at = $old;
        $film->save();

        $today = Carbon::now()->format('Y-m-d');
        $view_day = ViewsFromTimeToTime::select('id','luot_xem')
            ->where('id_film', $request->id)
            ->whereDATE( DB::raw('DATE(created_at)'), $today)
            ->first();

        if ($view_day) {
            $view_day->luot_xem = $view_day->luot_xem + 1;
            $view_day->save();
        } else {
            $view_day = new ViewsFromTimeToTime();
            $view_day->luot_xem = 1;
            $view_day->id_film = $request->id;
            $view_day->role = 1;
            $view_day->save();
        }

        return "true";
    }
}
