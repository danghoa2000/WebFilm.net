@extends('user.Master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user/myCss/film_watching.css')}}">
@endsection

@section('content')
    <section class="anime-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__video__player">
                        <video playsinline controls data-poster="./videos/anime-watch.jpg" style="border-radius: 5px;width: 1155px;">
                            <source src="{{$watching->link}}" type="video/mp4" />
                            <!-- Captions are optional -->
                            <track kind="captions" label="English captions" src="#" srclang="en" default />
                        </video>
                    </div>
                    <div class="anime__details__episodes">
                        <div class="section-title">
                            <h5>{{__('List Episode')}}</h5>
                        </div>
                        @foreach ($episode as $row)
                            <a href="{{route('watching_index', ['id' => $row->id_film, 'episode' => $row->tap_so])}}">Ep {{$row->tap_so}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>{{__('Your Comment')}}</h5>
                        </div>
                        <form action="#">
                            <textarea placeholder="Your Comment" id="your-comment" ></textarea>
                            @if ( Auth::guard('web')->user())
                                <input type="text" id="id-user" style="display: none" value="{{Auth::guard('web')->user()->id}}">
                                <img src="{{Auth::guard('web')->user()->avatar}}" alt="" style="display: none" id="avatar">
                                <input type="text" name="name_comment" id="name_comment" style="display: none" value="{{Auth::guard('web')->user()->name}}">
                            @else
                                <img src="/img/user/profile_none.png" alt="" style="display: none" id="avatar">
                                <input type="text" name="name_comment" id="name_comment">
                            @endif
                            <input type="text" name="id_film" id="id_film" value="{{$watching->id_film}}" style="display: none">
                            <label for="name_comment" id="lb-name-comment"></label><br>
                            <button type="button" id="bt-comment"><i class="fa fa-location-arrow"></i> {{__('Comment')}}</button>
                        </form>
                    </div>
                    <div class="section-title" style="margin-top: 30px">
                        <h5>{{__('Reviews')}}</h5>
                    </div>
                    <div class="anime__details__review" id="view-comment" style="margin-top: 40px;">
                    </div>
                    <div>
                        <button class="See-more-comments" id="see-more-comment">{{__('See more comments')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('js/user/moment.js ')}}"></script>
    <script src="{{ asset('js/user/myJs/film_detail.js ')}}"></script>
    <script src="{{ asset('js/user/myJs/film_watching.js ')}}"></script>
@endsection
