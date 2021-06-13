@extends('admin.Master')

@section('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('Statistical')}}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <form action="" method="get" id="filter">
            <div class="d-flex justify-content-between flex-wrap">
                <div id="collapseFilter" class="d-sm-block collapse" style="width: 600px">
                    <div class="form-filter-daterange mb-2 mr-3">
                        <div class="row" data-picker="rangeDate">
                            <div class="col-9 col-sm-4 mb-2 mb-sm-0">
                                <label class="input-group mb-0 mr-1 mr-md-3">
                                    <input type="date" class="form-control {{$errors->first('startDate') ? 'is-invalid' : ''}}" name="startDate" value="{{old('startDate') ? old('startDate') : (isset(request()->startDate) ? request()->startDate : '') }}" style="border: solid 1px #2caabf">
                                    @if ($errors->first('startDate'))
                                        <div class="invalid-alert text-danger">{{ $errors->first('startDate') }}</div>
                                    @endif
                                </label>
                            </div>
                            <div class="col-9 col-sm-4">
                                <label class="input-group mb-0 mr-1 mr-md-3">
                                    <input type="date" class="form-control {{$errors->first('endDate') ? 'is-invalid' : ''}}" name="endDate" value="{{old('endDate') ? old('endDate') : (isset(request()->endDate) ? request()->endDate : '') }}" style="border: solid 1px #2caabf">
                                    @if ($errors->first('endDate'))
                                        <div class="invalid-alert text-danger">{{ $errors->first('endDate') }}</div>
                                    @endif
                                </label>
                            </div>
                            <div style="display: flex" class="col-9 col-sm-4">
                                <button type="submit" class="form-control mb-0 mr-1 mr-md-1 col-sm-6" style="border: solid 1px #2caabf; width: 110px;color: #ff6e2e"><i class="fas fa-filter"></i>filte</button>
                                <button type="button" id="reset" class="form-control col-sm-6" style="border: solid 1px #2caabf; color:#08ea3e;"><i class="fa fa-refresh"></i> reset</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <select name="order" id="order" class="form-control" style="border: solid 1px #2caabf">
                        <option value="" selected>{{__('Day')}}</option>
                        <option value="week" {{request()->order == "week" ? "selected" : ""}}>{{__('Week')}}</option>
                        <option value="month" {{request()->order == "month" ? "selected" : ""}}>{{__('Month')}}</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="card bg-gradient-info">
            <div class="card-header border-0">
              <h3 class="card-title">
                <i class="fas fa-th mr-1"></i>
              </h3>
              <div class="card-tools">
                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <canvas class="chart chartjs-render-monitor" id="line-chart" style="min-height: 250px; height: 470px; max-height: 470px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-footer -->
          </div>
    </section>

@endsection

@section('js')
<script src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/dist/js/demo.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
<script>
    $("#reset").click(function (e) {
        $("input[type='date']").val("");
    });

    var myChart1 = document.getElementById('line-chart').getContext('2d');
    // Global Options
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#f7f9fa';

    var massPopChart = new Chart(myChart1, {
      type:'line',
      data:{
        labels  :
            [
                @foreach ($charts as $chart)
                    {{$chart['date'].','}}
                @endforeach
            ],
        datasets: [
        {
            label               : 'Views',
            fill                : false,
            borderWidth         : 2,
            lineTension         : 0,
            spanGaps            : true,
            borderColor         : '#efefef',
            pointRadius         : 4,
            pointHoverRadius    : 7,
            pointColor          : '#efefef',
            pointBackgroundColor: '#efefef',
            data                : [
                @foreach ($charts as $chart)
                    {{$chart['views'].','}}
                @endforeach
            ],
        }]
      },
      options:{
        title:{
            display   : true,
            text      : "{{__('Statistical chart of views')}}",
            fontSize  : 25,
            responsive: true
        },
        legend:{
          display:false
        },
        layout:{
            padding:{
                left  :50,
                right :0,
                bottom:0,
                top   :0
            }
        },
        tooltips:{
          enabled:true
        }
      }
    });

    $('#order').change(function (e) {
        $('#filter').submit();
    });

    $(".active").attr('class', 'nav-link');
    $("#statistical").attr('class', 'nav-link active');
    $("#master_statistical").attr("class", "nav-item has-treeview menu-open");
    $("#statistical_index").css("display", "block");
</script>
@endsection
