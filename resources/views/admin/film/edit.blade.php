@extends('admin.Master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/myCss/film-create.css')}}">
    <style>
        .img-upload-preview, .img-upload-preview-background{
            display: block !important;
        }
    </style>
@endsection

@section('content')
    <section class="content-header" style="padding: 13px .5rem">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('Film')}}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">{{__('Edit Form')}}</h3>
                </div>
                <form role="form" action="{{route('film_update')}}" method="POST" id="film-create" enctype="multipart/form-data">
                @csrf
                    <div style="display: inline-flex; width:100%">
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{("Movie's Name")}}</label>
                                    <input type="text" class="form-control" name="id" style="display: none" value="{{$film->id}}">
                                    <input type="text" class="form-control" name="name" placeholder="Movie's Name" value="{{$film->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{__('Year of release')}}</label>
                                    <input type="number" class="form-control" name="nam_sx" placeholder="2021" value="{{$film->nam_sx}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Country')}}</label>
                                    <input type="text" class="form-control" name="quoc_gia" placeholder="Country" value="{{$film->quoc_gia}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">{{__('Description')}}</label>
                                    <textarea class="form-control" name="mota" rows="3" placeholder="Enter...." >{{$film->mota}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{__('Link Trailer')}}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="link_trailer" id="file-link-trailer">
                                            <label class="custom-file-label" for="exampleInputFile" id="label-link-trailer">{{$film->link_trailer}}</label>
                                        </div>
                                            <div class="input-group-append">
                                            <span class="input-group-text" id="">{{__('Upload')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">

                                <div class="form-group">
                                    <label>{{__('Category')}}</label>
                                    <select multiple class="custom-select" name="category[]">
                                        @foreach ($category as $item)
                                            <option value="{{$item->id}}"
                                                @foreach ($category_film as $key)
                                                    @if ($key->id_category == $item->id)
                                                        selected
                                                    @endif
                                                @endforeach
                                            >{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">{{__('Movie avatar')}}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="avatar" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile" id="label-avatar">{{$film->img}}</label>
                                        </div>
                                            <div class="input-group-append">
                                            <span class="input-group-text" id="">{{__('Upload')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <img class="img-upload-preview" src="{{ asset($film->img)}}" id="img-upload-preview">
                                <div class="form-group">
                                    <label for="movie-background">{{__('Movie background')}}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="background" id="movie-background">
                                            <label class="custom-file-label" for="movie-background" id="label-background">{{$film->img_background}}</label>
                                        </div>
                                            <div class="input-group-append">
                                            <span class="input-group-text" id="">{{__('Upload')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <img class="img-upload-preview-background" src="{{ asset($film->img_background)}}" id="img-upload-preview-background">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="float: right">{{__('Save changes')}}</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
      </section>
@endsection
@section('js')
    <script src="{{ asset('js/admin/myJs/film-edit.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
@endsection
