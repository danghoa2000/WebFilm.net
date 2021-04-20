@extends('admin.Master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/myCss/film-index.css')}}">
    <link rel="stylesheet" href="{{ asset('css/user/elegant-icons.css ')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/myCss/menu-edit.css ')}}">
@endsection

@section('content')
    <div style="padding: 10px;">
    <a href="{{route('category_create')}}" class="btn btn-primary">{{__('New Category')}}</a>
    </div>
    <form action="" method="" enctype="multipart/form-data">
        <table class="table">
            <thead>
                <tr>
                <th class="text-left" scope="col">{{__('ID')}}</th>
                <th class="text-left" scope="col">{{__('Name')}}</th>
                <th class="text-left" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr>
                    <td class="text-left">{{$row->id}} </td>
                    <td class="text-left">{{$row->name}}</td>
                    <td class="text-right">
                        <div>
                            <span id="button-menu"><i class="fas fa-bars"></i>
                                <ul id="menu-edit">
                                    <li><a href="{{route('category_edit', ['id' => $row->id])}}">{{__('Edit')}}</a></li>
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
  <script src="{{ asset('js/admin/myJs/episode-index.js')}}"></script>
  <script>
        function destroy(id_category) {
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
                    url:'{{route("category_destroy","")}}/'+id_category,
                    type: "get",
                    success: function (){
                    swal( "{{__('Success!')}}",data.msg,'success' );
                    location.reload();;
                    }
                });
            });
        }

        $(".active").attr('class', 'nav-link');
        $("#category").attr('class', 'nav-link active');
        $("#master_category").attr("class", "nav-item has-treeview menu-open");
        $("#category_index").css("display", "block");
  </script>
@endsection
