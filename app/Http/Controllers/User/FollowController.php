<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Episode;
use App\Models\Film;
use App\Models\ViewsFromTimeToTime;
use App\Models\YourFilm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        $user = Auth::guard('web')->user();
        $data = Film::join('your_film', 'your_film.id_film', '=', 'film.id')
            ->where('film.flag_delete', ACTIVE)
            ->where('your_film.id_user', $user->id)
            ->select(
                'film.id',
                'film.img',
                'film.name',
                'film.luot_xem'
            )->orderBy('film.updated_at', 'DESC')->Paginate(15);

        return view('user.FilmUserFollow',
            [
                'comment' => $comment,
                'ep' => $ep,
                'data' => $data
            ]
        );
    }

    /**
     * Delete the specified movie from the watchlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function destroy(Request $request)
    {
        $user = Auth::guard('web')->user();
        YourFilm::where('id_user', $user->id)->where('id_film', $request->id)->delete();
        return "true";
    }

}
