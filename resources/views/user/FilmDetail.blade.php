@extends('user.Master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user/myCss/film_detail.css ')}}">
@endsection

@section('content')
<div class="trailer">
    <video playsinline controls data-poster="./videos/anime-watch.jpg" id="video-trailer">
        <source src="{{$data->link_trailer}}" type="video/mp4" />
        <!-- Captions are optional -->
        <track kind="captions" label="English captions" src="#" srclang="en" default />
    </video>
</div>
<section class="anime-details spad">
    <div class="container">
        <div class="anime__details__content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="anime__details__pic set-bg" data-setbg="{{$data->img}}">
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="anime__details__text">
                        <div class="anime__details__title">
                            <h3>{{$data->name}}</h3>
                        </div>
                        <div class="anime__details__rating">
                            <div class="rating">
                                <span id="popup-link" class="see-detail popup-link" data-container="body" data-toggle="popover" data-placement="top" data-content="">
                                    @for ($i = 1; $i <= intval($data->IMDb); $i++)
                                        <a href="#"><i class="fa fa-star gold star" id="{{$i}}"></i></a>
                                    @endfor
                                    @if ($data->IMDb - intval($data->IMDb) >= 0.5)
                                        <a href="#"><i id="{{intval($data->IMDb) + 1}}" class="fa fa-star-half-o gold star"></i></a>
                                        @for ($i = intval($data->IMDb) + 2; $i <= 5; $i++)
                                            <a href="#"><i id="{{$i}}" class="fa fa-star gray star"></i></a>
                                        @endfor
                                    @else
                                        @for ($i = intval($data->IMDb) + 1; $i <= 5; $i++)
                                            <a href="#"><i id="{{$i}}" class="fa fa-star gray star"></i></a>
                                        @endfor
                                    @endif
                                </span>
                            </div>
                            <span id="vote">{{ $data->IMDb}} <i class="fa fa-star" style="color: #e89f12 !important"></i> - {{$data->so_danh_gia}} {{__('Votes')}}</span>
                        </div>
                        <p>{{$data->mota}}</p>
                        <div class="anime__details__widget">
                            <div class="row">
                                <div class="col-lg-10 col-md-10">
                                    <ul>
                                        <?php
                                            $category_film = App\Models\CategoryFilm::join('category', 'category.id', '=', 'category_film.id_category')
                                                                ->select('category.name as name')
                                                                ->where('category.flag_delete', ACTIVE)
                                                                ->where('category_film.id_film', $data->id)
                                                                ->get();
                                        ?>
                                        <li><span>{{__('Year of release')}}:</span> {{$data->nam_sx}}</li>
                                        <li><span>{{__('Category')}}:</span>
                                            @foreach ($category_film as $item)
                                                {{$item->name}},
                                            @endforeach
                                        </li>
                                        <li><span>{{__('Country')}}:</span> {{$data->quoc_gia}}</li>
                                        <li><span>{{__('View')}}:</span> {{$data->luot_xem}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="anime__details__btn">
                            <?php
                                if (Auth::guard('web')->user()) {
                                    $user = Auth::guard('web')->user();
                                    $follow = App\Models\YourFilm::select('id')->where('id_user', $user->id)->where('id_film', $data->id)->first();
                                } else {
                                    $follow = "not logged in";
                                }
                            ?>
                            <span class="follow-btn popup-link" style="cursor: pointer" id="bt-follow" data-container="body" data-toggle="popover" data-placement="top" data-content=""><i class="fa fa-heart-o"></i> {{__('Follow')}}</span>
                            @if (isset($data->link_trailer))
                                <span class="follow-btn popup-link" style="cursor: pointer" id="trailler">{{__('Trailler')}}</span>
                            @endif
                            <a href="{{route('watching_index', ['id' => $data->id, 'episode' => 1])}}" class="watch-btn"><span>{{__('Watch Now')}}</span> <i
                                class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>{{__('Your Comment')}}</h5>
                        </div>
                        <form action="#">
                            <textarea placeholder="{{__('Your Comment')}}" id="your-comment" ></textarea>
                            @if ( Auth::guard('web')->user())
                                <input type="text" id="id-user" style="display: none" value="{{Auth::guard('web')->user()->id}}">
                                <img src="{{Auth::guard('web')->user()->avatar}}" alt="" style="display: none" id="avatar">
                                <input type="text" name="name_comment" id="name_comment" style="display: none" value="{{Auth::guard('web')->user()->name}}">
                            @else
                                <img src="/img/user/profile_none.png" alt="" style="display: none" id="avatar">
                                <input type="text" name="name_comment" id="name_comment" placeholder="Your Name">
                            @endif
                            <input type="text" name="id_film" id="id_film" value="{{$data->id}}" style="display: none">
                            <label for="name_comment" id="lb-name-comment"></label><br>
                            <button type="button" id="bt-comment"><i class="fa fa-location-arrow"></i> {{__('Comment')}}</button>
                        </form>
                    </div>
                    <div class="section-title" style="margin-top: 30px">
                        <h5>{{__('Reviews')}}</h5>
                    </div>
                    <div class="anime__details__review" id="view-comment" style="margin-top: 40px">
                    </div>
                    <div>
                        <button class="See-more-comments" id="see-more-comment">{{__('See more comments')}}</button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="anime__details__sidebar">
                        <div class="section-title">
                            <h5>{{__('YOU MIGHT LIKE...')}}</h5>
                        </div>
                        @foreach ($might_like as $row)
                            <div class="product__sidebar__view__item set-bg" data-setbg="{{$row->img_background}}">
                                <div class="ep"> {{$ep[$row->id]}}</div>
                                <div class="view"><i class="fa fa-eye"></i> {{$row->luot_xem}}</div>
                                <h5><a href="{{route('detail_index', ['id' => $row->id])}}" class="name-film">{{$row->name}}</a></h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('js/user/moment.js ')}}"></script>
    <script>
        var hover = 1;
        var follow = "{{$follow}}";
        $(".star").click(function(e) {
            hover = 0;
            if ("{{Auth::guard('web')->user()}}" != "") {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "{{route('evaluate')}}",
                    data:
                        {
                            IMDb: e.target.id,
                            user: $("#id-user").val(),
                            id_film : $("#id_film").val()
                        },
                    success: function(data) {
                        for (let i = 1; i < 5; i++) {
                            $("#"+i).removeClass('star');
                        }
                        if (data == "You have rated this movie before") {
                            $("#popup-link").attr('data-content',data);
                            $("#popup-link").popover('show')
                            setTimeout(function(){
                                $("#popup-link").popover('hide')
                            }, 3000);
                        } else {
                            $("#vote").html(function () {
                                var a = data + ' <i class="fa fa-star" style="color: #e89f12 !important"></i> - {{$data->so_danh_gia + 1}} Votes'
                                return a;
                            })
                            for (let i = 1; i <= e.target.id; i++) {
                                $("#" + i).addClass('yellow');
                            }
                            for (let i = e.target.id; i <= 5; i++) {
                                $("#" + i).addClass('gray2');
                            }
                        }
                    }
                });
            } else {
                $("#popup-link").attr('data-content','You need to log in to be able to rate');
                $("#popup-link").popover('show')
                setTimeout(function(){
                    $("#popup-link").popover('hide')
                }, 3000);
            }
        });

        $("#bt-follow").click(function (e) {
            if (follow != "") {
                if (follow == "not logged in") {
                    $("#bt-follow").attr('data-content','You need to log in to follow');
                    $("#bt-follow").popover('show')
                    setTimeout(function(){
                        $("#bt-follow").popover('hide')
                    }, 3000);
                } else {
                    $("#bt-follow").attr('data-content','You have followed this film already');
                    $("#bt-follow").popover('show')
                    setTimeout(function(){
                        $("#bt-follow").popover('hide')
                    }, 3000);
                }
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "{{route('add-follow')}}",
                    data: { id_film : function () {
                        return {{$data->id}};
                    }},
                    success: function (response) {
                        $("#bt-follow").attr('data-content',"Follow");
                        $("#bt-follow").popover('show')
                        setTimeout(function(){
                            $("#bt-follow").popover('hide')
                        }, 3000);
                        follow = "ACTIVE";
                    }
                });
            }
        });


    </script>
    <script src="{{ asset('js/user/myJs/film_detail.js ')}}"></script>
@endsection
