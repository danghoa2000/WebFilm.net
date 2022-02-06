@extends('user.Master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user/elegant-icons.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/user/myCss/home.css ')}}">
@endsection

@section('content')
<section class="hero">
    <div class="container">
        <div class="hero__slider owl-carousel">
            @foreach ($hero as $row)
                <div class="hero__items set-bg" data-setbg="{{$row->img_background}}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div><h2 style="display: inline-block;background-color: rgba(1,1,1,0.6);padding: 0px 10px 10px;border-radius: 5px;">{{$row->name}}</h2></div>
                                <a href="{{route('detail_index', ['id' => $row->id])}}"><span style="border-radius: 4px;">{{__('Watch Now')}}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="trending__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>{{__('Newly updated movie')}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($new_film as $row)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <a href="{{route('detail_index', ['id' => $row->id])}}">
                                        <div class="product__item__pic set-bg" data-setbg="{{$row->img}}">
                                            <div class="ep">
                                                {{-- {{$ep[$row->id]}} --}}
                                            </div>
                                            <div class="comment"><i class="fa fa-comments"></i>
                                                @foreach ($comment as $item)
                                                    @if ($item->id_film == $row->id)
                                                        {{ $item->comment }}
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
                <div class="popular__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>{{__('The movie is appreciated')}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($appreciated as $row)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <a href="{{route('detail_index', ['id' => $row->id])}}">
                                        <div class="product__item__pic set-bg" data-setbg="{{$row->img}}">
                                            {{-- <div class="ep">{{$ep[$row->id]}}</div> --}}
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
            </div>
            @include('user.FilmSidebarView')
        </div>
    </div>
</section>
@endsection

@section('js')
@endsection
