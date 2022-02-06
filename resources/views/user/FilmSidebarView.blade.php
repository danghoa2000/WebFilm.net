<?php
    $today = Carbon\Carbon::now()->subDays(1)->format('Y-m-d H:i:s');
    $day = App\Models\ViewsFromTimeToTime::join('film', 'film.id', '=', 'views_from_time_to_time.id_film')
    ->select(
        'views_from_time_to_time.id_film',
        Illuminate\Support\Facades\DB::raw('SUM(views_from_time_to_time.luot_xem) as luot_xem'),
        'film.img',
        'film.name'
    )->where('film.flag_delete', ACTIVE)
    ->where('views_from_time_to_time.updated_at', '>', $today)
    ->orderBy('views_from_time_to_time.luot_xem', 'DESC')
    ->groupBy('views_from_time_to_time.id_film', 'film.img', 'film.name')
    ->take(6)->get();

    $this_week = Carbon\Carbon::now()->subDays(7)->format('Y-m-d H:i:s');
    $week = App\Models\ViewsFromTimeToTime::join('film', 'film.id', '=', 'views_from_time_to_time.id_film')
    ->select(
        'views_from_time_to_time.id_film',
        Illuminate\Support\Facades\DB::raw('SUM(views_from_time_to_time.luot_xem) as luot_xem'),
        'film.img',
        'film.name'
    )->where('film.flag_delete', ACTIVE)
    ->where('views_from_time_to_time.updated_at', '>', $this_week)
    ->orderBy('views_from_time_to_time.luot_xem', 'DESC')
    ->groupBy('views_from_time_to_time.id_film', 'film.img', 'film.name')
    ->take(6)->get();

    $this_month = Carbon\Carbon::now()->subDays(30)->format('Y-m-d H:i:s');
    $month = App\Models\ViewsFromTimeToTime::join('film', 'film.id', '=', 'views_from_time_to_time.id_film')
    ->select(
        'views_from_time_to_time.id_film',
        Illuminate\Support\Facades\DB::raw('SUM(views_from_time_to_time.luot_xem) as luot_xem'),
        'film.img',
        'film.name'
    )->where('film.flag_delete', ACTIVE)
    ->where('views_from_time_to_time.updated_at', '>', $this_month)
    ->orderBy('views_from_time_to_time.luot_xem', 'DESC')
    ->groupBy('views_from_time_to_time.id_film', 'film.img', 'film.name')
    ->take(6)->get();
    $hero = App\Models\Film::select(
        'id',
        'img_background',
        'img',
        'name',
        'luot_xem'
    )->where('flag_delete', ACTIVE)->get();
?>
<div class="col-lg-4 col-md-6 col-sm-8">
    <div class="product__sidebar">
        <div class="product__sidebar__view">
            <div class="section-title">
                <h5>{{__('Top Views')}}</h5>
            </div>
            <ul class="filter__controls">
                <li class="active" data-filter=".day">{{__('Day')}}</li>
                <li data-filter=".week">{{__('Week')}}</li>
                <li data-filter=".month">{{__('Month')}}</li>
            </ul>
            <div class="filter__gallery">
                @foreach ($day as $row)
                    <div class="product__sidebar__view__item set-bg mix day" data-setbg="{{$row->img}}">
                        <div class="ep">
                            {{$ep[$row->id_film]}}
                        </div>
                        <div class="view"><i class="fa fa-eye"></i> {{$row->luot_xem}}</div>
                        <h5><a href="{{route('detail_index', ['id' => $row->id_film])}}" style="display: inline-block;
                            background-color: rgba(1,1,1,0.6);
                            padding: 0px 10px 0px;
                            border-radius: 5px;">{{$row->name}}</a>
                        </h5>
                    </div>
                @endforeach
                @foreach ($week as $row)
                    <div class="product__sidebar__view__item set-bg mix week" data-setbg="{{$row->img}}" style="display: none">
                        <div class="ep">
                            {{$ep[$row->id_film]}}
                        </div>
                        <div class="view"><i class="fa fa-eye"></i> {{$row->luot_xem}}</div>
                        <h5><a href="{{route('detail_index', ['id' => $row->id_film])}}" style="display: inline-block;
                            background-color: rgba(1,1,1,0.6);
                            padding: 0px 10px 0px;
                            border-radius: 5px;">{{$row->name}}</a></h5>
                    </div>
                @endforeach
                @foreach ($month as $row)
                    <div class="product__sidebar__view__item set-bg mix month" data-setbg="{{$row->img}}" style="display: none">
                        <div class="ep">
                            {{$ep[$row->id_film]}}
                        </div>
                        <div class="view"><i class="fa fa-eye"></i> {{$row->luot_xem}}</div>
                        <h5><a href="{{route('detail_index', ['id' => $row->id_film])}}" style="display: inline-block;
                            background-color: rgba(1,1,1,0.6);
                            padding: 0px 10px 0px;
                            border-radius: 5px;">{{$row->name}}</a></h5>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="product__sidebar__comment">
            <div class="section-title">
                <h5>{{__('YOU MIGHT LIKE...')}}</h5>
            </div>
            @foreach ($hero as $row)
                <div class="product__sidebar__comment__item">
                    <div class="product__sidebar__comment__item__pic">
                        <img src="{{$row->img}}" alt="" class="img-you-might-like">
                    </div>
                    <div class="product__sidebar__comment__item__text">
                        <h5><a href="{{route('detail_index', ['id' => $row->id])}}">{{$row->name}}</a></h5>
                        <span><i class="fa fa-eye"></i> {{$row->luot_xem}} Viewes</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
