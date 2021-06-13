<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Anime | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/user/bootstrap.min.css ')}}" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css">
    {{-- <link rel="stylesheet" href="{{ asset('css/user/font-awesome.min.css')}}" type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('css/user/elegant-icons.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/user/plyr.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/user/nice-select.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/user/owl.carousel.min.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/user/slicknav.min.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/user/style.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/user/myCss/master.css ')}}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">

    @yield('css')
    <style>
        .swal2-select{
            display: none
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo" style="padding: 11px 0;">
                        <a href="{{route('user_home_index')}}">
                            <img src="{{ asset('img/user/logo.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class=""><a href="{{route('user_home_index')}}">{{__('Homepage')}}</a></li>
                                <li><a href="#">{{__('Categories')}} <span class="arrow_carrot-down"></span></a>
                                    <?php
                                        $category = App\Models\Category::select('id', 'name')->where('flag_delete', ACTIVE)->get();
                                    ?>
                                    <ul class="dropdown">
                                        @foreach ($category as $row)
                                            <li><a href="{{route('search_index')}}?id_category={{$row->id}}">{{$row->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{route('search_index')}}">{{__('Search')}}</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <form action="{{route('search_index')}}" method="get">
                        <div class="header__right" id="search-area">
                            <input type="text" id="search" autocomplete="off" name="search"><span class="icon_search" style="color: aliceblue;"></span>
                            <span class="bt-profile" id="profile">
                                @if (Auth::guard('web')->user() != null)
                                    <img src="{{Auth::guard('web')->user()->avatar}}" alt="" class="avatar-profile">
                                    <div class="select-profile">
                                        <a href="{{route('user_follow')}}">{{__('Follow')}}</a>
                                        <a href="{{route('user_profile')}}">{{__('Profile')}}</a>
                                        <a href="{{route('user_logout')}}">{{__('Logout')}}</a>
                                    </div>
                                @else
                                    <a href="{{route('user_login')}}" class="icon_profile"></a>
                                @endif
                            </span>
                            <div class="search-results" id="search-results" >
                            </div>
                        </div>
                    </form>
                </div>
                <div style="position: absolute; right:85px; top:10px">
                    <a class="nav-link" data-toggle="dropdown" href="">
                        <i id="language" class="flag-icon {{Config::get('app.locale') == 'en' ? 'flag-icon-us' : 'flag-icon-vn'}}"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-0">
                    <a href="{{route('change-language','')}}/en" class="dropdown-item">
                        <i class="flag-icon flag-icon-us mr-2"></i> English
                    </a>
                    <a href="{{route('change-language','')}}/vi" class="dropdown-item">
                        <i class="flag-icon flag-icon-vn mr-2"></i> Tiếng việt
                    </a>
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    @yield('content')

    <footer class="footer">
    <div class="page-up">
        <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer__logo">
                    <a href="./index.html"><img src="{{ asset('img/user/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="footer__nav">
                </div>
            </div>
            <div class="col-lg-3">
                <p>
                    {{__('Copyright')}} &copy;<script>document.write(new Date().getFullYear());</script> {{__('All rights reserved | This template is made with')}} &hearts; {{__('by')}} <br> <a href="https://www.facebook.com/hiep25122" target="_blank">Hiep</a>
                </p>
                </div>
            </div>
        </div>
    </footer>
  <!-- Footer Section End -->


    <!-- Js Plugins -->
    <script  src = " https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js " > </script>

    <script src="{{ asset('js/admin/popper.min.js')}}"></script>
    <script src="{{ asset('js/user/jquery-3.3.1.min.js ')}}"></script>
    <script src="{{ asset('js/user/bootstrap.min.js ')}}"></script>
    <script src="{{ asset('js/user/player.js ')}}"></script>
    <script src="{{ asset('js/user/jquery.nice-select.min.js ')}}"></script>
    <script src="{{ asset('js/user/mixitup.min.js ')}}"></script>
    <script src="{{ asset('js/user/jquery.slicknav.js ')}}"></script>
    <script src="{{ asset('js/user/owl.carousel.min.js ')}}"></script>
    <script src="{{ asset('js/user/main.js ')}}"></script>
    @yield('js')
    <script>
        $("#search").keyup(function (e) {
            $.ajax({
                type: "get",
                url: "{{route('user_home_search','')}}/"+$("#search").val(),
                success: function (data) {
                    $("#search-results").html(
                        function () {
                            var a = "";
                            data.forEach(element => {
                                a += "<a class='search-results-content' href='"+"{{route('detail_index',[''])}}/"+element["id"]+"'>"
                                    +"<img src='"+element["img"]+"' alt=''>"
                                    +"<p>"+element["name"]+"</p>"
                                +"</a>"
                            });
                            if (data != "") {
                                a += "<div class='search-results-footer'></div>";
                            }
                            return a;
                        }
                    );
                }
            });
        });

        $("body").click(function () {
            $("#search-results").html("");
        });

        $("#profile").hover(function () {
            $(".select-profile").fadeIn();
        }, function () {
            $(".select-profile").fadeOut();
        })
    </script>
</body>

</html>
