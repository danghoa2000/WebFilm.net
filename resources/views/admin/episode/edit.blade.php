@extends('admin.Master')

@section('css')
    <style>
        #file-link-error{
            position: absolute;
            z-index: 2;
            top: 40px;
        }
        .error{
            color: red !important;
        }
    </style>
@endsection

@section('content')
    <section class="content-header" style="padding: 13px .5rem">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('Episode ')}}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6" style="margin: auto">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">{{__('Edit Form')}}</h3>
                </div>
                <form role="form" action="{{route('episode_update')}}" method="POST" id="episode-update" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="id" value="{{$data->id}}" style="display: none">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('Episode')}}</label>
                        <input type="number" class="form-control" name="tap_so" placeholder="1" value="{{$data->tap_so}}">
                    </div>
                    <div class="form-group">
                        <label for="file-link">{{__('Link Trailer')}}</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="link" id="file-link">
                                <label class="custom-file-label" for="file-link" id="label-link">{{$data->link}}</label>
                            </div>
                                <div class="input-group-append">
                                <span class="input-group-text" id="">{{__('Upload')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="float: right">{{__('Create Episode')}}</button>
                    <a href="javascript:history.back()" class="btn btn-secondary" style="float: right;margin-right:5px">{{__('Cancel')}}</a>
                </div>
                </form>
              </div>
            </div>
        </div>
      </section>
@endsection
@section('js')
    <script>
        $("#file-link").click(function(e) {
            $("#file-link").val("");
            $("#label-link").text("{{$data->link}}");
        });
    </script>
    <script src="{{ asset('js/admin/myJs/episode-edit.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
@endsection
