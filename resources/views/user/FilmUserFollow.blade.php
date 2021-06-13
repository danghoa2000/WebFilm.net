@extends('user.Master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user/myCss/view_search.css ')}}">
    <link rel="stylesheet" href="{{ asset('css/user/myCss/home.css ')}}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/user/myCss/follow.css')}}">
@endsection

@section('content')
    <section class="normal-breadcrumb set-bg" data-setbg="{{ asset('img/user/normal-breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>{{__('Follow')}}</h2>
                        <p>{{__('Movie list you are following')}}</p>
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
                                        <h4>{{__('Follow')}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($data as $row)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <form action="" class="follow-form">
                                            <span class="destroy-follow"><i class="fas fa-times bt-x"></i></span>
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
                                                <input type="text" value="{{$row->id}}" style="display: none">
                                                <h5><a href="{{route('detail_index', ['id' => $row->id])}}">{{$row->name}}</a></h5>
                                            </div>
                                        </form>
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
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <script>
        $(".destroy-follow").click(function (e) {
            let $this = $(this),
                id_film = $this.closest('.follow-form')[0][0]["value"];
            swal({
                title: "{{__('Are you sure?')}}",
                text: '',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{__('Confirm')}}",
                cancelButtonText: "{{__('Cancel')}}",
            }).then(function(result) {
                if (result["value"] == true) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        url: "{{route('destroy-follow')}}",
                        data: { id : id_film},
                        success: function (response) {
                            $this.closest('.col-lg-4').css('display','none')
                        }
                    });
                }
            });
        });
    </script>
@endsection
