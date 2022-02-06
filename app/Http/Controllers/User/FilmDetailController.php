<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Episode;
use App\Models\Film;
use App\Models\FilmReview;
use App\Models\YourFilm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FilmDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = Film::select(
            'id',
            'name',
            'img',
            'IMDb',
            'so_danh_gia',
            'nam_sx',
            'mota',
            'luot_xem',
            'quoc_gia',
            'link_trailer'
        )->where('flag_delete', ACTIVE)
        ->where('id', $id)
        ->first();

        $might_like = Film::select(
            'id',
            'img_background',
            'img',
            'name',
            'luot_xem'
        )->where('flag_delete', ACTIVE)->get();

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

        return view('user.FilmDetail',
            [
                'data' => $data,
                'might_like' => $might_like,
                'ep' => $ep
            ]
        );
    }

    public function getComment(Request $request)
    {
        $comment = Comment::select(
            'id',
            'name',
            'avatar',
            'noi_dung',
            'created_at'
        )->where('id_film', $request->id)
        ->orderBy('created_at', 'DESC')
        ->Paginate(5);

        $data = [];

        foreach ($comment->items() as $item) {
            $data[] = [
                $item->avatar,
                $item->name,
                $item->noi_dung,
                $item->created_at->diffForHumans(Carbon::now())
            ];
        }

        return $data;
    }

    /**
     * Stores newly created comments in memory.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function storeComment(Request $request)
    {
        $comment = new Comment();
        $comment->name = $request->name;
        $comment->noi_dung = $request->noi_dung;
        $comment->avatar = $request->avatar;
        $comment->id_film = $request->id_film;
        $comment->save();

        return "true";
    }

    /**
     * Check and save user film rating information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return String
     */
    public function evaluate(Request $request)
    {
        $review_film = FilmReview::select('id')
        ->where('id_user', $request->user)
        ->where('id_film', $request->id_film)
        ->first();

        if ($review_film) {
            return "You have rated this movie before";
        } else {
            $film = Film::select(
                'id',
                'IMDb',
                'so_danh_gia',
                'updated_at'
            )->where('id', $request->id_film)
            ->first();
            $film->IMDb = ($film->IMDb * $film->so_danh_gia + $request->IMDb)/($film->so_danh_gia + 1);
            $film->so_danh_gia++;
            $old_updated_at = $film->updated_at;
            $film->save();
            $film->updated_at = $old_updated_at;
            $film->save();

            $review = new FilmReview();
            $review->id_film = (int)$request->id_film;
            $review->id_user = (int)$request->user;
            $review->save();

            return $film->IMDb;
        }
    }

    /**
     * add film to follow list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function addFollow(Request $request)
    {
        $follow = new YourFilm();
        $follow->id_user = Auth::guard('web')->user()->id;
        $follow->id_film = $request->id_film;
        $follow->save();

        return "true";
    }

    /**
     * delete the film's comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function destroyComment(Request $request)
    {
        Comment::where('id', $request->id)->delete();
        return "true";
    }
}
