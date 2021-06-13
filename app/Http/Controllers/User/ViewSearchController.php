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

class ViewSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        $data = Film::join('category_film', 'category_film.id_film', '=', 'film.id')
            ->where('film.flag_delete', ACTIVE);

        if (isset($request->id_category)) {
            $data = $data->where('category_film.id_category', $request->id_category);
        }

        $data = isset($request->search) ? $data->where('film.name', 'like', "%$request->search%") : $data;
        $data = isset($request->nam_sx) ? $data->where('film.nam_sx', $request->nam_sx) : $data;
        $data = isset($request->quoc_gia) ? $data->where('film.quoc_gia', 'like', "%$request->quoc_gia%") : $data;

        $data = $data->select(
            'film.id',
            'film.img',
            'film.name',
            'film.luot_xem'
        );
        $data = isset($request->order) ? $data->orderBy($request->order, 'DESC') : $data;
        $data = $data->groupBy('film.id','film.img','film.name','film.luot_xem')->Paginate(15);

        return view('user.ViewSearch',
            [
                'comment' => $comment,
                'ep' => $ep,
                'data' => $data
            ]
        );
    }
}
