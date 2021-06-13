@extends('admin.Master')

@section('css')
    <style>
        th a{
            color: black
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('Statistical List')}}</h1>
                </div>
            </div>
        </div>
    <section class="content">
        <form action="" method="" enctype="multipart/form-data"  id="filter">
            <div class="d-flex justify-content-between flex-wrap float-right mb-2">
                <div class="mr-2 mt-1">
                    <a href="{{route('statistical_csv',
                        [
                            'order' => request()->order,
                            'sort' => request()->sort,
                            'direction' => request()->direction
                        ])}}" class="btn btn-block btn-success btn-sm"><i class="fa fa-file-csv"></i> Csv</a>
                </div>
                <div class="mr-2 mt-1">
                    <a href="{{route('statistical_pdf',
                        [
                            'order' => request()->order,
                            'sort' => request()->sort,
                            'direction' => request()->direction
                        ])}}" class="btn btn-block btn-success btn-sm"><i class="fa fa-file-pdf"></i> Pdf</a>
                </div>
                <div>
                    <select name="order" id="order" class="form-control" style="border: solid 1px #2caabf">
                        <option value="" selected>{{__('All')}}</option>
                        <option value="day" {{request()->order == "day" ? "selected" : ""}}>{{__('Day')}}</option>
                        <option value="week" {{request()->order == "week" ? "selected" : ""}}>{{__('Week')}}</option>
                        <option value="month" {{request()->order == "month" ? "selected" : ""}}>{{__('Month')}}</option>
                    </select>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                    <th class="text-left" scope="col">{{__('ID')}}</th>
                    <th class="text-left" scope="col">{{__('name')}}</th>
                    <th class="text-left" scope="col">@sortablelink('View', __('View'))</th>
                    <th class="text-left" scope="col">@if(isset(request()->order)) @sortablelink('time', __('Time')) @endif</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($films as $film)
                        <tr>
                            <td class="text-left">{{$film->id}}</td>
                            <td class="text-left">{{$film->name}}</td>
                            <td class="text-left">{{isset($film->view) ? $film->view : "0"}}</td>
                            <td class="text-left">{{isset(request()->order) ? (isset($film->time) ? (isset(request()->order) ? $film->time : date('d-m-Y', strtotime($film->time))) : "--") : ""}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </section>
@endsection

@section('js')
<script>
    $('#order').change(function (e) {
        $('#filter').submit();
    });

    $(".active").attr('class', 'nav-link');
    $("#statistical_list").attr('class', 'nav-link active');
    $("#master_statistical").attr("class", "nav-item has-treeview menu-open");
    $("#statistical_index").css("display", "block");
</script>
@endsection
