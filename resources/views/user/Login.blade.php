@extends('user.Master')

@section('css')
@endsection

@section('content')
    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="{{ asset('img/user/normal-breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>{{__('Login')}}</h2>
                        <p>{{__('Welcome to our movie website.')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Login Section Begin -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>{{__('Login')}}</h3>
                        <form action="{{route('performLoginUser')}}" method="post">
                        @csrf
                            <div class="input__item">
                                <input type="text" placeholder="User Name" name="user_name">
                                <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" placeholder="Password" name="password">
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn">{{__('Login Now')}}</button>
                        </form>
                        <a href="#" class="forget_pass">{{__('Forgot Your Password?')}}</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                        <h3>{{__('Dont’t Have An Account?')}}</h3>
                        <a href="{{route('user_signup')}}" class="primary-btn">{{__('Register Now')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section End -->
@endsection

@section('js')
@endsection
