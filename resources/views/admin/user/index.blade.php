@extends('admin.Master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/myCss/film-index.css')}}">
    <link rel="stylesheet" href="{{ asset('css/user/elegant-icons.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/myCss/menu-edit.css ')}}">
@endsection

@section('search')
<form class="form-inline ml-3">
    <div class="input-group input-group-sm">
    <input class="form-control form-control-navbar" value="{{$search}}" style="width: 220px;" type="search" name="search" placeholder="{{__('Search by Name or User Name')}}" aria-label="Search">
    <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </div>
    </div>
</form>
@endsection

@section('content')
    <form action="" method="" enctype="multipart/form-data">
        <table class="table">
            <thead>
                <tr>
                <th class="text-left" scope="col">{{__('ID')}}</th>
                <th class="text-left" scope="col">{{__('Avatar')}}</th>
                <th class="text-left" scope="col">{{__('name')}}</th>
                <th class="text-left" scope="col">{{__('User Name')}}</th>
                <th class="text-left" scope="col">{{__('Email')}}</th>
                <th class="text-left" scope="col">{{__('birthday')}}</th>
                <th class="text-left" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr>
                    <td class="text-left">{{$row->id}} </td>
                    <td class="text-left"><img src="{{$row->avatar}}" style="width: 100px;height:100px;border-radius: 50%;"></td>
                    <td class="text-left">{{$row->name}}</td>
                    <td class="text-left">{{$row->user_name}}</td>
                    <td class="text-left">
                        <span id="popup-detail{{$row->id}}" class="see-detail popup-detail" data-container="body" data-toggle="popover" data-placement="bottom" data-content="{{$row->email}}">
                            {{__('see email')}}
                        </span>
                    </td>
                    <td class="text-left">{{$row->birthday}}</td>
                    <td class="text-right">
                        <div>
                            <span id="button-menu"><i class="fas fa-bars"></i>
                                <ul id="menu-edit">
                                    <li><a onclick="destroy({{ $row->id }})" >{{__('Delete')}}</a></li>
                                </ul>
                            </span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
    <div style="display: flex;position: absolute;bottom: 10px;left: 50%;">
        <div style="display: inline-block;margin:auto">
            @if ($data->links()->paginator->currentPage() == 1)
                <a class="pagination page-active" href="{{$data->links()->paginator->path()}}?page=1"><<</a>
            @else
                <a class="pagination" href="{{$data->links()->paginator->path()}}?page=1"><<</a>
            @endif
            @foreach ($data->links()->elements as $item)
                @if ($item != '...')
                    @foreach ($item as $link)
                    @if ($data->links()->paginator->currentPage() == array_search ($link, $item))
                        <a class="pagination page-active" href="{{$link}}">{{array_search ($link, $item)}}</a>
                    @else
                        <a class="pagination" href="{{$link}}">{{array_search ($link, $item)}}</a>
                    @endif
                    @endforeach
                @else
                    <a href="#">...</a>
                @endif
            @endforeach
            @if ($data->links()->paginator->currentPage() == $data->links()->paginator->lastPage())
                <a class="pagination page-active" href="{{$data->links()->paginator->path()}}?page={{$data->links()->paginator->lastPage()}}">>></a>
            @else
                <a class="pagination" href="{{$data->links()->paginator->path()}}?page={{$data->links()->paginator->lastPage()}}">>></a>
            @endif
        </div>
    </div>
@endsection

@section('js')
  <script src="{{ asset('js/admin/myJs/user-index.js')}}"></script>
  <script>
        function destroy(id_user) {
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
                var data = result.value;
                jQuery.ajax({
                    url:'{{route("user_destroy","")}}/'+id_user,
                    type: "get",
                    success: function (){
                    swal( "{{__('Success!')}}",data.msg,'success' );
                    location.reload();;
                    }
                });
            });
        }
  </script>
@endsection
