<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Film;
use App\Services\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EpisodeController extends Controller
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = Episode::select(
            'id',
            'id_film',
            'link',
            'tap_so',
            'updated_at'
        )->where('id_film', $id)->Paginate(15);

        return view('admin.episode.index', ['data' => $data, 'id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.episode.create', ['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file =  $request->file('link');
        $fileName = time() . $request->id_film. '.' . $file->getClientOriginalExtension();
        $request->link->move(public_path('/upload/mp4/'), $fileName);
        DB::transaction(function () use($request, $fileName) {
            $episode = new Episode();
            $episode->id_film = $request->id_film;
            $episode->tap_so = $request->tap_so;
            $episode->link = '/upload/mp4/'. $fileName;
            $episode->save();
            Film::where('id', $request -> id_film)->update(
                [
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]
            );
        });
        Alert::success('Success','add category successfully');

        return redirect() -> route('episode_index',['id' => $request -> id_film]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Episode::select(
            'id',
            'tap_so',
            'link'
        )->where('id', $id)->first();

        return view('admin.episode.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $episode = Episode::select(
            'id',
            'tap_so',
            'link',
            'id_film'
        )->where('id', $request -> id)->first();

        $episode -> tap_so = $request -> tap_so;

        if ($request->hasFile('link')) {
            $file =  $request->file('link');
            $fileName = time() . $request->id. '.' . $file->getClientOriginalExtension();
            $request->link->move(public_path('/upload/mp4/'), $fileName);
            $episode->link = "/upload/mp4/" . $fileName;
            Film::where('id', $episode -> id_film)->update(
                [
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]
            );
        }
        $episode -> save();

        return redirect() -> route('episode_index', ['id' => $episode -> id_film]);
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
            Episode::where('id', $id) -> delete();
        });

        return "true";
    }
}
