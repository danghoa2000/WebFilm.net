@extends('user.Master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user/myCss/signup.css ')}}" type="text/css">
@endsection

@section('content')
    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="{{ asset('img/user/normal-breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Sign Up</h2>
                        <p>Welcome to the official Anime blog.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Signup Section Begin -->
    <section class="signup spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-10" style="margin-left: 55px;">
                    <div class="login__form">
                        <form action="{{route('performSignupUser')}}" method="post" id="singup"  enctype="multipart/form-data">
                        @csrf
                            <h3>Sign Up</h3>
                                <div class="input__item">
                                    <input type="email" placeholder="Email address" name="email" autofocus>
                                    <span class="icon_mail"></span>
                                </div>
                                <div class="input__item">
                                    <input type="text" placeholder="Your Name" name="name" autofocus>
                                    <span class="icon_profile"></span>
                                </div>
                                <div class="input__item">
                                    <input type="text" placeholder="User Name" name="user_name" autofocus>
                                    <span class="icon_lock"></span>
                                </div>
                                <div class="input__item">
                                    <input type="password" placeholder="Password" name="password" autofocus>
                                    <span class="icon_lock"></span>
                                </div>
                                <div class="input__item">
                                    <input type="date" name="birthday" autofocus>
                                    <span class="icon_profile"></span>
                                </div>
                                <div class="input__item input__item2">
                                <div class="form-group row" style="margin-bottom: 25px;">
                                    <div class="input-group col-md-6">
                                        <div class="custom-file" style="display: block" >
                                            <input type="file" class="custom-file-input @error('avatar') is-invalid  @enderror" id="exampleInputFile" style="overflow: hidden;display: block;z-index:2" name="avatar" onchange="get_img(event)" autofocus>
                                            <span class="icon_image" style="z-index: 5; top: 4px"></span>
                                            <label id="labelAvatar" class="custom-file-label" for="exampleInputFile">
                                                {{__('Avatar')}}
                                            </label>
                                        </div>
                                        @error('avatar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-group row" style="margin-bottom: 0px;position: absolute;top: 50px;right: -184px;">
                                            <div class="input-group col-md-6">
                                                <img src="" alt="" id="img_avatar" style="max-width:150px; max-height:150px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="site-btn">Sign up Now</button>
                            <h5>Already have an account? <a href="{{route('user_login')}}">Log In!</a></h5>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Signup Section End -->
@endsection

@section('js')
<script src="{{ asset('js/user/myJs/signup.Js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        $("#singup").validate({
            rules: {
                email: {
                    required: true,
                    maxlength: 255,
                    email: true,
                    remote: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("checkEmail") }}',
                        type: 'post',
                        data: {
                            email: function() {
                                return $("#email").val();
                            }
                        }
                    }
                },
                name: {
                    required: true,
                    maxlength: 255
                },
                user_name: {
                    required: true,
                    maxlength: 255,
                    remote: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("checkUserName") }}',
                        type: 'post',
                        data: {
                            email: function() {
                                return $("#email").val();
                            }
                        }
                    }
                },
                password: {
                    required: true,
                    maxlength: 255,
                    minlength: 6
                },
                avatar: {
                    extension: "png|jpg|jpeg"
                }
            },
            messages: {
                email: {
                    required: "Email không được để trống",
                    maxlength: "không quá 255 kí tự",
                    email: "dữ liệu nhập vào phải là email",
                    remote: "email đã tồn tại"
                },
                name: {
                    required: "Name không được để trống",
                    maxlength: "không quá 255 kí tự"
                },
                user_name: {
                    required: "User Name không được để trống",
                    maxlength: "không quá 255 kí tự",
                    remote: "User Name đã tồn tại"
                },
                password: {
                    required: "Password không được để trống",
                    maxlength: "không quá 255 kí tự",
                    minlength: "phải lớn hơn 6 kí tự",
                },
                avatar: {
                    extension: "file được chọn phải thuộc jpg,jpeg,png"
                }
            }
        })
    });
</script>
@endsection
