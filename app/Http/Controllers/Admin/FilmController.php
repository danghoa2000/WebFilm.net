<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryFilm;
use App\Models\Film;
use App\Services\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FilmController extends Controller
{
    protected $Service;

    /**
     * initialize the value for the Service.
     *
     * @param  Service  $Service
     */
    public function __construct(Service $Service)
    {
        $this->Service = $Service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Film::select(
            'id',
            'img',
            'name',
            'IMDb',
            'nam_sx',
            'mota',
            'luot_xem',
            'quoc_gia',
            'link_trailer'
        )->where('flag_delete', 1)
        ->where('name', 'like', "%$request->search%")
        ->orderBy('updated_at', 'DESC')
        ->Paginate(15);

        $category = CategoryFilm::join('category', 'category.id', '=', 'category_film.id_category')
            ->select('category.name', 'category_film.id_film')
            ->where('category.flag_delete', ACTIVE)
            ->get();

        return view('admin.film.index',
            [
                'data' => $data,
                'category' => $category,
                'search' => $request->search
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::select('id', 'name')->where('flag_delete', ACTIVE)->get();
        return view('admin.film.create', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use($request) {
            $film = new Film();
            $film->img = '/upload/avatar/' . $this->Service->uploadimg($request);
            $film->img_background = '/upload/avatar/' . $this->Service->uploadimg_background($request);
            $film->name =  $request->name;
            $film->nam_sx = $request->nam_sx;
            $film->mota =  $request->mota;
            $film->quoc_gia = $request->quoc_gia;

            if ($request->hasFile('link_trailer')) {
                $film->link_trailer = '/upload/mp4/' . $this->Service->uploadLink_trailer($request);
            }

            $film->save();

            if ($request->category != null) {
                foreach ($request->category as $key) {
                    CategoryFilm::insert([
                        [
                            'id_category' => $key,
                            'id_film' => $film->id
                        ]
                    ]);
                }
            }

        });
        Alert::success('Success','add category successfully');

        return redirect()->route('film_index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::select('id', 'name')->where('flag_delete', ACTIVE)->get();

        $category_film = CategoryFilm::select('id_category')->where('id_film', $id)->get();

        $film = Film::select(
            'id',
            'name',
            'nam_sx',
            'quoc_gia',
            'mota',
            'link_trailer',
            'img',
            'img_background'
        )->where('id', $id)->first();

        return view('admin.film.edit', ['category' => $category, 'category_film' => $category_film, 'film' => $film]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $film = Film::select(
            'id',
            'name',
            'nam_sx',
            'quoc_gia',
            'mota',
            'link_trailer',
            'img',
            'img_background'
        )->where('id', $request->id)->first();

        if ($request->hasFile('avatar')) {
            $film->img = '/upload/avatar/' . $this->Service->uploadimg($request);
        }

        if ($request->hasFile('background')) {
            $film->img_background = '/upload/avatar/' . $this->Service->uploadimg_background($request);
        }

        if ($request->hasFile('link_trailer')) {
            $film->link_trailer = '/upload/mp4/' . $this->Service->uploadLink_trailer($request);
        }

        $film->name = $request->name;
        $film->nam_sx = $request->nam_sx;
        $film->quoc_gia = $request->quoc_gia;
        $film->mota = $request->mota;
        $film->save();

        CategoryFilm::where('id_film', $request->id)->delete();
        if ($request->category != null) {
            foreach ($request->category as $key) {
                CategoryFilm::insert([
                    [
                        'id_category' => $key,
                        'id_film' => $film->id
                    ]
                ]);
            }
        }

        return redirect()->route('film_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return boolean
     */
    public function destroy($id)
    {
        DB::transaction(function () use($id) {
            Film::where('id', $id)->update(
                [
                    'flag_delete' => INACTIVE,
                ]
            );
        });

        return "true";
    }
}
