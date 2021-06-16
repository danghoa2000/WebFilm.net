@extends('admin.Master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/myCss/film-create.css')}}">
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
                  <h3 class="card-title">{{__('Create Form')}}</h3>
                </div>
                <form role="form" action="{{route('film_store')}}" method="POST" id="film-create" enctype="multipart/form-data">
                @csrf
                    <div style="display: inline-flex; width:100%">
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{("Movie's Name")}}</label>
                                    <input type="text" class="form-control" name="name" placeholder="Movie's Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{__('Year of release')}}</label>
                                    <input type="number" class="form-control" name="nam_sx" placeholder="2021">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Country')}}</label>
                                    <input type="text" class="form-control" name="quoc_gia" placeholder="Country">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">{{__('Description')}}</label>
                                    <textarea id="" class="form-control" name="mota" rows="3" placeholder="Enter...."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{__('Link Trailer')}}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="link_trailer" id="file-link-trailer">
                                            <label class="custom-file-label" for="exampleInputFile" id="label-link-trailer">{{__('Choose file')}}</label>
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
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">{{__('Movie avatar')}}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="avatar" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile" id="label-avatar">{{__('Choose file')}}</label>
                                        </div>
                                            <div class="input-group-append">
                                            <span class="input-group-text" id="">{{__('Upload')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <img class="img-upload-preview" src="{{ asset('img/user/profile_none.png')}}" id="img-upload-preview">
                                <div class="form-group">
                                    <label for="movie-background">{{__('Movie background')}}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="background" id="movie-background">
                                            <label class="custom-file-label" for="movie-background" id="label-background">{{__('Choose file')}}</label>
                                        </div>
                                            <div class="input-group-append">
                                            <span class="input-group-text" id="">{{__('Upload')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <img class="img-upload-preview-background" src="{{ asset('img/user/profile_none.png')}}" id="img-upload-preview-background">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="float: right">{{__('Create movie')}}</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
      </section>
@endsection
@section('js')
    <script src="{{ asset('js/admin/myJs/film-create.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
@endsection
