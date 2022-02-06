@extends('admin.Master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/myCss/home.css')}}">
    <link rel="stylesheet" href="{{ asset('css/user/style.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/user/elegant-icons.css ')}}" type="text/css">
@endsection

@section('content')
    <form action="{{route('admin_update_avatar')}}" method="post" id="update-avatar" enctype="multipart/form-data">
        @csrf
        <div class="popup" style="display: none">
            <div class="popup-content">
                <p class="title-conten-popup">{{__('Update avatar')}}</p>
                <div class="popup-view">
                    <input type="file" name="avatar" style="display: none" id="input-change-avatar" accept=".jpg,.jpeg,.png" onchange="get_img(event)">
                    {{-- <input type="text" name="popup_value_id" style="display: none" value="{{$data->id}}"> --}}
                    <span class="upload-avatar" id="upload-avatar"><span class="icon_upload"></span>{{__('Upload File')}}</span>
                    <img class="preview-avatar" id="preview-avatar" src="{{ asset('img/user/profile_none.png')}}" alt="User profile picture">
                </div>
                <div class="popup-footer">
                    <button type="submit" id="save-change-avatar" style="padding: 5px 30px" class="btn btn-primary btn-sm float-right" disabled>{{__('Save')}}</button>
                    <span id="cancel-change-avatar" style="padding: 5px 30px;margin-right:10px" class="btn btn-secondary btn-sm float-right">{{__('Cancel')}}</span>
                </div>
            </div>
        </div>
    </form>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('Profile')}}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div style="display: flex">
                                <div class="text-center" style="position: relative;display: inline-block;margin: 0px auto;">
                                    <div class="avatar-border show-popup-change-avatar" >
                                        <img class="profile-user-img img-fluid img-circle avatar-profile" id="avatar"
                                        src="{{ asset('img/user/profile_none.png')}}"
                                        alt="User profile picture">
                                    </div>
                                    <span class="icon_image show-popup-change-avatar" id="icon_change_profile" style=""></span>
                                </div>
                            </div>
                            <h3 class="profile-username text-center">Admin</h3>

                            <p class="text-muted text-center">{{__('Manager')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <span class="btn btn-outline-primary btn-xs float-right bt-edit-profile" id="bt-edit"><i class="fas fa-edit"></i></span>
                            <form action="{{route('admin_update_profile')}}" id="edit-admin-form" method="post" enctype="multipart/form-data">
                            @csrf
                                <ul class="list-group list-group-unbordered mb-3">
                                    {{-- <li class="list-group-item">
                                        <b>{{__('Email')}}</b> <a class="float-right">{{$data->email}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{__('User Name')}}</b> <a class="float-right">{{$data->user_name}}</a><input type="text" class="hidden" name="user_name" value="{{$data->user_name}}">
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{__('name')}}</b> <a class="float-right hidden-edit">{{$data->name}}</a><input type="text" class="input-edit-profile" name="name" value="{{$data->name}}">
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{__('Birthday')}}</b> <a class="float-right hidden-edit">{{$data->birthday}}</a><input type="date" class="input-edit-profile" name="birthday" value="{{$data->birthday}}">
                                    </li> --}}
                                    <li class="list-group-item">
                                        <b>{{__('Password')}}</b> <a class="float-right hidden-edit">**********</a>
                                        <input type="password" class="input-edit-profile" id="password" name="password" placeholder="{{__('current password')}}" aria-invalid="false">
                                    </li>
                                    <li class="list-group-item" style="border: 0 !important">
                                        <input type="password" class="input-edit-profile new-password" name="new_password" placeholder="{{__('new password')}}">
                                    </li>
                                </ul>
                                <span style="margin-left:10px" id="bt-cancel" class="btn btn-secondary btn-sm float-right hidden">{{__('Cancel')}}</span>
                                <button type="submit" id="bt-save" class="btn btn-success btn-sm float-right hidden">{{__('Save')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script src="{{ asset('js/admin/myJs/home.js ')}}"></script>
<script>
    $("#edit-admin-form").validate({
        rules: {
            password: {
                maxlength: 255,
                remote: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("checkPasswordAdmin") }}',
                    type: 'post',
                    data: {
                        password : function () {
                            return $("#password").val().toString();
                        }
                    }
                }
            },
            name: {
                required: true,
                maxlength: 255
            }
        }
    });
</script>
@endsection
