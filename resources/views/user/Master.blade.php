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
    <link rel="stylesheet" href="{{ asset('css/user/elegant-icons.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/user/plyr.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/user/nice-select.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/user/owl.carousel.min.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/user/slicknav.min.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/user/style.css ')}}" type="text/css">
    {{-- <link rel="stylesheet" href="{{ asset('css/user/myCss/master.css ')}}" type="text/css"> --}}
    <style>
        #search{
            position: absolute;
            left: -95px;
            background: #ffffff00;
            border: 0px;
            border-bottom: 1px solid #ffffff00;
            color: #ffffff57;
            padding: 0px 25px 0px 10px;
        }
        #search:focus{
            border-bottom: 1px solid #ffffff57;
        }
        .search-results-footer{
            height: 34px;
            background: red;
            border-radius: 0px 0px 10px 10px;
        }
        .search-results{
            position: absolute;
            width: 320px;
            background: #3b3b3b;
            z-index: 2;
            left: -120px;
            border-radius: 10px;
        }
        .search-results-content{
            display: block;
            padding: 8px 20px;
            text-align: left;
            margin: 0 !important;
            border-radius: 10px;
            width: 100%;
        }
        .search-results-content img{
            width: 55px;
            height: 64px;
        }
        .search-results-content p{
            display: inline-block;
            width: 200px;
            margin: 10px;
            color: white
        }
        .search-results-content:hover {
            background-color: #727272;
        }
    </style>
    @yield('css')

</head>

<body>
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
                        <a href="">
                            <img src="{{ asset('img/user/logo.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="active"><a href="">{{__('Homepage')}}</a></li>
                                <li><a href="./categories.html">{{__('Categories')}} <span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <li><a href="">{{__('Categories')}}</a></li>
                                        <li><a href="">{{__('Anime Details')}}</a></li>
                                        <li><a href="">{{__('Anime Watching')}}</a></li>
                                        <li><a href="">{{__('Blog Details')}}</a></li>
                                        <li><a href="">{{__('Sign Up')}}</a></li>
                                        <li><a href="">{{__('Login')}}</a></li>
                                    </ul>
                                </li>
                                <li><a href="">{{__('Our Blog')}}</a></li>
                                <li><a href="">{{__('Contacts')}}</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right">
                        <input type="text" id="search" autocomplete="off"><span class="icon_search" style="color: aliceblue;"></span>
                        <a href="#" style="margin-left: 10px"><span class="icon_profile"></span></a>
                        <div class="search-results" id="search-results">
                        </div>
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
                    <ul>
                        <li class="active"><a href="./index.html">Homepage</a></li>
                        <li><a href="./categories.html">Categories</a></li>
                        <li><a href="./blog.html">Our Blog</a></li>
                        <li><a href="#">Contacts</a></li>
                    </ul>
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
                                a += "<a class='search-results-content' href='"+element["id"]+"'>"
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

        $("#search").focusout(function () {
            $("#search-results").html("");
        });
    </script>
</body>

</html>
