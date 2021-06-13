@extends('user.Master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user/myCss/view_search.css ')}}">
    <link rel="stylesheet" href="{{ asset('css/user/myCss/home.css ')}}">
@endsection

@section('content')
    <section class="normal-breadcrumb set-bg" data-setbg="{{ asset('img/user/normal-breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>{{__('Search')}}</h2>
                        <p>{{__('The movie you are looking for is shown below')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>{{__('Search')}}</h4>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="get">
                                <div class="option-search">
                                    <select name="order" id="">
                                        <option value="">{{__('arrange')}}</option>
                                        <option value="film.updated_at" {{ isset($_GET["order"]) ? ($_GET["order"] == 'film.updated_at' ? 'selected' : "") : "" }}>{{__('New film')}}</option>
                                        <option value="film.IMDb" {{ isset($_GET["order"]) ? ($_GET["order"] == 'film.IMDb' ? 'selected' : "") : "" }}>{{__('Scores')}}</option>
                                        <option value="film.luot_xem" {{ isset($_GET["order"]) ? ($_GET["order"] == 'film.luot_xem' ? 'selected' : "") : "" }}>{{__('Many Views')}}</option>
                                        <option value="film.nam_sx" {{ isset($_GET["order"]) ? ($_GET["order"] == 'film.nam_sx' ? 'selected' : "") : "" }}>{{__('year of release')}}</option>
                                    </select>
                                    <?php
                                        $category = App\Models\Category::select('id', 'name')->where('flag_delete', ACTIVE)->get();
                                    ?>
                                    <select name="id_category" id="">
                                        <option value="">{{__('category')}}</option>
                                        @foreach ($category as $item)
                                            <option value="{{$item->id}}" {{ isset($_GET["id_category"]) ? ($_GET["id_category"] == $item->id ? 'selected' : "") : "" }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <select name="quoc_gia" id="">
                                        <option value="">{{__('contruy')}}</option>
                                        <option value="Mỹ" {{ isset($_GET["quoc_gia"]) ? ($_GET["quoc_gia"] == 'Mỹ' ? 'selected' : "") : "" }}>{{__('Mỹ')}}</option>
                                        <option value="Trung Quốc" {{ isset($_GET["quoc_gia"]) ? ($_GET["quoc_gia"] == 'Trung+Quốc' ? 'selected' : "") : "" }}>{{__('Trung Quốc')}}</option>
                                        <option value="Hàn Quốc" {{ isset($_GET["quoc_gia"]) ? ($_GET["quoc_gia"] == 'Hàn+Quốc' ? 'selected' : "") : "" }}>{{__('Hàn Quốc')}}</option>
                                        <option value="Nhật Bản" {{ isset($_GET["quoc_gia"]) ? ($_GET["quoc_gia"] == 'Nhật+Bản' ? 'selected' : "") : "" }}>{{__('Nhật Bản')}}</option>
                                    </select>
                                    <select name="nam_sx" id="">
                                        <?php
                                            $current_year = Carbon\Carbon::now()->format('Y');
                                        ?>
                                        <option value="">{{__('year')}}</option>
                                        @for ($i = $current_year; $i > 2010; $i--)
                                            <option value="{{$i}}" {{ isset($_GET["nam_sx"]) ? ($_GET["nam_sx"] == $i ? 'selected' : "") : "" }}>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <button type="submit" class="bt-search">Search</button>
                                </div>
                            </form>
                        </div>
                        @if (isset($_GET["search"]))
                            <div class="value-search">
                                <p>{{__('search results of')}} :</p> <p style="color: red">{{$_GET["search"]}}</p>
                            </div>
                        @endif
                        <div class="row">
                            @foreach ($data as $row)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="{{route('detail_index', ['id' => $row->id])}}">
                                            <div class="product__item__pic set-bg" data-setbg="{{$row->img}}">
                                                <div class="ep">
                                                    {{$ep[$row->id]}}
                                                </div>
                                                <div class="comment"><i class="fa fa-comments"></i>
                                                    @foreach ($comment as $item)
                                                        @if ($item->id_film == $row->id)
                                                            {{$item->comment}}
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="view"><i class="fa fa-eye"></i> {{$row->luot_xem}}</div>
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <h5><a href="{{route('detail_index', ['id' => $row->id])}}">{{$row->name}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <?php
                        $currentPage = $data->links()->paginator->currentPage();
                        $lastPage = $data->links()->paginator->lastPage();
                        $path = $data->links()->paginator->path();

                    ?>
                    @if ($lastPage > 1)
                        <div class="product__pagination">
                            @if ($currentPage != 1)
                                <a href="{{$path}}?page=1"><i class="fa fa-angle-double-left"></i></a>
                            @endif
                            @for ($i = $currentPage - 2; $i < $currentPage; $i++)
                                @if ($i > 0)
                                    <a href="{{$path}}?page={{$i}}" class="page">{{$i}}</a>
                                @endif
                            @endfor
                            <a href="{{$path}}?page={{$currentPage}}" class="current-page">{{$currentPage}}</a>
                            @for ($i = $currentPage + 1; $i < $currentPage + 3; $i++)
                                @if ($i <= $lastPage)
                                    <a href="{{$path}}?page={{$i}}" class="page">{{$i}}</a>
                                @endif
                            @endfor
                            @if ($currentPage != $lastPage)
                                <a href="{{$path}}?page={{$lastPage}}"><i class="fa fa-angle-double-right"></i></a>
                            @endif
                        </div>
                    @endif
                </div>
                @include('user.FilmSidebarView')
            </div>
        </div>
    </section>
@endsection

@section('js')

@endsection
